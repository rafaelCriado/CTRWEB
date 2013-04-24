<?php 
	error_reporting(0);
	
	//INSERT NA TABELA EMPRESA (Cadastros -> EMPRESAS)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(238, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		$pergunta = isset($_POST['pergunta'])?$_POST['pergunta']:'';
		$opcao	  = isset($_POST['opcao'])?$_POST['opcao']:'';
		
		
		
		//Validação de variaveis obrigatorias
		if(empty($_POST['pergunta'])){
			$texto = 'Variável pergunta está vazia.';
			$retorno = 0;
		}else{
			
			$sql = "INSERT INTO PESQUISAS_PERGUNTAS
							  (PESPERDES, EMPCOD, USUCOD)
							VALUES
							  ('".$pergunta."', ".$sessao->getNode('empresa_acessada').", ".$sessao->getNode('usuario_citrino').")";
			
			$result=oci_parse($conecta,$sql);
			
			
			try{
				if(oci_execute($result,OCI_DEFAULT)){
					
					
					//Consulta empresa
					$sql_pergunta = "SELECT MAX(PESPERCOD) AS CODIGO FROM PESQUISAS_PERGUNTAS WHERE USUCOD = ".$sessao->getNode('usuario_citrino')." AND EMPCOD = ".$sessao->getNode('empresa_acessada');
					
					$query = oci_parse($conecta,$sql_pergunta);
					
					oci_execute($query,OCI_DEFAULT);
					
					$row = oci_fetch_object($query);
					
					$codigo_pergunta = $row->CODIGO;
					
					if(!empty($opcao)){
				
						$opcao = explode(',',$opcao);
						
						$tamanho = count($opcao);
						
						$inserir_opcao = 1;
						
						for($x=1; $x<=$tamanho; $x++){
							if(isset($opcao[$x]) and !empty($opcao[$x])){
								$sql_insert_opcao = "INSERT INTO PESQUISAS_PERGUNTAS_OPCOES
															  (PESPERCOD, PESPEROPCOD, PESPEROPDES, USUCOD)
															VALUES
															  (".$codigo_pergunta.",".$x.",'".$opcao[$x]."',".$sessao->getNode('usuario_citrino').")";
								
								$query_opcao = oci_parse($conecta,$sql_insert_opcao);
						
								!oci_execute($query_opcao,OCI_DEFAULT)?$inserir_opcao = 0:'';
										
								
							}
						}
						
						if($inserir_opcao == 1){
							oci_commit($conecta);
							$texto = 'Pergunta incluída com sucesso';
							$retorno = 1;
						}else{
							oci_rollback($conecta);
							$texto = 'Falha na inclusão';
							$retorno = 0;
						}
						
						
					}else{
					
						oci_commit($conecta);
						$texto = 'Pergunta incluída com sucesso';
						$retorno = 1;
					}
					
				}else{
					$erro = oci_error($result);
					$texto = 'Falha ao Gravar'.$sql;
					$retorno = 0;
				}
			}catch(Excpetion $e){
				$texto =  'Erro inesperado';
				$retorno = 0;
			}
		
		}
	}else{
		$texto = 'Usuário não tem permissão para incluir';
		$retorno = 0;
	}
	
	$pergunta = array();
	$pergunta[] = array(
				'codigo' =>$retorno,
				'texto'	 =>$texto,
		);

	echo( json_encode( $pergunta ) );

	?>
