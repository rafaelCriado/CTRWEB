<?PHP 
	/* TELA DE PESQUISA DE ENTIDADE ******************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 23/01/2012 
		 modificações:
		 
	   **********************************************************************************************************/
	
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

	//CONTROLE DE ACESSO
	$acessar = acessaTela(129, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						


	//Banco de dados
	include("php/classes/bd_oracle.class.php");
?>
<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="css/pages/entidade/pesquisa_entidade_pessoa.css">
    	<script type="text/javascript" src="js/pages/entidade/pesquisa_entidade_pessoa.js"></script>
    </head>
    
	<body>
        <div id="form_pesquisa" class="k-content" style="height:100%">
            <?php include('php/entidade/pesquisa/tela_pessoa.php'); ?>
        </div>
	</body>
</html>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>
