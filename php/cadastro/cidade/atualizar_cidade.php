<?php 
	error_reporting(0);
	
	//UPDATE NA TABELA CIDADE (Cadastros -> LOCALIDADE -> CIDADES)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(128, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['uf']) || empty($_POST['uf'])){
			echo 'Variável descrição está vazia.';
		}else{
			if(!isset($_POST['cid']) || empty($_POST['cid'])){
				echo 'Variável Abreviatura está vazia';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$codigo 	 	 = strip_tags($_POST['cod']);
				$estado 	 	 = strip_tags($_POST['uf']);
				$cidade 	 	 = strip_tags($_POST['cid']);
				$codigo_nacional = strip_tags($_POST['cnacional']);
				$codigo_ibge 	 = strip_tags($_POST['cibge']);
				
				//SQL
				$sql = "UPDATE CIDADE SET CIDNOM = '$cidade', CIDNAC = $codigo_nacional, CIDIBG = $codigo_ibge, CIDUFCOD = $estado WHERE CIDCOD =  $codigo";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Cidade salva com sucesso</span>';
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
		echo 'Usuário não tem permissão para atualizar!';
	}
	?>
