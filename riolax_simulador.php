<?PHP 
	//Caso não exista sessão faça (Necessário devido efeito de alteração
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
	//Banco de dados
	include("php/classes/bd_oracle.class.php");
?>
<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="modulos/riolax/pedido/simulador/css/cadastro_financeiro_pesquisa.css">
    	<script type="text/javascript" src="modulos/riolax/pedido/simulador/js/cadastro_financeiro_pesquisa.js"></script>
    </head>
    
	<body>
        <div id="form_pesquisa_financeiro" class="k-content" style="height:100%">
            <?php include('modulos/riolax/pedido/simulador/php/tela.php'); ?>
        </div>
	</body>
</html>