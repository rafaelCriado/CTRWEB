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
	$acessar = acessaTela(134, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			echo 'Variável Descrição está vazia';
		}else{
				
			//Grava no banco
			include('../../classes/bd_oracle.class.php');
			$codigo		= strip_tags($_POST['codigo']);
			$descricao 	= strip_tags($_POST['descricao']);
			
			//SQL
			$sql = "UPDATE USUARIO_GRUPO
					   SET USUGRUDESC = '".$descricao."'
					 WHERE USUGRUCOD = ".$codigo;
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo '<span class="delivery_span_email">Grupo salvo com sucesso</span>';
					echo $site;
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Salvar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
		}
	}else{
		echo 'Usuário não tem permissão para atualizar!';
	}
	?>
