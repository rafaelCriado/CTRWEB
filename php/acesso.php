<?php
	
	include('classes/session.class.php');
	$sessao = new Session();
	
	
	error_reporting(0);
	require 'classes/bd_oracle.class.php';
	
	if($_GET){
		
		$empresa = $_GET['empresa'];
		
		//Pesquisa nome da empresa
		$sql = 'SELECT EMPNOM AS EMPRESA FROM EMPRESA WHERE EMPCOD = '.$empresa;
		
		$query = oci_parse($conecta, $sql);
		
		oci_execute($query);
		
		$result = oci_fetch_object($query);
		
		
		$sessao->addNode('empresa_acessada',$empresa);
		$sessao->addNode('empresa',$result->EMPRESA);
		
		
	}
	
?>