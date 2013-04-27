<?php 
	//Inclui banco de dados
	error_reporting(0);
	include('php/classes/bd_oracle.class.php');
	
	
	include "../../../functions.php";
	
	
	
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('php/classes/session.class.php');
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('php/functions.php');
		
		//Inclui banco de dados
		include('php/classes/bd_oracle.class.php');
	}
?>

<link rel="stylesheet" type="text/css" href="../../../css/pages/pedido/pedido_relatorios.css" />
<script type="text/javascript" src="js/pages/pedido/pedido_relatorios.js"></script>


<!-- CRIAÇÃO DA TELA -->


<input type="button" value="LIMPAR" class="k-button" name="PedRel_BT_LIMPAR" />
<div id="PedRel_DIV"></div>