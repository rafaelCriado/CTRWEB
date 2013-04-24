<?PHP 
	/* TELA DE CADASTRO DE TIPOS DE ENTIDADE*********************************************************************
	
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
	$acessar = acessaTela(130, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	
	if(validaAcesso($acessar)){						
		?>

        <link rel="stylesheet" type="text/css" href="css/pages/entidade/cadastro_entidade_tipos.css" />
        <script src="js/pages/entidade/cadastro_entidade_tipo.js" type="text/javascript"></script>

        <div id="input_nova_categoria_entidade" class="k-header">
            <h3>Categoria de Pessoas</h3>
            <form name="nova_categoria_entidade">

                Descrição: 	
                <input type="text" name="nova_categoria_entidade_descricao" placeholder="Descrição" maxlength="100">
               <br><br>
               	
                Classificação: 	
                      	<select name="nova_categoria_entidade_classificacao">
							<option value="OUT">Outros</option>
							<option value="CLI">Clientes</option>
							<option value="FOR">Fornecedores</option>
							<option value="TRA">Transportadoras</option>
							<option value="REP">Representantes</option>
                        </select><br />
                    <br>
                    <br><br />
                    <input type="button" value="LIMPAR" name="nova_categoria_entidade_bt_limpar" class="k-button">
                    <input type="button" value="CADASTRAR" name="nova_categoria_entidade_bt_cadastrar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_tipo_entidade"></span>
        </div>
        <div id="tabela_entidade_tipo">
            <div id="retorno_novo_tipo_entidade">
            	<?php require_once 'php/entidade/tipo/lista_de_tipo_entidades.php'; ?>
            </div>
        </div>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>