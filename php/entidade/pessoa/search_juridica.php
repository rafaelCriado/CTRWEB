<?php
	error_reporting(0);
	include('../../classes/bd_oracle.class.php'); 
	$q = $q = strtoupper($_GET["q"]);
	if (!$q) return;
	
$query_nome = oci_parse($conecta,"SELECT ENTNOM AS NOME, ENTNOMFAN AS FANTASIA FROM ENTIDADE WHERE ENTTIPPES = 'JURIDICA' AND ENTNOM LIKE '%$q%'");
oci_execute($query_nome);
while($entidade = oci_fetch_object($query_nome)){
	echo $entidade->NOME."\n";
}

?>