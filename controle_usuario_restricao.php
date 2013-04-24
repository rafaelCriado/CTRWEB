<?PHP 
	/* TELA DE CONTROLE DE RESTRIÇÃO ********************************************************************
	
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
	$acessar = acessaTela(133, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
        <link rel="stylesheet" type="text/css" href="css/pages/usuario/controle_usuario_restricoes.css" />	
		<script type="text/javascript" src="js/pages/usuario/controle_usuario_restricao.js"></script>

    	<div id="modal_restricao">
        	<div style=" line-height:20px; height:20px; background:#daecf4; border:1px solid #cbe6ef;">
            	&nbsp;Adicionar Empresa
                <a name="fechar_modal_restricao" type="button" href="#" class="k-icon k-i-close close">X</a>
         	</div>
            <div id="div_modal_restricao">
            	<?php include "controle_usuario_restricao_adicionar_empresa.php"; ?>
            </div>
        </div>
    
    
       <div id="restricao_principal">
       		<form name="nova_restricao">
            	
                
                    <label for="escolha_tipo_restricao">Tipo Restrição: </label>
                    <select name="escolha_tipo_restricao">
                        <option value="0">Escolha uma opção</option>
                        <option value="1">por Usuário</option>
                        <option value="2">por Grupo</option>
                    </select>
                <span id="select_controle_usuario">
                </span>
                <br>

            
            
            <div id="restricao_lista_acesso" class="k-header k-content">
            	
                 <span class="retorno_usuario" ><h1>SELECIONE UM USUÁRIO OU GRUPO</h1></span>
                    
            </div>
            <span class="resultado_controle_usuario_restricao"></span>
            <input type="button" value="Salvar" class="k-button" id="restricao_bt_salvar" name="restricao_bt_salvar">
            
            <div id="restricao_empresa_usuario" class="k-header k-content">
            	<span style="text-align:center; line-height:150px; color:#666;"><h1>EMPRESAS</h1></span>
            </div>
            	<a href="#" name="controle_usuario_restricao_adicionar_empresa" title="Vincular Empresa" style="margin:190px 0 0 15px;" class="k-button">Adicionar Empresa</a>
            </form>
            

       </div>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>
