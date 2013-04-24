<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	
	$id = isset($_POST['id'])?$_POST['id']:'';
		
	if(!empty($id)){
			
		$variaveis = explode('|',$id);
		
		$financeira = array();
		
		$sql = "SELECT (FP.FINPARTOTPAR||'|'||FP.FINPARCAR||'|'||F.FINCOD)       AS CODIGO,
					   FP.FINPARNUM    AS PARCELA,
					   FP.FINPARCAR    AS CARENCIA,
					   FP.FINPARIND    AS INDICE,
					   FP.USUCOD       AS USUARIO,
					   FP.EMPCOD       AS EMPRESA,
					   FP.FINPARTOTPAR AS TOTAL_PARCELAS,
					   F.FINNOM        AS NOME
				  FROM FINANCEIRAS_PARCELAS FP, FINANCEIRAS F
				 WHERE FP.FINCOD = F.FINCOD
				   AND FP.FINCOD = ".$variaveis[2]."
				   AND FP.FINPARCAR = ".$variaveis[1]."
				   AND FP.FINPARTOTPAR = ".$variaveis[0];
					  
		$res = oci_parse($conecta,$sql);
		oci_execute($res);
		$row = oci_fetch_assoc( $res );
		
		$financeira = $row;
		
		
		echo( json_encode( $financeira ) );
	}
?>
