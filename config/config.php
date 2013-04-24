<?php
	//Página de configuração
	
	//Define o nome da empresa do site
	
	
	//Conecta no banco de dados
	$conexao = mysqli_connect('localhost','root','sft6033','sifat_web');
	
	if(!$conexao){
		echo 'Falha na Conexão com o Banco de Dados';
	}
?>