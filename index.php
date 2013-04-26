<?php

	include('php/classes/session.class.php');
	//Inicia Sessão
	$sessao = new Session();
	
	include('php/classes/bd_oracle.class.php');

	error_reporting(0);
	
	
	$url_caminho = $_SERVER['PHP_SELF'];
	
	$sessao->addNode('url_atual', $url_caminho);
	
		
	if($sessao->checkNode('empresa_acessada') == FALSE or $sessao->getNode('empresa_acessada') == '' or $sessao->getNode('empresa_acessada') == 0){
		//header("Location:login.php");
		?><script type="text/javascript">window.location.href="login.php"</script><?php
	}else{
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="k-blueopal">
	<head>
        <meta charset="utf-8" />
        
	    <title>ADM Citrino Web</title>
  
        <link href="img/logo_citrino_icone.ico"				rel="shortcut icon" type="text/css" />
        <link href="css/kendu/corpo.css" 					rel="stylesheet">
        <link href="js/kendo/styles/kendo.common.min.css" 	rel="stylesheet">
        <link href="js/kendo/styles/kendo.blueopal.min.css" rel="stylesheet">
        <link href="css/pages/index.css" 					rel="stylesheet" 	type="text/css" />
        <link href="css/jquery.autocomplete.css" 			rel="stylesheet" 	type="text/css" />
        <link href="js/box/css/slimbox2.css" 				rel="stylesheet" 	type="text/css" />
	        		
		<script type="text/javascript" src="js/jquery.js">				</script>
		<script type="text/javascript" src="js/jquery.maskMoney.js">	</script>
		<script type="text/javascript" src="js/jquery.autocomplete.js">	</script>
		<script type="text/javascript" src="js/box/js/slimbox2.js">		</script>
		<script type="text/javascript" src="js/jquery.waiting.js">		</script>
        
        <script src="js/kendo/js/kendo.web.min.js">						</script>
    	<script src="js/kendo/js/cultures/kendo.culture.pt-BR.min.js">	</script>
    	<script src="js/kendo/js/console.js">							</script>
		<script src="js/index.js" type="text/javascript">				</script>
		<script src="js/menu_superior.js" type="text/javascript">		</script>
        
        <!--JS do Menu Cadastrar -->
        
            <!-- JS do Sub-Menu Produtos -->
            <script type="text/javascript" src="js/pages/cadastro/cadastro_produto_grupo_sub.js"></script>
            
            <!--JS do Sub-Menu Entidade -->
            <script src="js/pages/entidade/cadastro_entidade_pessoa.js" type="text/javascript"></script>
            
        <!--FIM JS do Menu Cadastrar -->
   	</head>
	
    <style>
		
    </style>
    
    
    <body>
    	<div class="jquery-waiting-base-container">Aguarde Carregando..</div>
        <div id="principal" class="k-content" style="background:#eee url(img/logo_admcitrino.png) center center no-repeat;">
            
            <?php 
				require_once 'php/menu_superior.php'; 	
				include('php/functions.php');
			?>
            
            <div id="corpo" style="width:98%; max-height:95%">
            	<!--<div id="calendar" style="float:left;" class=""></div> -->
            
                <!-- MENU CADASTRO =========================================================== -->
                	<!-- SUB-MENU PESSOAS  =================================================== --> 
						<div id="cadastro_entidade_tipo">					</div>
                        <div id="cadastro_entidade_pessoa" style="overflow:auto;">
                            <?php include('cadastro_entidade_pessoa.php');?>
                        </div>
	                	<div id="cadastro_entidade_pesquisa_pessoa">		</div>
                	<!-- ===================================================================== -->
                
                	
                    <!-- SUB-MENU PRODUTOS =================================================== -->
                		<div id="cadastro_produto">							</div>
                		<div id="cadastro_produto_grupo_sub" style="overflow:auto;">
                			<?php include('cadastro_produto_grupo_sub.php');?>
                		</div>
                		<div id="cadastro_produto_tabela_preco" style="overflow:auto;">
							<?php include('cadastro_produto_tabela_preco.php');?>
                        </div>
                        <div id="cadastro_produto_pesquisa" style="overflow:auto;">
                            <?php include('cadastro_produto_pesquisa.php');?>
                        </div>
               			<div id="cadastro_produto_ficha_tecnica">			</div>
					<!-- ====================================================================== -->
                 
                
                
                	<!-- SUB-MENU CONTROLE DE USUÁRIO ========================================= -->
                    	<div id="controle_usuario_cadastrar">				</div>
                    	<div id="controle_usuario_acesso">					</div>   
                        <div id="controle_usuario_restricao">				</div>
                        <div id="controle_usuario_grupo_sub">				</div> 
                	<!-- ====================================================================== -->
                	
                    
                    
                    <!-- SUB-MENU LOCALIDADE ================================================== -->
                    	<div id="cadastro_cidade">							</div>
                        <div id="cadastro_estado">							</div>
                    <!-- ====================================================================== -->
                    
                    
                    
                    <!-- SUB-MENU FINANCEIRO ================================================== -->
						<div id="cadastro_financeiro_tipo_pagamento">		</div>
                        <div id="cadastro_financeiro_forma_pagamento">		</div>
						<div id="cadastro_financeiro_financeira">			</div>
						<div id="cadastro_financeiro_parametros_financeira"></div>
                        <div id="cadastro_financeiro_condicaopagamento">	</div>
                    	<div id="pesquisa_financeira">						</div>
                    	<div id="pesquisa_condicao_pagamento">				</div>                        
                    <!-- ====================================================================== -->
                    
                    
                    
                    <!-- SUB-MENU CONFIGURAÇÕES =============================================== -->
	                	<div id="cadastro_configuracao_empresa">			</div>
						<div id="cadastro_configuracao_filial">				</div>
                    <!-- ====================================================================== -->
                    
                    
                    <!-- SUB-MENU MARKETING =================================================== -->
                    	<div id="cadastro_marketing_perguntas">				</div>
                    <!-- ====================================================================== -->
                    
                    
                    <div id="cadastro_empresa">								</div>
                	<div id="cadastro_medida">								</div>
                <!-- ========================================================================== -->
                
                
                <!-- MENU FINANCEIRO ========================================================== -->
                    <!-- SUB-MENU CARTÕES ===================================================== -->
                		<div id="financeiro_cartoes_parametros">			</div>    
                    <!-- ====================================================================== -->
                <!-- ========================================================================== -->
                
                
                <!-- MENU ORÇAMENTOS ========================================================== -->
                    <div id="pedido_orcamento">								</div>
                    <div id="pedido_orcamento_pesquisar">					</div>
                <!-- ========================================================================== -->
                
                
                <!-- MENU PEDIDOS ============================================================= -->
                	<div id="pedido_pedidos_enviar">						</div>
                    <div id="pedido_pedidos_enviados">						</div>
                <!-- ========================================================================== -->
                
                
                <!-- MENU RELATORIOS ========================================================== -->
                	<!-- SUB-MENU ============================================================= -->
                    	<div id="relatorios_vendedores_carteira_cliente">	</div>
                    <!-- ====================================================================== -->
                <!-- ========================================================================== -->
                
                
                <!-- MENU GEO-MARKETING ======================================================= -->
                	<div id="geo">											</div>
                <!-- ========================================================================== -->
                

                
                
                <div id="salvar_imagem"></div>
                
                
           	</div>
            
            
        </div>
        <div id="footer" class="k-header">
                 
             Empresa: <?php echo $sessao->getNode('empresa'); ?>
             &nbsp;&nbsp;&nbsp;&nbsp;
             Usuario: <?php echo $sessao->getNode('usuario'); ?>
                 
      	</div>
    </body>
</html>
<?php 
	}
?>