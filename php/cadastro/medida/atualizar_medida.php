<?php 
	//ADD_NOVA_EMPRESA(Cadastros -> EMPRESAS)
	//Validação
	
	error_reporting(0);
	//echo $_POST['site_'];
	//var_dump($_POST);
		//INSERT NA TABELA UNIDADE MEDIDA (Cadastros -> UNIDADE DE MEDIDA)
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(125, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['med']) || empty($_POST['med'])){
			echo 'Variável Medida está vazia.';
		}else{
			if(!isset($_POST['des']) || empty($_POST['des'])){
				echo 'Variável Descrição está vazia';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$medida		= strip_tags($_POST['med']);
				$descricao 	= strip_tags($_POST['des']);
				
				//SQL
				$sql = "UPDATE UNIDADE_MEDIDA SET 
						   UNIMEDCOD = '$medida',
						   UNIMEDDES = '$descricao'
												  
						WHERE UNIMEDCOD = '$medida'";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Unidade de medida salva com sucesso</span>';
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
		echo 'Usuario não tem permissão de realizar alteração.';
	}
	?>
