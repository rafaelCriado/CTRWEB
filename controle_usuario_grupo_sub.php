<?PHP 
	/* TELA DE CADASTRO DE GRUPOS DE USUARIO  *******************************************************************
	
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
	$acessar = acessaTela(134, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		
		include('php/classes/bd_oracle.class.php');
		
		?>
        
        
        
        <link rel="stylesheet" type="text/css" href="css/pages/usuario/controle_usuario_grupos_sub.css">
		<script src="js/pages/usuario/controle_usuario_grupo_sub.js" type="text/javascript"></script>

        <div id="input_novo_grupo_usuario" class="k-header">
            <h3>Novo Grupo de Usuário</h3>
            <form name="novo_grupo_usuario">
               	             
                Descrição: 			
                <input type="text" name="novo_grupo_usuario_descricao" placeholder="Grupo" maxlength="100">
                
                <br>
                <br>
                <br>
                
                <input type="button" value="LIMPAR"  name="novo_grupo_usuario_bt_limpar"    class="k-button">
                <input type="button" value="INCLUIR" name="novo_grupo_usuario_bt_cadastrar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_novo_grupo_usuario"></span>
        </div>
        <div class="div_novo_grupo_usuario">
            <div id="retorno_novo_grupo_usuario">
                <?php require 'php/controle_usuario/grupo/lista_de_grupo_usuarios.php'; ?>
            </div>
		</div>
<?PHP
	}else{
		
		echo "<h4>Acesso negado para usuário</h4>";	
		
	}
?>