<?php 
	//EXCLUIR_ESTADO (Cadastros -> Localidade -> Estados)
		//INSERT NA TABELA UNIDADE MEDIDA (Cadastros -> UNIDADE DE MEDIDA)
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(125, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		
		if(isset($_POST['id']) and !empty($_POST['id'])){
			include('../../classes/bd_oracle.class.php'); 
			$id = addslashes($_POST['id']);
	
			//Formata data
			$sql = "DELETE FROM UNIDADE_MEDIDA WHERE UNIMEDCOD = '".$id."'";
			
			$result=oci_parse($conecta,$sql);
			if(oci_execute($result)){			
				echo '<span class="delivery_span_email">Unidade de Medida excluída com sucesso</span>';
			}else{
				echo 'Falha ao Excluir';
			}
		}
	}else{
		echo 'Usuário não tem permissão de excluir';
	}
	?>
