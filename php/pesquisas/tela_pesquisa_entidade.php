<?php 
	//Perguntas
	
	include('../classes/bd_oracle.class.php');
	
	//Pesquisa pergunta
	$sql_pergunta  = 'SELECT PESPERCOD AS CODIGO , PESPERDES AS DESCRICAO, EMPCOD AS EMPRESA, USUCOD AS USUARIO FROM PESQUISAS_PERGUNTAS WHERE PESPERCOD = 1';
	
	$query_pergunta = oci_parse($conecta,$sql_pergunta);
	
	
	$respostas = array();

	if(oci_execute($query_pergunta)){
		
		$pergunta = oci_fetch_object($query_pergunta);
		
		
		//Pesquisa opções
		$sql_opcoes = 'SELECT PESPEROPCOD AS CODIGO, PESPEROPDES AS DESCRICAO FROM PESQUISAS_PERGUNTAS_OPCOES WHERE PESPERCOD = '.$pergunta->CODIGO;
		
		$query_opcoes = oci_parse($conecta,$sql_opcoes);
		
		if(oci_execute($query_opcoes)){
			
			while($opcoes = oci_fetch_object($query_opcoes)){
				
				$respostas[$opcoes->CODIGO] = $opcoes->DESCRICAO;
				
			}
				
		}
	}
?>


<div style=" height:100%; width:100%; background:#666">
	asdfdsdd
</div>