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
	$acessar = acessaTela(137, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//Recebe informações
		if($_GET){
			$descricao 			= $_GET['descricao'];
			$qtde_parcelas 		= $_GET['qtde_parcelas'];
			$primeira_parcela 	= $_GET['primeira_parcela'];
			$diferenca_parcela 	= $_GET['diferenca_parcela'];
			$condicao_pagamento = isset($_GET['condicao_pagamento'])?explode('|',$_GET['condicao_pagamento']):'';
			$forma_pagamento = !empty($_GET['forma_pagamento'])?$_GET['forma_pagamento']:'NULL';
			
			if($_GET['condicao_pagamento'] != ''){
				
				$cp_codigo   = $condicao_pagamento[2];
				$cp_carencia = $condicao_pagamento[1];
				$cp_parcela  = $condicao_pagamento[0];
				
			}else{
				
				$cp_carencia = "''";
				$cp_codigo   = "''";
				$cp_parcela  = "''";
				
			}
			
			
			$parcela = array();
			
			//Insere CONDIÇÂO DE PAGAMENTO
			$sql = "INSERT INTO COND_PAG
					  (CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
					VALUES
					  ('".$descricao."', ".$qtde_parcelas.", ".$diferenca_parcela.", ".$primeira_parcela.", ".$sessao->getNode('usuario_citrino').",".$cp_codigo.",".$cp_carencia.",".$cp_parcela.",".$forma_pagamento.",".$sessao->getNode('empresa_acessada').")";
			
			//Prepara inserção
			$insert_condicao = oci_parse($conecta,$sql);
			
			if(oci_execute($insert_condicao)){
				//Incluido com sucesso
				
				$texto = 'Incluido com Sucesso';
				
				//Pesquisa código da condição de pagamento
				$sql_condicao = "SELECT CONPAGCOD AS CODIGO 
								   FROM COND_PAG 
								  WHERE CONPAGDEN = '".$descricao."' 
								    AND CONPAGQTDPAR = ".$qtde_parcelas."
									AND CONPAGDIAPAR = ".$diferenca_parcela."
									AND CONPAGDIAPRIPAR = ".$primeira_parcela."
									AND USUCOD = ".$sessao->getNode('usuario_citrino')."
									AND ROWNUM <=1
							   ORDER BY CONPAGCOD DESC";
							   
				$query_condicao = oci_parse($conecta,$sql_condicao);
				
				oci_execute($query_condicao);
				
				$condicao = oci_fetch_object($query_condicao);
				
				$retorno = $condicao->CODIGO;
			}else{
				//Falha na inclusão
				$texto = 'Falha na inclusão'.$_GET['condicao_pagamento'];
				$retorno = 0;
			}
		}
	}else{
		
		$texto = 'Usuario não tem permissão para incluir';	
		$retorno = 0;
	}
	
	$parcela[] = array(
				'condigo_condicao_pagamento' =>$retorno,
				'texto'						 =>$texto,
		);

	echo( json_encode( $parcela ) );

?>
