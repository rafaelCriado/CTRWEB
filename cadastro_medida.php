<?PHP 
	/* TELA DE CADASTRO DE UNIDADE DE MEDIDA ********************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 22/01/2012 
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
	$acessar = acessaTela(125, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
        	<html>
                <head>
                    <link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_medidas.css" />
                    <script src="js/pages/cadastro/cadastro_medida.js" type="text/javascript"></script>
                </head>
                <body>
                    <div id="input_nova_medida" class="k-header">
                        <h3>Nova Medida</h3>
                        <form name="nova_medida">
                                        
                            <span class="texto">Medida:	&nbsp;&nbsp;</span><br />
                            <input type="text" name="nova_medida_codigo" placeholder="M" maxlength="5">
                            <br /><br />

                
                            <span class="texto">Descrição: &nbsp;&nbsp;</span><br />

                            <input type="text" name="nova_medida_descricao" placeholder="Metro" maxlength="100">
                            <br>
                            <br>
                            <br>
                
                            <input type="button" value="LIMPAR"  name="nova_medida_bt_limpar"    class="k-button">
                            <input type="button" value="INCLUIR" name="nova_medida_bt_cadastrar" class="k-button">
                        </form>
                        <br><br>
                        <span class="resultado_nova_medida"></span>
                    </div>
                    <div id="tabela_medidas">
                        <div id="retorno_nova_medida">
                            <?php include('php/cadastro/medida/lista_de_medidas.php'); ?>
                        </div>
                    </div>
                </body>
            </html>
        <?PHP
	//Controle de Acesso
	}else{
		
		echo "<h3>Acesso negado para usuário</h3>";	
		
	}
?>