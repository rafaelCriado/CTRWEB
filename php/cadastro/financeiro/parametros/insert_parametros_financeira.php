<?php 
	error_reporting(0);
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	

	//Sessão
	include('../../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../../classes/bd_oracle.class.php');
	include '../../../functions.php';
	
	//Inicia Sessão
	$sessao = new Session();
	
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(258, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//Recebe informações
		if($_GET){
			$descricao 			= $_GET['descricao'];
			$qtde_parcelas 		= $_GET['qtde_parcelas'];
			$carencia 			= $_GET['carencia'];
			
			
			$parcela = array();
			$validar = 1;
			
			for($x = 1; $x<= $qtde_parcelas; $x++){
				
				$sql_parametro = "INSERT INTO FINANCEIRAS_PARCELAS
										  (FINCOD, FINPARNUM, FINPARCAR, USUCOD, EMPCOD,FINPARTOTPAR)
										VALUES
										  (".$descricao.", ".$x.", ".$carencia.", ".$sessao->getNode('usuario_citrino').", ".$sessao->getNode('empresa_acessada').",".$qtde_parcelas.")";
				$sql .=$sql_parametro;
				$insert_parametro = oci_parse($conecta,$sql_parametro);
				
				if(!oci_execute($insert_parametro,OCI_DEFAULT)){
					$validar=0;
				};
				
				
			}
			
			
			if($validar == 1){
				oci_commit($conecta);
				$texto = 'Parametros incluídos com sucesso!';
				$retorno = 1;
			}else{
				oci_rollback($conecta);
				$texto = 'Falha na inclusão';
				$retorno = 0;
			}
		}else{
				$texto = 'Falha na requisição das informações';
				$retorno = 0;
		}
	}else{
		
		$texto = 'Usuario não tem permissão para incluir';	
		$retorno = 0;
	}
	
	$parcela[] = array(
				'codigo_parametro_financeira' =>$retorno,
				'texto'						 =>$texto,
		);

	echo( json_encode( $parcela ) );

?>
