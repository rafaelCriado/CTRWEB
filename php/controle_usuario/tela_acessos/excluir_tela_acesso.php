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
	$acessar = acessaTela(132, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						

	error_reporting(0);
	//EXCLUIR_TELAS DE ACESSO (Cadastros -> Controle de Usuário -> Telas de Acesso)
	if(isset($_POST['id']) and !empty($_POST['id'])){
		include('../../classes/bd_oracle.class.php'); 
		$id = addslashes($_POST['id']);

		//Formata data
		$sql = "DELETE FROM USUARIO_ACESSO WHERE USUACECOD = '".$id."'";
		
		$result=oci_parse($conecta,$sql);
		if(oci_execute($result)){			
			echo '<span class="delivery_span_email">Tela excluída com sucesso</span>';
		}else{
			echo $id.'Falha ao Excluir';
		}
	}
	}else{
		echo 'Usuário não tem permissão para excluir!';
	}
	?>
