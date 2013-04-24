<?php 
	error_reporting(0);
	
	//DELETE NA TABELA EMPRESA (Cadastros -> EMPRESAS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'EXCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//EXCLUIR_ESTADO (Cadastros -> Localidade -> Estados)
		if(isset($_POST['id']) and !empty($_POST['id'])){
			include('../../classes/bd_oracle.class.php'); 
			$id = addslashes($_POST['id']);
	
			//Formata data
			$sql = "DELETE FROM PRODUTO_SUBGRUPO WHERE EMPCOD = ".$sessao->getNode('empresa_acessada')."  AND PROSUBGRUCOD = ".$id;
			
			$result=oci_parse($conecta,$sql);
			if(oci_execute($result)){			
				echo '<span class="delivery_span_email">SubGrupo excluído com sucesso</span>';
			}else{
				echo 'Falha ao Excluir';
			}
		}
		
	}else{
		echo 'Usuário não tem permissão para excluir!';
	}
	?>
