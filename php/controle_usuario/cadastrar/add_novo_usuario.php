<?php 
	error_reporting(0);
	
	//INSERT NA TABELA USUARIO (Cadastros -> EMPRESAS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(131, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		error_reporting(0);
		
		if(!isset($_POST['nome_']) || empty($_POST['nome_'])){
			echo 'Variável cidade está vazia.';
		}else{
			if(!isset($_POST['senha_']) || empty($_POST['senha_'])){
				echo 'Variável estado está vazia';
			}else{
				if(!isset($_POST['cargo_']) || empty($_POST['cargo_'])){
					$cargo = ' ';
	
				}else{
					$cargo = strip_tags($_POST['cargo_']);
	
				}
						
				//Grava no banco
				include('../../../php/classes/bd_oracle.class.php'); 
				$nome = strip_tags($_POST['nome_']);
				$senha = strip_tags($_POST['senha_']);
				$grupo = strip_tags($_POST['grupo_']);
		
				//SQL
				$sql = "INSERT INTO 
							USUARIO(USUNOM,USUPASS,USUCAR,USUGRUCOD)
						VALUES
							('".$nome."', '".$senha."','".$cargo."','".$grupo."')";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Usuário salvo com sucesso</span>';
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						echo 'Falha ao Gravar'.$sql;
					}
				}catch(Excpetion $e){
					echo 'Erro inesperado';
				}
					
				
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir!';
	}
	?>
