<?php
	/* ================================================================================
			objetivo	:		Inserir orçamento no banco
			autor		:		Rafael Marques Criado
			criado em	:		13/02/2013
				
	   ================================================================================ */
	   
	   
	error_reporting(0);
	//header( 'Cache-Control: no-cache' );
	//header( 'Content-type: application/xml; charset="utf-8"', true );
	

	//Sessão
	include('../../../../../php/classes/session.class.php');

	//Inclui banco da dados e funções
	include("../../../../../php/classes/bd_oracle.class.php");
	include('../../../../../php/functions.php');
	
	//Inicia Sessão
	$sessao = new Session();
	$orcamento = array();
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(177, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//Recebe informações
		if($_POST){
			$empresa			= $sessao->getNode('empresa_acessada');
			$cliente 			= isset($_POST['cliente'])?		$_POST['cliente']			:'';
			$categoria 			= isset($_POST['categoria'])?	$_POST['categoria']			:'';
			$modelo 			= isset($_POST['modelo'])?		$_POST['modelo']			:'';
			$medida 			= isset($_POST['medida'])?		$_POST['medida']			:'';
			$linha	 			= isset($_POST['linha'])?		$_POST['linha']				:'';
			$acabamento			= isset($_POST['acabamento'])?	$_POST['acabamento']		:'';
			$cores	 			= isset($_POST['cores'])?		$_POST['cores']				:'';
			$posicao 			= isset($_POST['posicao'])?		$_POST['posicao']			:'';
			$voltagem 			= isset($_POST['voltagem'])?	$_POST['voltagem']			:'';
			$fechamento			= isset($_POST['fechamento'])?	$_POST['fechamento']		:'';
			$usuario 			= isset($_POST['usuario'])?		$_POST['usuario']			:'';
			$data 				= isset($_POST['data'])?		$_POST['data']				:'';
			$data_final 		= isset($_POST['data_final'])?	$_POST['data_final']		:'';
			$observacao			= isset($_POST['observacao'])?	$_POST['observacao']		:'';
			
			$condicao_pagamento 	= isset($_POST['condicao_pagamento'])	? $_POST['condicao_pagamento'] 	: "NULL";
			$condicao_pagamento 	= !empty($_POST['condicao_pagamento'])	? $_POST['condicao_pagamento'] 	: "NULL";
			
			$adicionar_frete 		= isset($_POST['adicionar_frete'])		? $_POST['adicionar_frete'] 	: '';
			$adicionar_adicional 	= isset($_POST['adicionar_adicional'])	? $_POST['adicionar_adicional'] : '';
			$taxa_abertura 			= isset($_POST['taxa_abertura'])		? $_POST['taxa_abertura'] 		: '';
			
			$adicional			= isset($_POST['adicional'])?	str_replace(',','.',str_replace('.','',$_POST['adicional'])):'';
			$previsao_venda		= isset($_POST['previsao_venda'])?	$_POST['previsao_venda']		:'';
			
			
			
			$prazo_entrega		= isset($_POST['prazo_entrega'])?$_POST['prazo_entrega']	:'';
			$frete	 			= isset($_POST['frete'])?		$_POST['frete']				:'';
			$frete				= str_replace('.','',$frete);
			$frete				= trim(str_replace(',','.',$frete));
			
			
			
			$desconto 			= isset($_POST['desconto'])?	$_POST['desconto']			:'';
			$observacao			= isset($_POST['observacao'])?	$_POST['observacao']		:'';
			$forma_pagamento	= !empty($_POST['forma_pagamento'])?$_POST['forma_pagamento']		:'NULL';
			
			
			
			//Insere CABEÇALHO DO ORÇAMENTO
			
			
			$sql = "INSERT INTO ORCAMENTO (EMPCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCVALFRE, ORCVALTOT, USUCOD, ORCVALADI, ORCPREVEN, ORCINCFINADC, ORCINCFINFRE, ORCVALTXAB,FORPAGNUM) VALUES (".$empresa.", TRUNC(SYSDATE),  TRUNC(SYSDATE), ".$cliente.", '".dataNascimento($data_final)."',".$prazo_entrega.",".$condicao_pagamento.",".$desconto.",".$frete.", 0, ".$usuario.",".$adicional.",'".$previsao_venda."',".$adicionar_adicional.",".$adicionar_frete.",".$taxa_abertura.",".$forma_pagamento.")";
			
			//Prepara inserção
			$insert_orcamento = oci_parse($conecta,$sql);
			
			//TRANSACAO
			if(oci_execute($insert_orcamento,OCI_DEFAULT)){
				
				//Pesquisa numero cadastrado
				$sql_orcamento = "SELECT 	MAX(O.ORCCOD) AS CODIGO FROM ORCAMENTO O WHERE 	O.USUCOD = ".$usuario;
											   
				$query_orcamento = oci_parse($conecta,$sql_orcamento);

				oci_execute($query_orcamento,OCI_DEFAULT);
				
				$row_orcamento = oci_fetch_object($query_orcamento);
				
				$numero = $row_orcamento->CODIGO;
				
				
				//INSERI ITEMS DO ORÇAMENTO
				
				$sql_produto = "SELECT P.PROCOD CODIGO,
									   P.PROCODALT CODIGO_ALTERNATIVO,
									   P.PRODES DESCRICAO,
									   TP.TABPRECOD TABELA_PRECO_CODIGO,
									   TP.TABPREDEN AS TABELA_PRECO,
									   TO_CHAR((TPI.TABPREITEVAL), '999999999999.99') AS PRECO_VENDA,
									   TO_CHAR((P.PROVALCUS * E.EMPINDVALMIN),'999999999999999.99') AS PRECO_MINIMO,
									   TO_CHAR(((TPI.TABPREITEVAL)-(P.PROVALCUS * E.EMPINDVALMIN)),'99999999999.99') AS LUCRO
								  FROM PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS, EMPRESA E,TABELA_PRECO TP, TABELA_PRECO_ITEM TPI
								 WHERE P.PROGRUCOD = PG.PROGRUCOD
								   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD
								   AND P.EMPCOD = E.EMPCOD
								   AND P.PROCOD = TPI.PROCOD
   								   AND TPI.TABPRECOD = TP.TABPRECOD
								   AND PG.PROGRUCOD = '".$categoria."'
								   AND PS.PROSUBGRUCOD = '".$modelo."'
								   AND (P.PROCOM || 'x' || P.PROLAR || 'x' || P.PROALT) = '".$medida."'
								   AND P.PROCAR1 = '".$linha."'
								   AND P.PROMAT = '".$acabamento."'
								   AND UPPER(P.PROCOR) = '".$cores."'
								   AND P.PROCAR2 = '".$posicao."'
								   AND P.PROCAR3 = '".$voltagem."'
								   AND TP.TABPRECOD = 1";
								   
				
				$query_produto = oci_parse($conecta,$sql_produto);
				
				if(oci_execute($query_produto,OCI_DEFAULT)){
				
					$contador = 0;
					while($produto = oci_fetch_object($query_produto)){
						
						$contador++;
						
						$produto_codigo 		= $produto->CODIGO;
						$produto_descricao 		= $produto->DESCRICAO;
						$produto_codigo_alternativo 		= $produto->CODIGO_ALTERNATIVO;
						$produto_preco_venda 	= $produto->PRECO_VENDA;
						$produto_preco_minimo	= $produto->PRECO_MINIMO;
						$produto_quantidade 	= 1;
						
					}
					
					
					if($contador == 1){
						
						
						//INSERI PRODUTO PRINCIPAL
						
						$sql_insert_item_principal = 
							"INSERT INTO ORCAMENTO_ITEM
							  (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
							VALUES
							  (".$numero.", ".$produto_codigo.", '".$produto_descricao."', ".$produto_quantidade.", ".$produto_preco_venda.", NULL, ".$produto_quantidade*$produto_preco_venda.", ".$usuario.", ".$empresa.")";
							  
						$insert_item_principal = oci_parse($conecta,$sql_insert_item_principal);
						
						if(oci_execute($insert_item_principal,OCI_DEFAULT)){
							
							//INSERIR KITS
							
							$fechamento = explode(',',$fechamento);
						
							$subtotal = 0;
							$subtotalminimo = 0;
							
							for($x = 0; $x< count($fechamento); $x++){
								
								$y = $x + 1;
								$produto = explode('|',$fechamento[$x]);
								
								$sql_fechamentos = "SELECT P.PROCOD AS CODIGO,
													   P.PRODES AS DESCRICAO,
													   TO_CHAR(TPI.TABPREITEVAL, '9999999999.99') AS VALOR,
													   TP.TABPREDEN AS TABELA,
													   E.EMPINDVALMIN AS INDICE_MINIMO,
													   TO_CHAR(P.PROVALCUS, '999999999999.99') AS CUSTO,
													   TO_CHAR((E.EMPINDVALMIN * P.PROVALCUS), '9999999999.99') AS PRECO_MINIMO,
													   TO_CHAR((TPI.TABPREITEVAL) - (E.EMPINDVALMIN * P.PROVALCUS),
															   '999999999999.99') AS LUCRO
												  FROM PRODUTO P, TABELA_PRECO_ITEM TPI, TABELA_PRECO TP, EMPRESA E
												 WHERE P.PROCOD = TPI.PROCOD
												   AND TP.TABPRECOD = TPI.TABPRECOD
												   AND P.EMPCOD = E.EMPCOD
												   AND P.PROCOD 		= ".$produto[0]."
												   AND TPI.TABPRECOD 	= ".$produto[1];
								
								$quantidade_item = 1;
								
								$query_fechamento = oci_parse($conecta,$sql_fechamentos);
								
								oci_execute($query_fechamento,OCI_DEFAULT);
								
								$kit = oci_fetch_object($query_fechamento);	
								
								$item_total = $quantidade_item*$kit->VALOR;
								$item_total_minimo = $quantidade_item*$kit->PRECO_MINIMO;
								
								$subtotal += $item_total;
								$subtotalminimo += $item_total_minimo;
								
								$sql_insert_itens = 
											"INSERT INTO ORCAMENTO_ITEM
											  (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD )
											VALUES
											  (".$numero.", ".$kit->CODIGO.", '".$kit->DESCRICAO."', ".$quantidade_item.", ".$kit->VALOR.", NULL, ".$item_total.", ".$usuario.", ".$empresa.")";
							  
								$insert_itens = oci_parse($conecta,$sql_insert_itens);
								
								$itens_inseridos = 1;
								!oci_execute($insert_itens,OCI_DEFAULT)?$itens_inseridos = 0:'';
								
							}//FIM FOR
							
							
							//VERIFICA SE TEVE ERRO NA INSERÇÂO
							if($itens_inseridos == 1){
								
								if(!empty($condicao_pagamento)){
								
									//Condição de pagamento ==================================
									$sql_condicao = 'SELECT CP.CONPAGCOD       AS CODIGO,
														   CP.CONPAGDEN       AS NOME,
														   CP.CONPAGQTDPAR    AS QUANTIDADE_PARCELA,
														   CP.CONPAGDIAPAR    AS DIFERENCA_PARCELAS,
														   CP.CONPAGDIAPRIPAR AS PRIMEIRA_PARCELA,
														   F.FINNOM           AS FINANCEIRA,
														   F.FINTAXABE        AS FINANCEIRA_TX_ABERTURA,
														   FP.FINPARIND       AS FINANCEIRA_INDICE,                   
														   CP.FINCOD,
														   CP.FINPARCAR		  AS CARENCIA,
														   CP.FINPARNUM
													  FROM COND_PAG CP, FINANCEIRAS F, FINANCEIRAS_PARCELAS FP
													 WHERE F.FINCOD(+) = CP.FINCOD
													 AND FP.FINCOD(+) = CP.FINCOD
													 AND CP.FINPARCAR = FP.FINPARCAR(+)
													 AND CP.CONPAGQTDPAR = FP.FINPARNUM(+)
													 AND CP.CONPAGCOD = '.$condicao_pagamento;
													 
									
									$query_condicao = oci_parse($conecta,$sql_condicao);				 
									
									
									if(oci_execute($query_condicao,OCI_DEFAULT)){
										$condicao = oci_fetch_object($query_condicao);
										
										$tx_abertura 		= $condicao->FINANCEIRA_TX_ABERTURA;
										$financeira_indice 	= $condicao->FINANCEIRA_INDICE;
										
										
									}else{
										
										$tx_abertura = 0;
										$financeira_indice = 0;
											
									}
								}else{
									
									$tx_abertura = 0;
									$financeira_indice = 0;
									
								}
							
								//=========================================================
								
								
								//CALCULO FINANCEIRO DO VALOR TOTAL ==============================================================
								
								
								$percentual = $desconto;
								
								
								$total_produtos = (($produto_preco_venda*$produto_quantidade) + $subtotal);
								$desconto		= ($total_produtos*$desconto)/100;
								
								
								
								$valor_total_custo = ($produto_preco_minimo*$produto_quantidade)+$subtotalminimo;
								
								
								
								$valor_total = $total_produtos-$desconto;
								
								
								
								
								$vt = $valor_total;
								
								
								//Caso o calculo do financiamento tiver que incluir o valor adicional
								if($adicionar_adicional == 1){
									$vt+=$adicional;
								}
								
								//Caso o calculo do financiamento tiver que incluir o frete.
								if($adicionar_frete == 1){
									$vt+=$frete;
								}
								
								if($financeira_indice > 0){
									
									//Calcula financiamento total
									$vt += ($vt*$financeira_indice)/100;
									
									
									//Adiciona taxa de abertura no valor total
									$vt += $tx_abertura;
									
								}
								
								// =============================================================================================
								
								$valor_total = $vt;
								
								
								$financeira_indice = isset($financeira_indice)?$financeira_indice:0;
								
								//ATUALIZA VALOR TOTAL
								$sql_update_total = 'UPDATE ORCAMENTO
													    SET ORCVALTOT = '.$valor_total.',
															ORCPERDES1 = '.$percentual.',
															ORCINDPERFIN = '.$financeira_indice.'
													  WHERE EMPCOD = '.$empresa.'
													    AND ORCCOD = '.$numero;
								
								$update_total = oci_parse($conecta,$sql_update_total);
								
								if(oci_execute($update_total,OCI_DEFAULT)){
								
									
									
									if($valor_total >= $valor_total_custo){
										
										//INSERE JUSTIFICATIVA SE PRECISAR ========================================
											
											if(isset($_POST['motivo'])){
												
												$motivo = $_POST['motivo'];
												
												$insert_update = "INSERT INTO JUSTIFICATIVAS
																		  (EMPCOD, ORCCOD, JUSDES)
																		VALUES
																		  ('".$sessao->getNode('empresa_acessada')."', ".$numero.", '".$motivo."')";
																		  
												$insert_motivo = oci_parse($conecta,$insert_update);
												
												if(oci_execute($insert_motivo,OCI_DEFAULT)){
													
													oci_commit($conecta);
													$texto = 'Orçamento número : ';
													//$texto .=  ' Total= '.$valor_total. 'Custo= '.$valor_total_custo. ' === ';
													$retorno = $numero;
													
												}else{
													oci_rollback($conecta);
													$texto = 'Falha na inclusão da justificativa';
													$retorno = 0;	
												}
												
											}else{
											//=========================================================================
										
										
												oci_commit($conecta);
												$texto = 'Orçamento número : ';
												//$texto .=  ' Total= '.$valor_total. 'Custo= '.$valor_total_custo. ' === ';
												$retorno = $numero;
											}
									
									}else{
										
										oci_rollback($conecta);
										$texto = 'Desconto está fora do parametro!';
										$retorno = 0;
										
									}
									
								}else{
									
									oci_rollback($conecta);
									$texto = 'Falha na inclusão do cabeçalho'.$sql_update_total;
									$retorno = 0;
									
								}
							}else{
							
								oci_rollback($conecta);
								$texto = 'Falha na inclusão do opcionais';
								$retorno = 0;
							
							}
							
							
						}else{
							
							oci_rollback($conecta);
							$texto = $produto_codigo.'Falha na inclusão do item principal';
							$retorno = 0;
							
						}
					}else{
						
						oci_rollback($conecta);
						$texto = 'Cadastro de produto duplicado';
						$retorno = 0;
						
					}
				
				}else{
				
					oci_rollback($conecta);
					$texto = 'Erro ao cadastrar produto principal.';
					$retorno = 0;
				}
			}else{
				
				//Falha na inclusão
				oci_rollback($conecta);
				$texto = 'Falha na inclusão do cabeçalho do orçamento'. $sql;
				$retorno = 0;
			}
		}
	}else{
		
		$texto = 'Usuario não tem permissão para incluir';	
		$retorno = 0;
	}
	
	$orcamento[] = array(
				'codigo_retorno' 		 	=>$retorno,
				'texto'						 =>$texto,
		);

	echo( json_encode( $orcamento ) );

?>
