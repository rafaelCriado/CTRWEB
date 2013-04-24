<?php 
	//INSERT NA TABELA UNIDADE MEDIDA (Cadastros -> UNIDADE DE MEDIDA)
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(125, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		error_reporting(0);
		
		if(!isset($_POST['codigo_']) || empty($_POST['codigo_'])){
			echo 'Variável medida está vazia.';
		}else{
			if(!isset($_POST['descricao_']) || empty($_POST['descricao_'])){
				echo 'Variável descrição está vazia';
			}else{
				//Grava no banco
				$codigo = strip_tags($_POST['codigo_']);
				$descricao = strip_tags($_POST['descricao_']);
		
				//SQL
				$sql = "INSERT INTO 
							UNIDADE_MEDIDA (UNIMEDCOD, UNIMEDDES)
						VALUES
							('".$codigo."', '".$descricao."')";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Unidade de Medida incluída com sucesso</span>';
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
	}else{
		echo 'Usuário não tem permissão para incluir';
	}
	?>
