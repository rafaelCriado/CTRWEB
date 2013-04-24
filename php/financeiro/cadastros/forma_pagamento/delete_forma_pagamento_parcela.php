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
	$acessar = acessaTela(137, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		$condicao = array();
		
		if(!isset($_POST['condicao_pagamento_codigo']) || empty($_POST['condicao_pagamento_codigo'])){
			$texto =  'Erro';
			$retorno = 0;
		}else{
			
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			
			//Recebe variaveis
			$codigo  = $_POST['condicao_pagamento_codigo'];
			
			//Sql
			$sql = "DELETE FROM COND_PAG WHERE CONPAGCOD = ".$codigo." AND EMPCOD = ".$sessao->getNode('empresa_acessada');
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					$texto =  'Excluído com sucesso';
					$retorno = 1;
				}else{
					$erro = oci_error($result);

					$texto =  'Falha ao excluir';
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
