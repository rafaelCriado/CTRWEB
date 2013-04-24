<?php 
	error_reporting(0);
	
	//DELETE NA TABELA TABELA_PRECO (CADASTROS -> PRODUTOS -> TABELA DE PREÇOS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(158, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//EXCLUIR_GRUPO()
		if(isset($_POST['id']) and !empty($_POST['id'])){
			include('../../classes/bd_oracle.class.php'); 
			$id = addslashes($_POST['id']);
	
			//SQL
			$sql = 'DELETE TABELA_PRECO
 					 WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').'
   					   AND TABPRECOD = '.$id;

			
			$result=oci_parse($conecta,$sql);
			if(oci_execute($result)){			
				echo '<span class="delivery_span_email">Tabela de preço excluída com sucesso</span>';
			}else{
				echo 'Falha ao Excluir';
			}
		}
		
	}else{
		echo 'Usuário não tem permissão para excluir!';
	}
	?>