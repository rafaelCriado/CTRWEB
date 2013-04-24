<?php 
	error_reporting(0);
	//DELETE (FINANCEIRO -> CADASTROS -> FORMAS DE PAGAMENTO)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
	//Banco	
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//Controle de Acesso
	$acessar = acessaTela(278, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		$fp = array();
		
		if(!isset($_GET['id']) || empty($_GET['id'])){
			$texto =  'Erro';
			$retorno = 0;
		}else{
			
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			
			//Recebe variaveis
			$codigo  = $_GET['id'];
			
			//Sql
			$sql = "DELETE FROM FORMAS_PAGAMENTO WHERE FORPAGNUM = ".$codigo;
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					$texto =  'Excluído com sucesso';
					$retorno = 1;
				}else{
					$erro = oci_error($result);

					$texto =  'Falha ao Excluir';
					$retorno = 0;
				}
			}catch(Excpetion $e){
					$texto =  'Erro inesperado';
					$retorno = 0;
			}
					
		}
	}else{
		$texto =  'Usuário não tem permissão para excluir!';
		$retorno = 0;
	}
	
	$fp[] = array(
			'mensagem'	=>$texto,
			'codigo_retorno' =>$retorno,
	);
	
	echo( json_encode( $fp ) );

?>
