<?PHP 
	/* TELA DE CADASTRO DE ESTADOS ******************************************************************************
	
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
	$acessar = acessaTela(127, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
		
        <link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_estados.css" />
        <script src="js/pages/cadastro/cadastro_estado.js" type="text/javascript"></script>
       
        <div id="input_novo_estado" class="k-header">
            <h3>Novo Estado</h3>
            <form name="novo_estado">
                            
                Descrição:	
                <input type="text" name="novo_estado_nome" placeholder="São Paulo" maxlength="60" >
                <br><br />

                Abreviatura: 			
                <input type="text" name="novo_estado_abreviatura" placeholder="SP" maxlength="2" >
                <br><br />

                Código do País: 	
                <input type="text" name="novo_estado_pais" placeholder="5659" maxlength="4" >

                <br>
                <br>
                
                <input type="button" value="LIMPAR" name="novo_estado_bt_limpar"  class="k-button">
                <input type="button" value="INCLUIR" name="novo_estado_bt_cadastrar" class="k-button">
            </form>
            <br>
            <br>
            
            <span class="resultado_novo_estado"></span>
        </div>
        
        <div id="tabela_estado">
            <div id="retorno_novo_estado">
                <?php require 'php/cadastro/estado/lista_de_estados.php'; ?>
            </div>
        </div>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>