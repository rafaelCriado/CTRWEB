<?php 
	error_reporting(0);
	
	//DELETE NA TABELA EMPRESA (Cadastros -> EMPRESAS)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(257, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			echo 'Variável descrição está vazia.';
		}else{
			if(!isset($_POST['taxa']) || empty($_POST['taxa'])){
				echo 'Variável taxa está vazia';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$codigo 	 = strip_tags($_POST['codigo']);
				$taxa 		 = str_replace('.','',$_POST['taxa']);
				$taxa 		 = str_replace(',','.',$taxa);
				$descricao 	 = strip_tags($_POST['descricao']);
				
				//SQL
				$sql = "UPDATE FINANCEIRAS
						   SET FINNOM = '".$descricao."',
							   FINTAXABE = ".$taxa.",
							   USUCOD = ".$sessao->getNode('usuario_citrino')."
						 WHERE FINCOD = ".$codigo;
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Financeira salva com sucesso</span>';
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
