<?php
	/*===============================================================================================================
				Objetivo		:		Retorna os dados de uma determinada ficha tecnica.
				formato			:		JSON
				Autor			:		Rafael Marques Criado
				Criada em		:		28/01/2013
				modificações	:		
	================================================================================================================= */
	
	//Inclui banco da dados e funções
	include('../../../php/classes/bd_oracle.class.php');
	$ficha_tecnica = array();

	if($_GET){
		
		$codigo_ficha_tecnica = $_GET['codigo'];
		$texto = 'Erro';
		$retorno = 0;
		
		//Consulta as fichas tecnicas existentes
		$sql = 'SELECT FT.EMPCOD       AS CODIGO_EMPRESA,
					   E.EMPNOM        AS EMPRESA,
					   FT.FICTECCOD    AS CODIGO_FICHA_TECNICA,
					   FT.PROCOD       AS CODIGO_PRODUTO,
					   P.PRODES        AS PRODUTO,
					   PG.PROGRUCOD    AS CODIGO_GRUPO,
					   PG.PROGRUDEN    AS GRUPO,
					   PS.PROSUBGRUCOD AS CODIGO_SUBGRUPO,
					   PS.PROSUBGRUDEN AS SUBGRUPO,
					   FT.FICTECDATCAD AS DATA_CADASTRO,
					   FT.FICTECOBS    AS OBSERVACAO_FICHA_TECNICA,
					   FT.USUCOD       AS CODIGO_USUARIO
				  FROM FICHA_TECNICA FT, EMPRESA E, PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS
				 WHERE FT.EMPCOD = E.EMPCOD
				   AND FT.PROCOD = P.PROCOD
				   AND P.PROGRUCOD = PG.PROGRUCOD(+)
				   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD(+)
				   AND FT.FICTECCOD = '.$codigo_ficha_tecnica;
		
		//Prepara query
		$query = oci_parse($conecta,$sql);
		
		//executa
		oci_execute($query);
		
		//mostra resultado
		$ficha = oci_fetch_object($query);
		
		if(isset($ficha->CODIGO_FICHA_TECNICA) and !empty($ficha->CODIGO_FICHA_TECNICA)){
			$ft_codigo = 1;
			$ficha_tecnica = array
			(
				'codigo_retorno'			=>	1,
				'CODIGO_EMPRESA' 			=> 	$ficha->CODIGO_EMPRESA,
				'EMPRESA' 					=> 	$ficha->EMPRESA,
				'CODIGO_FICHA_TECNICA' 		=> 	$ficha->CODIGO_FICHA_TECNICA,
				'CODIGO_PRODUTO' 			=> 	$ficha->CODIGO_PRODUTO,
				'CODIGO_GRUPO' 				=> 	$ficha->CODIGO_GRUPO,
				'CODIGO_SUBGRUPO' 			=> 	$ficha->CODIGO_SUBGRUPO,
				'PRODUTO' 					=> 	$ficha->PRODUTO,
				'GRUPO' 					=> 	$ficha->GRUPO,
				'SUBGRUPO' 					=> 	$ficha->SUBGRUPO,
				'DATA_CADASTRO' 			=> 	$ficha->DATA_CADASTRO,
				'OBSERVACAO_FICHA_TECNICA' 	=> 	$ficha->OBSERVACAO_FICHA_TECNICA,
				'CODIGO_USUARIO' 			=> 	$ficha->CODIGO_USUARIO	
			);			
			
			
		}else{
			$texto = 'Ficha Tecnica não existe';
			$retorno = 0;
		}
	}else{
		$texto = 'Falha ao receber os dados';
		$retorno = 0;
	}
	
	
	if(!isset($ft_codigo)){
		$ficha_tecnica = array
		(
			'texto'				=>	$texto,
			'codigo_retorno'	=>  $retorno
		);
	}
	echo json_encode($ficha_tecnica);
?>