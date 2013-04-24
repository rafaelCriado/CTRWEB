<?php 
	error_reporting(0);
	
	//INSERT NA TABELA PRODUTO_GRUPO(Cadastros -> PRODUTOS -> TABELA DE PREÇOS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(158, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		if($sessao->checkNode('empresa_acessada') == FALSE){
			echo 'Erro ao acessar empresa';
		}else{
		
			if(!isset($_POST['tabela_preco']) || empty($_POST['tabela_preco'])){
				echo 'Variável tabela de preço está vazia';
			}else{
						
				//Grava no banco
				include('../../classes/bd_oracle.class.php'); 
				$empresa 				= $sessao->getNode('empresa_acessada');
				$tabela_preco 			= strip_tags($_POST['tabela_preco']);
		
				//SQL
				$sql = "INSERT INTO TABELA_PRECO
  								(EMPCOD, TABPREDEN, USUCOD)
							 VALUES
								  	(".$empresa.",'".$tabela_preco."',".$sessao->getNode('usuario_citrino').")";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Tabela incluída com sucesso</span>';
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