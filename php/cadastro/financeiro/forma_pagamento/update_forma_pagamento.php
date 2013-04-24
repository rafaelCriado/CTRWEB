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
	
	
	$fp = '';
	//Controle de Acesso
	$acessar = acessaTela(278, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_GET['id']) || empty($_GET['id'])){
			$texto = 'Valor Vazio não pode ser salvo.';
			$codigo = 0;
		}else{
			
			//Grava no banco
			include('../../classes/bd_oracle.class.php'); 
			
			//Recebe as variaveis por POST 
			$var = $_GET;
			
			foreach($var as $campo => $valor){
				
				$$campo = $valor;
				if(empty($$campo)){
					
					$$campo = '';
				}
				//echo $campo .'='. $valor. '<br>';
			}
			
			
			$cond = '';
			if(!empty($valor_max)){
				$cond .= "forpagvalmax = ".$valor_max.",";
			}else{
				$cond .= "forpagvalmax = NULL,";
			}
			if(!empty($parcela_max)){
				$cond .= "forpagmaxpar = ".$parcela_max.",";
			}else{
				$cond .= "forpagmaxpar = NULL,";
			}
			
			
			//Sql
			$sql = "update formas_pagamento
						   set forpagdes    = '".$descricao."',
							   ".$cond."
							   usucod       = ".$sessao->getNode('usuario_citrino')."
						 where forpagnum = ".$id;
						 
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					$texto = 'Alteração salva com sucesso';
					$codigo = 1;
				}else{
					$texto =  'Falha ao Gravar';
					$codigo = 0;
				}
			}catch(Excpetion $e){
				$texto =  'Erro inesperado';
				$codigo = 0;
			}
					
		}
	}else{
		$texto = 'Usuário não tem permissão para alterar!';
		$codigo = 0;
	}
	
	$fp = array(
		'texto'  => $texto,
		'codigo' => $codigo
	);
	
	echo json_encode($fp);
	?>
