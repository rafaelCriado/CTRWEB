<?php
	include('../../../../../php/classes/session.class.php');
	$sessao = new Session();
	//Inclui banco da dados e funções
	include("../../../../../php/classes/bd_oracle.class.php");
	include('../../../../../php/functions.php');
	
	if($_GET){
		
		$codigo = $_GET['codigo'];
		
		
		if( $codigo == 3 ){
			
			//Cliente está fora da aréa de atuação de filiais
			echo 'Fora da area de cobertura de filiais';
			
		}
		
		
		if( $codigo == 2) {
			
			//Cliente faz parte da área de atuação de outra filial.
			$sql = 'SELECT MSG1 AS TEXTO FROM EMPRESA WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
			$query = oci_parse($conecta,$sql);
			
			if(oci_execute($query)){
				
				$row = oci_fetch_object($query);
				
				echo strtoupper(trim($row->TEXTO));
				
			}
			
		}
		
		
		
		
	}
	
	
?>