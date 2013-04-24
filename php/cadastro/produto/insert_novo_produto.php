<?php 
	error_reporting(0);
	
	//INSERT NA TABELA EMPRESA (Cadastros -> EMPRESAS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(135, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		
		//Validação de variaveis obrigatorias
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			$texto = 'Variável descrição está vazia.';
			$retorno = 0;
		}else{
			if(!isset($_POST['estoque']) || empty($_POST['estoque'])){
				$texto = 'Variável estoque está vazia.';
				$retorno = 0;
			}else{
				
				//Grava no banco
				include('../../classes/bd_oracle.class.php'); 
				
				//Recebe as variaveis por POST 
				$var = $_POST;
				
				foreach($var as $campo => $valor){
					
					$$campo = $valor;
					if(empty($$campo)){
						
						$$campo = '';
					}
					//echo $campo .'='. $valor. '<br>';
				}		
				//SQL
				$sql = "INSERT INTO PRODUTO
										  (EMPCOD, PRODES, PROCODBAR, UNIMEDCOD,  PRODATCAD, PROCONEST,  USUCOD, PROGRUCOD, PROSUBGRUCOD,  PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU,PROTIP, PROCOR)
										VALUES
										  (". $sessao->getNode('empresa_acessada') .",
										   '". $descricao ."',
										   '". $codigo_barra ."',
										   '". $unidade_medida ."',
										   TRUNC(SYSDATE),
										   '". $estoque ."',
										   ". $sessao->getNode('usuario_citrino').",
										   ".checkInteiro($grupo).",
										   ".checkInteiro($subgrupo).",
										   '". $ncm ."',
										   ". checkInteiro($largura) .",
										   ". checkInteiro($altura) .",
										   ". checkInteiro($comprimento) .",
										   ". checkInteiro($peso_liquido) .",
										   ". checkInteiro($peso_bruto) .",
										   '".$tipo."',
										   '".$cor."')";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						$texto = 'Produto incluído com sucesso';
						
						//Consulta empresa
						$sql_produto = "SELECT PROCOD AS CODIGO FROM PRODUTO WHERE PRODES = '".$descricao."' AND ROWNUM <=1 ORDER BY PROCOD DESC";
						
						$query = oci_parse($conecta,$sql_produto);
						
						oci_execute($query);
						
						$row = oci_fetch_object($query);
						
						$retorno = $row->CODIGO;
						
						
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						$texto = 'Falha ao Gravar'.$sql;
						$retorno = 0;
					}
				}catch(Excpetion $e){
					$texto =  'Erro inesperado';
					$retorno = 0;
				}
			}
		}
	}else{
		$texto = 'Usuário não tem permissão para incluir';
		$retorno = 0;
	}
	
	$produto = array();
	$produto[] = array(
				'codigo' =>$retorno,
				'texto'	 =>$texto,
		);

	echo( json_encode( $produto ) );

	?>
