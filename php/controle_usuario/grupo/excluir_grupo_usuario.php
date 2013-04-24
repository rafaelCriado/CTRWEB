<?php 
	error_reporting(0);
	
	//UPDATE NA TABELA GRUPO USUARIO (Cadastros -> Controle de Usuario -> Cadastros de Grupos de Usuários)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(134, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	//EXCLUIR_GRUPO DE USUARIO (Cadastros -> Controle de Usuario -> Cadastros de Grupos de Usuários)
	if(isset($_POST['id']) and !empty($_POST['id'])){
		include('../../classes/bd_oracle.class.php'); 
		$id = addslashes($_POST['id']);

		//Formata data
		$sql = "DELETE FROM USUARIO_GRUPO WHERE USUGRUCOD = ".$id;
		
		$result=oci_parse($conecta,$sql);
		if(oci_execute($result)){			
			echo '<span class="delivery_span_email">Grupo excluído com sucesso</span>';
		}else{
			echo 'Falha ao Excluir';
		}
	}
	}else{
		echo 'Usuário não tem permissão para excluir!';
	}
?>