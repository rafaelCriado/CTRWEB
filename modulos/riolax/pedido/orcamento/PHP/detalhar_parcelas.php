<?php  //error_reporting(0);
//Caso não exista sessão faça (Necessário devido efeito de alteração
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../../../php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../../../php/functions.php');
		
		//Inclui banco de dados
		include('../../../../../php/classes/bd_oracle.class.php');
	}
	//Recebe as variaveis por POST 
		$var = $_POST;
		
		foreach($var as $campo => $valor){
			
			$$campo = $valor;
			if(empty($$campo)){
				
				$$campo = ' ';
			}
			//echo $campo .'='. $valor. '<br>';
		}
		
		
			if($_POST){
		
		
		
		$condicao_pagamento = !empty($_POST['condicao_pagamento'])	?$_POST['condicao_pagamento']	:0;
		
		$adicional 			= !empty($_POST['adicional'])			?$_POST['adicional']			:0;
		$desconto 			= !empty($_POST['desconto'])			?(float)$_POST['desconto']				:0;
		$frete	 			= !empty($_POST['frete'])				?$_POST['frete']				:0;
		$total	 			= !empty($_POST['total'])				?$_POST['total']				:0;
		$infos = '';
		
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
						 AND CP.CONPAGCOD = '.$condicao_pagamento.'
						 AND CP.EMPCOD = '.$sessao->getNode('empresa_acessada');
		
		
		$query_condicao = oci_parse($conecta, $sql_condicao);
		
		if(oci_execute($query_condicao)){
			
			$condicao = oci_fetch_object($query_condicao);
			
			$financeira_carencia		= isset($condicao->CARENCIA)				?$condicao->CARENCIA				:'';
			$financeira_indice			= isset($condicao->FINANCEIRA_INDICE)		?$condicao->FINANCEIRA_INDICE		:0;
			$financeira_tx_abertura		= isset($condicao->FINANCEIRA_TX_ABERTURA)	?$condicao->FINANCEIRA_TX_ABERTURA	:'';
			$condicao_pagamento_nome	= isset($condicao->NOME)					?$condicao->NOME					:'';
			$carencia					= isset($condicao->PRIMEIRA_PARCELA)		?$condicao->PRIMEIRA_PARCELA		:0;
			$financeira_nome			= isset($condicao->FINANCEIRA)				?$condicao->FINANCEIRA				:'';
			$taxa_abertura 				= isset($condicao->FINANCEIRA_TX_ABERTURA)	?$condicao->FINANCEIRA_TX_ABERTURA	:0;
			$qtde_parcelas				= isset($condicao->QUANTIDADE_PARCELA)		?$condicao->QUANTIDADE_PARCELA		:0;
			
			
			$adicional = str_replace('.','',$adicional);
			$adicional = str_replace(',','.',$adicional);

			$frete = str_replace('.','',$frete);
			$frete = str_replace(',','.',$frete);

			$taxa_abertura = str_replace('.','',$taxa_abertura);
			$taxa_abertura = str_replace(',','.',$taxa_abertura);

			$total = str_replace('.','',$total);
			$total = str_replace(',','.',$total);
			
			
			$total -= ($desconto*$total)/100;
			$totalT = $total;
			
			if(!empty($financeira_nome)){
					$infos .= '<strong title="Taxa de Abertura de Financiamento">+ Tx.Aber.Fin.: </strong><input title="Taxa de Abertura de Financiamento" type="text" disabled="disabled" value="R$ '.number_format($financeira_tx_abertura,2,',','.').'" size="8">';
			}			
			
			
			
		}
	
	
	}
	$t=0;
?>
<fieldset>
                	<legend>Parcelas</legend>
                    <div style=" height:150px;display:block; overflow:auto" >
                    <table width="100%" cellpadding="0" cellspacing="0" style="max-height:100px; overflow:auto;"  >
                    	<tr class="k-header">
                        	<td><strong>Num. Parcela</strong></td>
                            <td><strong>Prazo</strong></td>
                            <td><strong>Valor</strong></td>
                        </tr>
						<?php
							//echo $total;
							//echo (($desconto*$total)/100);

							//Adiciona taxa de abertura
							//$total += $taxa_abertura;
							
							
							if(isset($_POST['adicionar_frete']) and $_POST['adicionar_frete'] == 1){
								$total += $frete;
								$frete =0;
							}else{
								$infos .= '<strong>+ Frete: </strong><input type="text" disabled="disabled" value="R$ '.number_format($frete,2,',','.').'" size="8">';
							}

							if(isset($_POST['adicionar_adicional']) and $_POST['adicionar_adicional'] == 1){
								$total += $adicional;
								$adicional = 0;
							}else{
								$infos .= '<strong>+ Adicional: </strong><input type="text" disabled="disabled" value="R$ '.number_format($adicional,2,',','.').'"size="8">';
							}
							 
                            //Parcelas
							$sql_parcelas = 'SELECT CONPAGCOD AS CODIGO, CONPAGPARSEQ AS NUMERO, CONPAGPARDIA AS DIA
											  FROM COND_PAG_PARC
											 WHERE CONPAGCOD ='. $condicao_pagamento;
							$query_parcelas = oci_parse($conecta, $sql_parcelas);
							
							if(oci_execute($query_parcelas)){
								
								
								//Calculo financiamento total
								if(!empty($financeira_indice)){
									$total += ($financeira_indice*$total)/100;
								}
								//fim
								
								$valor_parcela = $total/$qtde_parcelas;
								$mod = $total - (round($valor_parcela,2)*$qtde_parcelas);
								$mod = round($mod,2);
								while($parcelas = oci_fetch_object($query_parcelas)){
									
									?>
									<tr>
                                    	<td><?php echo $parcelas->NUMERO; ?></td>
                                        <td><?php echo $parcelas->DIA; ?></td>
                                        <td>
											<?php
															
												echo 'R$ '.number_format(($valor_parcela+$mod),2,',','.'); 
												
												if($mod != ''){
													$mod = 0;
												}
											?>
                                     	</td>
                                    </tr>									
									<?php
								}
								
							}
							
                            
                        ?>
                    </table>
                    </div>
                </fieldset>
                <strong>Total Parcelas: </strong> <input type="text" disabled="disabled" value="<?php echo 'R$ '.number_format($total,2,',','.');?>" size="11"/>
                <?php echo $infos;?>
                <br />
				<br />
                <strong>Total = </strong> <input type="text" disabled="disabled" value="<?php echo 'R$ '.number_format($total+$frete+$adicional+$financeira_tx_abertura,2,',','.');?>" size="11"/>
                <input type="hidden"  value="<?php echo $total;?>" name="detalhar_total"/>