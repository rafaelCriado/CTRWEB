<?php 
	$host = '186.202.121.227';
	$usuario = 'ddw';
	$senha = 'sql';
	if(!$conecta = oci_connect($usuario, $senha, $host)){echo 'Falha de conexão';}
?>