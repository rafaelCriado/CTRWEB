<?php
	error_reporting(0);
	if($_GET){
		
		//Inclui o banco de dados
		include "../../classes/bd_oracle.class.php";
		
		//Retorna o nome da empresa
		$codigo = $_GET['codigo_empresa'];
		echo $codigo;
		//Consulta
		$sql = "SELECT EMPCOD AS CODIGO,
					   EMPNOM AS RAZAO					   
				  FROM EMPRESA
				 WHERE EMPCOD = ".$codigo;
		
		$query_empresa = oci_parse($conecta,$sql);
		
		//Executa
		if(oci_execute($query_empresa)){
		
		//Recebe informação
		$empresa = oci_fetch_object($query_empresa);
		
		//Retorna Nome da empresa
		echo $empresa->CODIGO.' - '. $empresa->RAZAO;
		}
	}else{
		echo 'Erro de requisição';
	}
?>