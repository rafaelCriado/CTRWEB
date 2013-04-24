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
		
		//Validação de variaveis obrigatorias
		if(empty($_POST['pergunta'])){
			$texto = 'Variável pergunta está vazia.';
			$retorno = 0;
		}else{
			
			$sql = "DELETE FROM PESQUISAS_PERGUNTAS_OPCOES WHERE PESPERCOD = ".$pergunta;
			
			$result=oci_parse($conecta,$sql);
			
			
			try{
				if(oci_execute($result,OCI_DEFAULT)){
					
					$sql_pergunta = "DELETE FROM PESQUISAS_PERGUNTAS WHERE PESPERCOD = ".$pergunta;
					$exclui_pergunta = oci_parse($conecta,$sql_pergunta);
					
					if(oci_execute($exclui_pergunta,OCI_DEFAULT)){
						
						oci_commit($conecta);
						$texto =  'Pergunta excluída com sucesso';
						$retorno = 1;
						
					}else{
						
						oci_rollback($conecta);
						$texto =  'Falha ao excluir.';
						$retorno = 0;
					}
					
				}else{
					$erro = oci_error($result);
					$texto = 'Falha ao excluir'.$sql;
					$retorno = 0;
				}
			}catch(Excpetion $e){
				$texto =  'Erro inesperado';
				$retorno = 0;
			}
		
		}
	}else{
		$texto = 'Usuário não tem permissão para excluir';
		$retorno = 0;
	}
	
	$pergunta = array();
	$pergunta[] = array(
				'codigo' =>$retorno,
				'texto'	 =>$texto,
		);

	echo( json_encode( $pergunta ) );

	?>
