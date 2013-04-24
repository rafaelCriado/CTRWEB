<?php 
	//error_reporting(0);
	
	//INSERT NA TABELA PRODUTO_GRUPO(Cadastros -> PRODUTOS -> GRUPOS\SUBGRUPOS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		
		if($sessao->checkNode('empresa_acessada') == FALSE){
			echo 'Variável Empresa está vazia.';
		}else{
			if(!isset($_POST['grupo']) || empty($_POST['grupo'])){
				echo 'Variável Grupo está vazia';
			}else{
				if(!isset($_POST['subgrupo']) || empty($_POST['subgrupo'])){
					echo 'Variável SubGrupo está vazia';
				}else{
							
					//Grava no banco
					include('../../classes/bd_oracle.class.php'); 
					$empresa 				= $sessao->getNode('empresa_acessada');;
					$grupo		 			= strip_tags($_POST['grupo']);
					$subgrupo				= strip_tags($_POST['subgrupo']);
					
					//SQL
					$sql = "INSERT INTO PRODUTO_SUBGRUPO
								  (EMPCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
							VALUES
								  (".$empresa.", '".$subgrupo."', ".$grupo.", ".$sessao->getNode('usuario_citrino').")";
								  
					$result = oci_parse($conecta,$sql);
					
					try{
						if(oci_execute($result)){
							echo '<span class="delivery_span_email">Sub-Grupo incluído com sucesso</span>';
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
	}else{
		echo 'Usuário não tem permissão para incluir';
	}

	?>
