<?php 
	//ADD_NOVA_EMPRESA(Cadastros -> EMPRESAS)
	//Validação
	
	error_reporting(0);

	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						

		if(!isset($_POST['grupo']) || empty($_POST['grupo'])){
			echo 'Variável Grupo está vazia.';
		}else{
			if($sessao->checkNode('empresa_acessada') == FALSE){
				echo 'Erro ao localizar empresa!';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$codigo		= strip_tags($_POST['codigo']);
				$empresa 	= $sessao->getNode('empresa_acessada');
				$grupo		= strip_tags($_POST['grupo']);

				//SQL
				$sql = "UPDATE PRODUTO_GRUPO
						   SET EMPCOD = ".$empresa.",
							   PROGRUDEN = '".$grupo."',
							   USUCOD = ".$sessao->getNode('usuario_citrino')."
						 WHERE PROGRUCOD = ".$codigo;
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Grupo salvo com sucesso</span>';
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
