<?php 
	error_reporting(0);
	
	//INSERT NA TABELA USUARIO ACESSO (Cadastros -> Controle de usuario -> Telas de Acesso)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(132, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar) ){						
	
	if(!isset($_POST['descricao_']) || empty($_POST['descricao_'])){
		echo 'Variável descrição está vazia.';
	}else{
					
		//Grava no banco
		include('../../classes/bd_oracle.class.php'); 
		$descricao = strip_tags($_POST['descricao_']);

		//SQL
		$sql = "INSERT INTO 
					USUARIO_ACESSO(USEACEDESC)
				VALUES
					('".$descricao."')";
		
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
		echo 'Usuário não tem permissão para incluir!';
	}
	?>
