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
	$acessar = acessaTela(127, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			echo 'Variável descrição está vazia.';
		}else{
			if(!isset($_POST['abreviatura']) || empty($_POST['abreviatura'])){
				echo 'Variável Abreviatura está vazia';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$codigo 	 = strip_tags($_POST['codigo']);
				$abreviatura = strip_tags($_POST['abreviatura']);
				$codigo_pais = strip_tags($_POST['codigo_pais']);
				$descricao 	 = strip_tags($_POST['descricao']);
				
				//SQL
				$sql = "UPDATE UF SET 
						   UFCODPAIS = '$codigo_pais',
						   UFABREV = '$abreviatura',
						   UFNOM = '$descricao'
												  
						WHERE UFCOD = '$codigo'";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Estado salvo com sucesso</span>';
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
		}
	}else{
		echo 'Usuário não tem permissão para alterar';
	}
	
	?>
