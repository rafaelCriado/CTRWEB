<?php 
	error_reporting(0);
	
	//DELETE NA TABELA GRUPO ()
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//EXCLUIR_GRUPO()
		if(isset($_POST['id']) and !empty($_POST['id'])){
			include('../../classes/bd_oracle.class.php'); 
			$id = addslashes($_POST['id']);
	
			//SQL
			$sql = 'DELETE PRODUTO_GRUPO
 					 WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').'
   					   AND PROGRUCOD = '.$id;

			
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
