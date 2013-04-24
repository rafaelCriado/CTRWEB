<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	
	$id = isset($_POST['id'])?$_POST['id']:'';
		
	if(!empty($id)){
			
		
		
		$condicao_pagamento = array();
		
		$sql = 'SELECT C.CONPAGCOD 		 AS CODIGO,
					   C.CONPAGDEN       AS NOME,
					   C.CONPAGQTDPAR    AS "QUANTIDADE DE PARCELAS",
					   C.CONPAGDIAPRIPAR AS "PRIMEIRA PARCELA",
					   F.FINNOM          AS FINANCEIRA
				  FROM COND_PAG C, FINANCEIRAS F
				 WHERE F.FINCOD(+) = C.FINCOD
				   AND C.CONPAGCOD = '.$id;
					  
		$res = oci_parse($conecta,$sql);
		oci_execute($res);
		$row = oci_fetch_assoc( $res );
		
		$condicao_pagamento = $row;
		
		
		echo( json_encode( $condicao_pagamento ) );
	}
?>
