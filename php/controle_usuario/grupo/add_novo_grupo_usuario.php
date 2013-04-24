<?php 
	error_reporting(0);
	
	//INSERT NA TABELA GRUPO USUARIO (Cadastros -> Controle de Usuario -> Cadastros de Grupos de Usuários)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(134, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			echo 'Variável descrição está vazia';
		}else{
					
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			$descricao = strip_tags($_POST['descricao']);
	
			//SQL
			$sql = "INSERT INTO USUARIO_GRUPO
					  ( USUGRUDESC, USUCOD)
					VALUES
					  ('".$descricao."', ".$sessao->getNode('usuario_citrino').")";
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo '<span class="delivery_span_email">Grupo salvo com sucesso</span>';
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Gravar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir.';
	}
?>