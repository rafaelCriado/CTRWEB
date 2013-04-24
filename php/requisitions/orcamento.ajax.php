<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	
	$valor = '';
	//Verifica se recebeu CPF por post
	$numero = isset($_POST['codigo'])?$_POST['codigo']:'';
		


	
	
	
	$ORCAMENTO = array();
	
	$sql = "SELECT O.ORCCOD AS NUMERO,
				   O.EMPCOD AS EMPRESA,
				   O.ORCDATCAD AS DATA_CADASTRADA,
				   O.ORCDAT AS DATA_ORCAMENTO,
				   O.ENTCOD AS CODIGO_CLIENTE,
				   E.ENTNOM AS NOME,
				   O.ORCDATVAL AS DATA_VENCIMENTO,
				   O.ORCPRAENT AS PRAZO_ENTREGRA,
				   O.CONPAGCOD AS CONDICAO_PAGAMENTO,
				   O.ORCPERDES1 AS DESCONTO,
				   O.ORCPERDES2,
				   O.ORCPERDES3,
				   O.ORCVALFRE AS FRETE,
				   O.ORCVALTOT AS TOTAL,
				   O.USUCOD AS USUARIO,
				   O.ORCOBS AS OBSERVACAO,
				   O.ORCSTA AS STATUS,
				   O.ORCVALADI AS VALOR_ADICIONAL
			  FROM ORCAMENTO O, ENTIDADE E
			  WHERE O.ENTCOD = E.ENTCOD
			  AND O.ORCCOD = ".$numero;
				  
	$res = oci_parse($conecta,$sql);
	oci_execute($res);
	$row = oci_fetch_assoc( $res );
	
	$ORCAMENTO = $row;
	
	
	echo( json_encode( $ORCAMENTO ) );
	
?>
