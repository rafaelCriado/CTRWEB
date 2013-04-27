<?PHP

	include ('../../../php/classes/bd_oracle.class.php');
	
	$select="SELECT FP.FORPAGNUM AS CODIGO, FP.FORPAGDES AS NOME FROM FORMAS_PAGAMENTO FP";
	
	$query = oci_parse($conecta,$select);

	oci_execute($query);
	
	echo '<table><tr><td colspan=2>FORMAS DE PAGAMENTO</td></tr>';
	
	while($iten = oci_fetch_array($query)){
		
		echo '<tr><td>'.$iten['CODIGO'].'</td><td>'. $iten['NOME'].'</td></tr>';
	
		
	}
	echo '</table>';

?>