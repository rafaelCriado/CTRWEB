<?PHP 
	/* TELA DE CADASTRO DE CIDADES ******************************************************************************
	
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
	$acessar = acessaTela(128, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>

        <link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_cidades.css" />		    			
        <script src="js/pages/cadastro/cadastro_cidade.js" type="text/javascript"></script>

		<?php
			include('php/classes/bd_oracle.class.php'); 
	
			//Consulta Estados Cadastrados
			$query = oci_parse($conecta, 
				'SELECT 
					UFCOD AS CODIGO, 
					UPPER(UFNOM) AS ESTADO, 
					UPPER(UFABREV) AS ABREVIATURA, 
					UFCODPAIS AS PAIS_CODIGO 
				 FROM 
					UF
				 ORDER BY
					ABREVIATURA'
				);
				
			oci_execute($query);
        ?>
        <div id="input_nova_cidade" class="k-header" >
            <h3>Nova Cidade</h3>
            <form name="nova_cidade">
                            
                Estado:	<select name="nova_cidade_estado">
							<?php
                            	while ($row = oci_fetch_object($query)) {
                                	echo '<option value="'.$row->CODIGO.'">'.$row->ABREVIATURA.'</option>';
                               	}
                            ?>
                        </select><br /><br>
                Cidade: 			
                <input type="text" name="nova_cidade_cidade" placeholder="Mirassol" maxlength="100">
                <br><br>
                
                Código Nacional:
                <input type="text" name="nova_cidade_codigo_nacional" placeholder="30300">
                <br><br>
                
                Código IBGE: 			
                <input type="text" name="nova_cidade_codigo_ibge" placeholder="35">
                <br>
                <br>
                <br>
                <input type="button" value="LIMPAR" name="nova_cidade_bt_limpar" class="k-button">
                <input type="button" value="CADASTRAR" name="nova_cidade_bt_cadastrar" class="k-button">
            </form>
            
            <br>
            <br>
            
            <span class="resultado_nova_cidade"></span>
        
        </div>
        <div id="tabela_cidade">
            <div id="retorno_nova_cidade">
            	<?php require_once 'php/cadastro/cidade/lista_de_cidades.php'; ?>
            </div>
        </div>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>