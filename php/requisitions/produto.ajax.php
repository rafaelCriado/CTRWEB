<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	
	$valor = '';
	//Verifica se recebeu CPF por post
	if(isset($_POST['produto']) and !empty($_POST['produto'])){
		$valor .= "P.PROCOD LIKE '%".$_POST['produto']."%'";
	}
	//Verifica se recebeu CPF por post
	if(isset($_POST['texto']) and !empty($_POST['texto'])){
		$valor .= "P.PROCOD LIKE '%".$_POST['texto']."%'";
	}
	
	//Verifica se recebeu Nome por post
	if(isset($_POST['tipo_pesquisa']) and !empty($_POST['tipo_pesquisa'])){
		$valor .= "P.PRODES LIKE '%".$_POST['tipo_pesquisa']."%'";
	}

	//Verifica se recebeu Nome por post
	if(isset($_POST['grupo']) and !empty($_POST['grupo'])){
		$valor = "G.PROGRUDEN LIKE '%".$_POST['grupo']."%'";
	}

	
	
	
	$produto = array();
	
	$sql = "SELECT 	P.PROCOD AS CODIGO, 
					P.PRODES AS DESCRICAO,
					G.PROGRUCOD AS CODIGO_GRUPO, 
					G.PROGRUDEN AS GRUPO,
					S.PROSUBGRUCOD AS CODIGO_SUBGRUPO, 
					S.PROSUBGRUDEN AS SUBGRUPO,
					E.EMPCOD AS CODIGO_EMPRESA,
					E.EMPNOM AS EMPRESA
			  FROM 
					PRODUTO P
			  LEFT JOIN 
					PRODUTO_GRUPO G
				ON 
					P.PROGRUCOD = G.PROGRUCOD
			  LEFT JOIN 
					PRODUTO_SUBGRUPO S
				ON 
					S.PROSUBGRUCOD = P.PROSUBGRUCOD
			  LEFT JOIN
			  		EMPRESA E
				ON
					P.EMPCOD = E.EMPCOD
			  WHERE  ".$valor;
				  
	$res = oci_parse($conecta,$sql);
	oci_execute($res);
	$row = oci_fetch_assoc( $res );
	
	$produto = $row;
	
	
	echo( json_encode( $produto ) );
?>
