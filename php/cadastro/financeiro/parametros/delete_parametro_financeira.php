<?php 
	error_reporting(0);
	//DELETE (CADASTRO -> FINANCEIRO -> PARAMETROS FINANCEIRO)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
	//Banco	
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//Controle de Acesso
	$acessar = acessaTela(258, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		$condicao = array();
		
		if(!isset($_POST['parametro_financeira']) || empty($_POST['parametro_financeira'])){
			$texto =  'Erro';
			$retorno = 0;
		}else{
			
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			
			//Recebe variaveis
			$codigo  = explode('|',$_POST['parametro_financeira']);
			
			//Sql
			$sql = "DELETE FROM FINANCEIRAS_PARCELAS
					 WHERE FINCOD = ".$codigo[2]."
					   AND FINPARCAR = ".$codigo[1]."
					   AND FINPARTOTPAR = ".$codigo[0];
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					$texto =  'Excluído com sucesso';
					$retorno = 1;
				}else{
					$erro = oci_error($result);

					$texto =  'Falha ao Gravar';
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
	
	$condicao[] = array(
			'mensagem'	=>$texto,
			'codigo_retorno' =>$retorno,
	);
	
	echo( json_encode( $condicao ) );

?>
