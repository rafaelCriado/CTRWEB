<?php 
	error_reporting(0);
	//UPDATE (FINANCEIRO -> CADASTROS -> FORMAS DE PAGAMENTO)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
	//Banco	
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//Controle de Acesso
	$acessar = acessaTela(137, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['novo_valor']) || empty($_POST['novo_valor'])){
			echo 'Valor Vazio não pode ser salvo.';
		}else{
			
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			
			//Recebe variaveis
			$codigo  = $_POST['condicao_pagamento_codigo'];
			$valor	 = $_POST['novo_valor'];
			$parcela = $_POST['parcela'];
			
			//Sql
			$sql = "UPDATE COND_PAG_PARC
					   SET CONPAGPARDIA = $valor
					 WHERE CONPAGCOD = $codigo
					   AND CONPAGPARSEQ = $parcela";
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo 'Alteração salva com sucesso';
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Gravar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
					
		}
	}else{
		echo 'Usuário não tem permissão para alterar!';
	}
	?>
