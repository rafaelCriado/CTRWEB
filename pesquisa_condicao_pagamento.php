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
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_financeiro_pesquisa_condicao_pagamento.css">
    	<script type="text/javascript" src="js/pages/cadastro/cadastro_financeiro_pesquisa_condicao_pagamento.js"></script>
    </head>
    
	<body>
        <div id="form_pesquisa_condicao_pagamento" class="k-content" style="height:100%">
            <?php include('php/cadastro/financeiro/pesquisa/tela_condicao_pagamento.php'); ?>
        </div>
	</body>
</html>
