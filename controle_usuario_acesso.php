<?PHP 
	/* TELA DE CADASTRO DE TELAS DO SISTEMA  ********************************************************************
	
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
	$acessar = acessaTela(132, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar) ){						
?>

        <link rel="stylesheet" type="text/css" href="css/pages/usuario/controle_usuario_acessos.css" />		
        <script src="js/pages/usuario/controle_usuario_acesso.js" type="text/javascript"></script>
        
        <div id="input_nova_tela" class="k-header">
            <h3>Nova Tela de Acesso</h3>
            <form name="nova_tela">
                            
                Descrição: 			
                        <input type="text" name="nova_tela_descricao" placeholder="Descrição" maxlength="250">
                    <br>
                    <br><br />
                    <input type="button" value="LIMPAR" 	name="nova_tela_bt_limpar" class="k-button">
                    <input type="button" value="CADASTRAR" 	name="nova_tela_bt_cadastrar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_nova_tela"></span>
        </div>
    	<div id="list_telas_acesso">
            <div id="retorno_nova_tela">
            	<?php require_once 'php/controle_usuario/tela_acessos/lista_de_telas_de_acesso.php'; ?>
            </div>
        </div>
<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>