<?PHP 
	/* TELA DE CADASTRO DE EMPRESA ********************************************************************
	
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
	//banco de dados
	include('php/classes/bd_oracle.class.php');
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(126, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
        <link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_empresas.css" />
        <script src="js/pages/cadastro/cadastro_empresa.js" type="text/javascript"></script>

        <div id="input_nova_empresa" class="k-header">
            <h3>Nova Empresa</h3>
            <form name="nova_empresa">
                Razão Social: 	
                <input type="text" name="nova_empresa_razao" placeholder="ADM Citrino LDTDA" class="" maxlength="100">

                <br>
               	
                Nome Fantasia: 	
                <input type="text" name="nova_empresa_fantasia" placeholder="ADM Citrino"maxlength="100">
                
                <br>
                
                Sigla: 	
                <input type="text" name="nova_empresa_sigla" placeholder="ADMCit" maxlength="20">
                
                <br>            

                CNPJ: 	
                <input type="text" name="nova_empresa_cnpj" placeholder="00.696.700/1111-35" maxlength="14">
 
                <br>            
                
                Insc. Estadual: 	
                <input type="text" name="nova_empresa_ie" placeholder="95965465782314" maxlength="14">
                <br>  
                
                Endereço: 	
                <input type="text" name="nova_empresa_endereco" placeholder="Rua José Inacio de Padua" maxlength="150">
                <br>

                Número: 	
                <input type="text" name="nova_empresa_numero" placeholder="105" maxlength="10">
                <br>            

                Complemento: 	
                <input type="text" name="nova_empresa_complemento" placeholder="Casa" maxlength="50">
                <br>            

                Bairro: 	
                <input type="text" name="nova_empresa_bairro" placeholder="Centro" maxlength="30">
                <br>            
              
                CEP: 	
                <input type="text" name="nova_empresa_cep" placeholder="15190000" maxlength="8">
                <br>            
                    
                Estado:	
                <select name="nova_empresa_estado">
                	<option value="">ESTADO</option>
				<?php
					
					//Consulta de Cidades Cadastrados
					$query = oci_parse($conecta, 
						'SELECT UFCOD AS CODIGO, UFABREV AS ESTADO FROM UF'
						);
						
					oci_execute($query);
               
					while ($row = oci_fetch_object($query)) {
						echo '<option value="'.$row->CODIGO.'">'.textoFORMAT($row->ESTADO,15).'</option>';
					}
               	?>
                </select>
				<br>
                
                Cidade:	
                <select name="nova_empresa_cidade">
                	<option value="">Escolha um estado</option>
                </select>
                <br>
                
                Telefone: 	
                <input type="text" name="nova_empresa_telefone" placeholder="30300" maxlength="40">
                <br> 
                
                Email: 	
                <input type="text" name="nova_empresa_email" placeholder="rafael@citrino.com.br"  maxlength="100">
                <br>
  
                Site: 			
                <input type="text" name="nova_empresa_site" placeholder="www.admcitrino.com.br"  maxlength="100">
				<br />
                
                Indice Minimo: 			
                <input type="text" name="nova_empresa_indice_minimo" placeholder="1.75"  maxlength="100" title="Indice minimo de vendas">


                <br>
                <br><br />

                <input type="button" value="LIMPAR" name="nova_empresa_bt_limpar" class="k-button">
                <input type="button" value="CADASTRAR" name="nova_empresa_bt_cadastrar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_atualiza_empresa"></span>
        </div>
        
        <div id="tabela_empresas">
            <div id="retorno_nova_empresa">
            	<?php require_once 'php/cadastro/empresa/lista_de_empresas.php'; ?>
            </div>
        </div>
    </body>
</html>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>