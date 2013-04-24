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
	$acessar = acessaTela(128, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['nome_']) || empty($_POST['nome_'])){
			echo 'Variável cidade está vazia.';
		}else{
			if(!isset($_POST['estado_']) || empty($_POST['estado_'])){
				echo 'Variável estado está vazia';
			}else{
				if(!isset($_POST['codigo_nacional_']) || empty($_POST['codigo_nacional_'])){
					echo 'Variável Código Nacional esta vazia';
				}else{
					if(!isset($_POST['codigo_ibge_']) || empty($_POST['codigo_ibge_'])){
						echo 'Variável Código IBGE esta vazia';
					}else{
						
						//Grava no banco
						include('../../../php/classes/bd_oracle.class.php'); 
						$nome = strip_tags($_POST['nome_']);
						$estado = strip_tags($_POST['estado_']);
						$codigo_nacional = strip_tags($_POST['codigo_nacional_']);
						$codigo_ibge = strip_tags($_POST['codigo_ibge_']);
				
						//SQL
						$sql = "INSERT INTO 
									CIDADE (CIDNOM,CIDNAC, CIDIBG, CIDUFCOD )
								VALUES
									('".$nome."', '".$codigo_nacional."','".$codigo_ibge."','".$estado."')";
						
						$result=oci_parse($conecta,$sql);
						
						try{
							if(oci_execute($result)){
								echo '<span class="delivery_span_email">Cidade incluída com sucesso</span>';
							}else{
								$erro = oci_error($result);
								//echo '<pre>';print_r($erro);echo '</pre>';
								echo 'Falha ao Gravar';
							}
						}catch(Excpetion $e){
							echo 'Erro inesperado';
						}
					}
				}
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir';
	}
	?>
