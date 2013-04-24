<?php
	/* ================================================================================
			objetivo	:		Inserir ficha tecnica no banco
			autor		:		Rafael Marques Criado
			criado em	:		28/01/2013
				
	   ================================================================================ */
	   
	   
	error_reporting(0);
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	

	//Sessão
	include('../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../classes/bd_oracle.class.php');
	include('../../functions.php');
	
	//Inicia Sessão
	$sessao = new Session();
	
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(197, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//Recebe informações
		if($_POST){
			$produto 			= $_POST['produto'];
			$observacao			= '';
			
			$ficha_tecnica = array();
			
			//Insere CONDIÇÂO DE PAGAMENTO
			$sql = "INSERT INTO FICHA_TECNICA
					  (EMPCOD, PROCOD, FICTECDATCAD, FICTECOBS, USUCOD)
					VALUES
					  (".$sessao->getNode('empresa_acessada').", ".$produto.", TRUNC(SYSDATE), '".$observacao."', ".$sessao->getNode('usuario_citrino').")";
			
			//Prepara inserção
			$insert_ficha = oci_parse($conecta,$sql);
			
			if(oci_execute($insert_ficha)){
				//Incluido com sucesso
				
				$texto = 'Incluido com Sucesso';
				
				//Pesquisa código da condição de pagamento
				$sql_ficha_tecnica = "SELECT 	MAX(FT.FICTECCOD) AS CODIGO
										  FROM 	FICHA_TECNICA FT
										 WHERE 	FT.USUCOD = ".$sessao->getNode('usuario_citrino');
							   
				$query_ficha_tecnica = oci_parse($conecta,$sql_ficha_tecnica);
				
				oci_execute($query_ficha_tecnica);
				
				$ficha = oci_fetch_object($query_ficha_tecnica);
				
				$retorno = $ficha->CODIGO;
			}else{
				//Falha na inclusão
				$texto = 'Falha na inclusão';
				$retorno = 0;
			}
		}
	}else{
		
		$texto = 'Usuario não tem permissão para incluir';	
		$retorno = 0;
	}
	
	$ficha_tecnica[] = array(
				'codigo_retorno' 		 	=>$retorno,
				'texto'						 =>$texto,
		);

	echo( json_encode( $ficha_tecnica ) );

?>
