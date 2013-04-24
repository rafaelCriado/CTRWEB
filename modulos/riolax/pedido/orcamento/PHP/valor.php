<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../../../../../php/classes/bd_oracle.class.php');
	
	$grupo 			= $_GET['grupo'];
	$subgrupo 		= $_GET['subgrupo'];
	$medidas 		= $_GET['medidas'];
	$linhas 		= $_GET['linhas'];
	$acabamentos 	= $_GET['acabamentos'];
	$cor 			= $_GET['cor'];
	$posicao 		= $_GET['posicao'];
	$voltagem 		= $_GET['voltagem'];
	
	
	
	$cores = array();
	
	$sql = "SELECT P.PROCOD CODIGO,
				   P.PROCODALT CODIGO_ALTERNATIVO,
				   P.PRODES DESCRICAO,
				   TP.TABPRECOD TABELA_PRECO_CODIGO,
				   TP.TABPREDEN AS TABELA_PRECO,
				   TO_CHAR((TPI.TABPREITEVAL), '999999999999.99') AS PRECO_VENDA,
				   TO_CHAR((P.PROVALCUS * E.EMPINDVALMIN),'999999999999999.99') AS PRECO_MINIMO,
				   TO_CHAR(((TPI.TABPREITEVAL/100)-(P.PROVALCUS * E.EMPINDVALMIN)),'99999999999.99') AS LUCRO
			  FROM PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS, EMPRESA E,TABELA_PRECO TP, TABELA_PRECO_ITEM TPI
			 WHERE P.PROGRUCOD = PG.PROGRUCOD
			   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD
			   AND P.EMPCOD = E.EMPCOD
			   AND P.PROCOD = TPI.PROCOD
			   AND TPI.TABPRECOD = TP.TABPRECOD
			   AND PG.PROGRUCOD = ".$grupo."
         	   AND PS.PROSUBGRUCOD = ".$subgrupo."
			   AND (P.PROCOM || 'x' || P.PROLAR || 'x' || P.PROALT) = '".$medidas."'
			   AND P.PROCAR1 = '".$linhas."'
			   AND P.PROMAT = '".$acabamentos."'
			   AND UPPER(P.PROCOR) = '".$cor."'
			   AND P.PROCAR2 = '".$posicao."'
			   AND P.PROCAR3 = '".$voltagem."'
			   AND TP.TABPRECOD = 1";
			   
	$res = oci_parse($conecta,$sql);
	oci_execute($res);
	while ( $row = oci_fetch_assoc( $res ) ) {
		$cores[] = array(
			'VALOR'	=> $row['PRECO_VENDA'],
			
		);
	}
	
	
	echo( json_encode( $cores ) );
?>