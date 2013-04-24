<?php

	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	
	
	if(isset($_GET['cliente'])){
		
		$cliente = $_GET['cliente'];
		
		
		//Consulta cidade de cliente ===========================================
		$sql_cliente = 'SELECT ENTCOD AS CODIGO, CIDCOD AS CIDADE
						  FROM ENTIDADE
						 WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').'
						   AND ENTCOD = '.$cliente;
		
		$query_cliente = oci_parse($conecta,$sql_cliente);
		
		
		if(oci_execute($query_cliente)){
			
			//Informações do cliente
			$cli = oci_fetch_object($query_cliente);
			
			$codigo_cliente = $cli->CODIGO;
			$cidade_cliente = $cli->CIDADE;
			
		}
		// =====================================================================
		
		// Consulta cidades de atuação da empresa logada pelo usuário ==========
			$sql_atuacao = 'SELECT CIDCOD AS CODIGO, EMPCOD AS EMPRESA FROM EMPRESA_ATUACAO';
			
			$query_atuacao = oci_parse($conecta,$sql_atuacao);
			
			if(oci_execute($query_atuacao)){
				
				
				$area = array();
				
				$x = 0;
				//Areas de atuação
				while($cidades_empresa = oci_fetch_object($query_atuacao)){
						
					$area[$x]['CIDADE'] 	= $cidades_empresa->CODIGO;
					$area[$x]['EMPRESA'] 	= $cidades_empresa->EMPRESA;
					$x++;
					
				}
				
			}
		// =====================================================================
		
		$retorno = 0;
		// Verifica se cidade de cliente esta no array das cidades da empresa ==
			foreach($area as $campo => $valor){

				if($valor['CIDADE'] == $cidade_cliente){
					
					if($valor['EMPRESA'] == $sessao->getNode('empresa_acessada')){
						
						//Cliente esta na area de atuação da filial logada
						$retorno = 1;
						
					}else{
						
						//Cliente faz parte da area de atuação de outra filial
						$retorno = 2;	
						
					}
					
				}
				
			}
		// =====================================================================
		
		// Cliente não está na area de atuação de nenhuma filial cadastrada. ===
			
			if($retorno == 0)$retorno = 3;
		
		// =====================================================================
		
		echo $retorno ;
		
	}
?>