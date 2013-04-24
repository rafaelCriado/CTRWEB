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

	//CADASTRO FINANCEIRO PARAMETROS DO CARTÃO DE CREDITO
	$acessar = acessaTela(297, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						


	//Banco de dados
	include("php/classes/bd_oracle.class.php");
?>
<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="css/pages/financeiro/financeiro_cartoes_parametros.css">
    	<script type="text/javascript" src="js/pages/financeiro/financeiro_cartoes_parametros.js"></script>
    </head>
    
	<body>
        <div id="tela_parametro_cartao_credito" class="k-content" style="height:100%">
            <?php include('php/financeiro/cartoes/parametros/tela.php'); ?>
        </div>
	</body>
</html>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>
