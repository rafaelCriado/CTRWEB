<?PHP 
	/* TELA DE CADASTRO DE USUARIOS ******************************************************************************
	
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
	$acessar = acessaTela(131, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
 		include('php/classes/bd_oracle.class.php'); 
		?>
		
        <link rel="stylesheet" type="text/css" href="css/pages/usuario/controle_usuarios_cadastrar.css" />		    			
		<script src="js/pages/usuario/controle_usuario_cadastrar.js" type="text/javascript"></script>

                
        <div id="input_novo_usuario" class="k-header">
            <h3>Novo Usuário</h3>
            <form name="novo_usuario">
                            
                Nome: &nbsp;&nbsp;
                <input type="text" name="novo_usuario_nome" placeholder="Usuário" maxlength="12">
				<br><br>
                
                Senha: &nbsp;&nbsp;			
                <input type="password" name="novo_usuario_senha" placeholder="Senha" maxlength="8">
                <br><br>
                
                Cargo: &nbsp;&nbsp;	
                <input type="text" name="novo_usuario_cargo" placeholder="Operador" maxlength="50">
                <br><br>
                
                Grupo:
                <select name="novo_usuario_grupo">
                	<option value="">Sem Grupo</option>
                	<?php
						//Consulta grupos de usuario
						$query_grupo = oci_parse($conecta,"SELECT USUGRUCOD AS CODIGO, USUGRUDESC AS DESCRICAO FROM USUARIO_GRUPO");
						
						//Executa
						oci_execute($query_grupo);
						
						//Recebe Resultado
						while($row_grupo = oci_fetch_object($query_grupo)){
							echo '<option value="'.$row_grupo->CODIGO.'">'.$row_grupo->DESCRICAO.'</option>';
						}
					?>
                </select>
                <br>
                <br>
                <br>
                    
                <input type="button" value="LIMPAR" name="novo_usuario_bt_limpar" class="k-button">
                <input type="button" value="CADASTRAR" name="novo_usuario_bt_cadastrar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_novo_usuario"></span>
        </div>
        
        <div id="list_usuarios">
            <div id="retorno_novo_usuario">
                <?php require_once 'php/controle_usuario/cadastrar/lista_de_usuarios.php'; ?>
            </div>
        </div>   


<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>