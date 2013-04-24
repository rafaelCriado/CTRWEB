<?php
	//Duplicidade
	foreach($var as $campo => $valor){
			
		$$campo = $valor;
		if(empty($$campo)){
			
			$$campo = ' ';
		}
		//echo $campo .'='. $valor. '<br>';
	}
	
	
	$sql_pesquisa = "SELECT E.ENTCOD AS CODIGO, E.ENTNOM AS NOME FROM ENTIDADE E WHERE E.ENTCNPJCPF = '$cpf_cnpj' AND E.ENTNOM LIKE '%$nome%' AND E.EMPCOD <> ".$sessao->getNode('empresa_acessada') ;
	
	$query_pesquisa = oci_parse($conecta,$sql_pesquisa);
	
	
	
	
	
?>