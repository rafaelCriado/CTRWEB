<?php 
	error_reporting(0);
	
	//DELETE NA TABELA TIPO_PAGAMENTO (Cadastros -> FINANCEIROS -> TIPO DE PAGAMENTO)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(277, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			echo 'Variável descrição está vazia.';
		}else{
					
			//Grava no banco
			include('../../classes/bd_oracle.class.php');
			$codigo 	 = strip_tags($_POST['codigo']);
			$descricao 	 = strip_tags($_POST['descricao']);
			
			//SQL
			$sql = "UPDATE TIPO_PAGAMENTO
					   SET TIPPAGDES = '".$descricao."',
						   USUCOD    = ".$sessao->getNode('usuario_citrino')."
					 WHERE TIPPAGNUM = ".$codigo;
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo 'Tipo de Pagamento salvo com sucesso';
					
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Salvar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
		}
	}else{
		echo 'Usuário não tem permissão para alterar';
	}
	
	?>
