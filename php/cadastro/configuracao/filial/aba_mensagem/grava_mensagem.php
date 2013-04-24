<?php 
	error_reporting(0);
	//UPDATE (CADASTROS -> CONFIGURAÇÃO - FILIAL - ABA_MENSAGEM)
	
	//Sessão
	include('../../../../classes/session.class.php');
	$sessao = new Session();
	
	//Banco	
	include('../../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../../functions.php");
	
	
	$fp = '';
	//Controle de Acesso
	$acessar = acessaTela(126, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){	
			
		$tipo 		= isset($_POST['tipo'])		?	$_POST['tipo']		:	0;
		$empresa 	= isset($_POST['empresa'])	?	$_POST['empresa']	:	0;
		$texto 		= isset($_POST['texto'])	?	$_POST['texto']		:	'';					
		
		switch($tipo){
		
			//SEM AREA DE ATUACAO
			case 1:
					//Uma empresa
					if($empresa != 0)$sql = "UPDATE EMPRESA SET MSG1 = '".$texto."' WHERE EMPCOD = ".$empresa;
					
					//Todas as empresas
					if($empresa == 0)$sql = "UPDATE EMPRESA SET MSG1 = '".$texto."'";	
					
					
					
				break;
				
		}	
		
			
		$result=oci_parse($conecta,$sql);
		
		try{
			if(oci_execute($result)){
				$texto = 'Mensagem gravada com Sucesso';
				$codigo = 1;
			}else{
				$texto =  'Falha ao Gravar';
				$codigo = 0;
			}
		}catch(Excpetion $e){
			$texto =  'Erro inesperado';
			$codigo = 0;
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
