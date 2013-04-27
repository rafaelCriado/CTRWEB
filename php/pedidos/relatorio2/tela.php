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

<link rel="stylesheet" href="css/pages/pedido/pedido_relatorio2.css" type="text/css">

<script type="text/javascript" src="js/pages/pedido/pedido_relatorio2.js"></script>


<!--------- DIV TOTAL TOP------->
<div id="PedRel2_top">

    <!-------- DIV ESQUERDA ------------>
    <div id="PedRel2_left"></div>
    
    <!-------- DIV DIREITA ------------->
    <div id="PedRel2_right"></div>
    
</div>


<div id="PedRel2_botton">

<input type="button" id="PedRel2_bt_enviar" class="k-button" value="Enviar">

</div>