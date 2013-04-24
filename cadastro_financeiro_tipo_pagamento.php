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

	//CADASTRO FINANCEIRO FINANCEIRA
	$acessar = acessaTela(277, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						


	//Banco de dados
	include("php/classes/bd_oracle.class.php");
?>
<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_financeiro_tipo_pagamento.css">
    	<script type="text/javascript" src="js/pages/cadastro/cadastro_financeiro_tipo_pagamento.js"></script>
    </head>
    
	<body>
        <div id="tela_tipo_pagamento" class="k-content" style="height:100%">
            <?php include('php/cadastro/financeiro/tipo_pagamento/tela.php'); ?>
        </div>
	</body>
</html>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>
