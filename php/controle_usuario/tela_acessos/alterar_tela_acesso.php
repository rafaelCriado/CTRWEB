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
	$acessar = acessaTela(132, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
	if(!isset($_POST['texto']) || empty($_POST['texto'])){
		echo 'Valor Vazio não pode ser salvo.';
	}else{
		
					
		//Grava no banco
		include('../../classes/bd_oracle.class.php'); 
		$descricao = strip_tags($_POST['texto']);
		$id = $_POST['id'];
		//SQL
		$sql = "UPDATE USUARIO_ACESSO SET USEACEDESC='".$descricao."' WHERE USUACECOD = '".$id."'";
		
		$result=oci_parse($conecta,$sql);
		
		try{
			if(oci_execute($result)){
				echo '<span class="delivery_span_email">Tela salva com sucesso</span>';
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
		echo 'Usuário não tem permissão para alterar!';
	}
	?>
