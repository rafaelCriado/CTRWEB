<?php 
	error_reporting(0);
	
	//UPDATE NA TABELA USUARIO (Cadastros -> Controle de usuário -> Cadastro de Usuarios)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(131, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['nome']) || empty($_POST['nome'])){
			echo 'Variável nome está vazia.';
		}else{
			if(!isset($_POST['senha']) || empty($_POST['senha'])){
				echo 'Variável senha esta variável';
			}else{
				
				
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$nome		= strip_tags($_POST['nome']);
				$senha 		= strip_tags($_POST['senha']);
				$cargo		= strip_tags($_POST['cargo']);
				$codigo		= strip_tags($_POST['codigo']);
				$grupo		= strip_tags($_POST['grupo']);
				if(!isset($_POST['grupo']) or empty($_POST['grupo'])){
					$grupo = 'NULL';
				}
				//SQL
				$sql = "UPDATE USUARIO
						   SET USUNOM 	= '$nome',
							   USUPASS 	= '$senha',
							   USUGRUCOD = $grupo,
							   USUCAR 	= '$cargo'
						 WHERE USUCOD 	= ".$codigo;
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Usuário salvo com sucesso</span>';
						echo $site;
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						echo 'Falha ao Salvar'.$sql;
					}
				}catch(Excpetion $e){
					echo 'Erro inesperado';
				}
			}
		}
	}else{
		echo 'Usuário não tem permissão para alterar!';
	}
	?>
