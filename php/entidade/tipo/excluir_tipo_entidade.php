<?php
	error_reporting(0);
	
	//DELETE NA TABELA TIPO_ENT (Cadastros -> Pessoas -> Tipo)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(130, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){		

		if(isset($_POST['id']) and !empty($_POST['id'])){
			include('../../classes/bd_oracle.class.php'); 
			$id = addslashes($_POST['id']);
	
			//Formata data
			$sql = "DELETE FROM CATEG_ENTIDADE WHERE CATENTCODESTR = '".$id."' AND EMPCOD = ".$sessao->getNode('empresa_acessada');
			
			$result=oci_parse($conecta,$sql);
			if(oci_execute($result)){			
				echo '<span class="delivery_span_email">Categoria excluído com sucesso</span>';
			}else{
				echo 'Falha ao Excluir';
			}
		}
	}else{
		echo 'Usuário não tem permissão para excluir!';
	}
	?>
