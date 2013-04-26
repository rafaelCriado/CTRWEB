<!-- 
	TELA PEDIDO -> ORÇAMENTO ==========================================================================
             autor: Rafael Marques Criado
             data : 16/01/2013
        alterações: 	
     ==================================================================================================== 
-->

    <link rel="stylesheet" type="text/css" href="modulos/riolax/pedido/orcamento/CSS/orcamento.css">
    <script type="text/javascript" src="modulos/riolax/pedido/orcamento/JS/orcamento.js"></script>

    <style>
		
		a[name="bt_orc_novo_cliente"]{ color:#fff; text-decoration:none;}
		a[name="bt_orc_novo_cliente"]:hover{ color:#fff;  text-decoration:underline;}
		a[name="bt_orc_novo_cliente"]:visited{ color:#fff;  text-decoration:none;}
		
		a[name="bt_orc_pesquisar_cliente"]{ color:#fff; text-decoration:none;}
		a[name="bt_orc_pesquisar_cliente"]:hover{ color:#fff; text-decoration:underline;}
		a[name="bt_orc_pesquisar_cliente"]:visited{ color:#fff; text-decoration:none; border:0px;}
		
		div#orc_quadroAzul{ height:auto; width:260px; background:#0054AA; float:right; margin:20px 35px 0 0; border-radius:10px; padding:15px; color:#FFF; font-size:12px; }
		div[id^='po_aba'] { background: url(modulos/riolax/pedido/orcamento/IMG/riolax.png) no-repeat bottom right;}
		div#po_aba_quatro { height:453px; overflow:auto;}
		
    </style>

    <div id="tabstrip_pedido_orcamento" style="height:99%">
    
    
        <!-- CRIA AS ABAS DA TELA =============================================================  -->
            <ul>
                <li class="k-state-active">
                    Inicio
                </li>
                <li>
                    Passo a Passo
                </li>
                <li>
                    Finalizar
                </li>
                <li>
                    Pesquisar Orçamentos
                </li>
            </ul>
        <!-- ================================================================================== -->
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        <!-- CONTEUDO DA PRIMEIRA ABA (INICIO) ================================================ -->
            <div id="pedido_orcamento_aba">
            
                <div id="po_aba">	
                
                	<!-- QUADRO AZUL ========================================================== -->
                        <div id="orc_quadroAzul">

                            <form name="pedido_orcamento">
                            
                                Cliente:<br />
    							<input type="text"	 name="po_name" 			value=""  style="width:100%; height:30px; color:#069">
                                <input type="hidden" name="po_codigo_cliente" 	value="0" >
                                
                                <span class="span_orc_clientes" style="margin-left:110px">
                                    <a href="#" name="bt_orc_novo_cliente">Novo Cliente</a>
                                     | 
                                    <a href="#" name="bt_orc_pesquisar_cliente">Pesquisar</a>
                                </span>
                                
                                <br />
								<br />
            
                                Data:<br>
                                <input type="text" name="po_data" style="width:100%; height:30px; color:#069">
            
                                <br />
                                <br />
            
                                <input type="button" name="po_continuar"  value="INICIAR" style="width:50%; height:35px; margin-left:50%; font-size:16px; color:#036;">                        
                            
                            </form>

                        </div>
                    <!-- ====================================================================== -->
                
                </div>
                <div style="clear:both"></div>
            </div>
        <!-- ================================================================================== -->
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        <!-- CONTEUDO SEGUNDA ABA (PASSO-A-PASSO) ============================================= -->
            <div id="pedido_orcamento_aba_dois">
                <div id="po_aba_dois" >
                    <?php include('modulos/riolax/pedido/orcamento/PHP/tela_produtos.php'); ?>
                </div>
            </div>
        <!-- ================================================================================== -->
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        <!-- CONTEUDO TERCEIRA ABA (FINALIZAR)================================================== -->
            <div id="pedido_orcamento_aba_tres">
                <div id="po_aba_tres">
                    
                </div>
            </div>
         <!-- ================================================================================== -->
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        <!-- Quarta Aba (PESQUISAR ORÇAMENTO) ================================================== -->
            <div id="pedido_orcamento_aba_tres">
                <div id="po_aba_quatro">
                    <?php include('modulos/riolax/pedido/orcamento/PHP/tela_pesquisa.php') ?>
                </div>
            </div>
         <!-- ================================================================================== -->
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
    </div>