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
	$acessar = acessaTela(297, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_GET['codigo']) || empty($_GET['codigo'])){
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
			
			//Recebe parametros
			$parametros = isset($_GET['parametros'])?$_GET['parametros']:'';
			
			$parametros_valor = explode('|',$parametros);
			
			$valida = 0;
			
			
			
			
			for($x=1; $x<count($parametros_valor); $x++){
				
				$sql = 'UPDATE CARTAO_CREDITO_PARAMETROS 
						   SET CARCREPARTAX 	= '.$parametros_valor[$x].'
					     WHERE 
						   CARCRECOD 	= '.$codigo.'
						   AND EMPCOD	= '.$sessao->getNode('empresa_acessada').'
						   AND CARCREPARNUM = '.$x;
					
				
				$insert = oci_parse($conecta,$sql);
					
				if(!oci_execute($insert,OCI_DEFAULT)){
					$valida = 1;	
				}
				
			}
			
			if($valida == 0){
				oci_commit($conecta);
				$texto = 'Alteração salva com sucesso';
				$codigo = 1;
			}else{
				ocirollback($conecta);
				$texto =  'Falha ao Gravar';
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