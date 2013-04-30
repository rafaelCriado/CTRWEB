//EFEITO DE TIME OUT (PASSADO 15 MINUTOS SEM USAR O SISTEMA FAZ LOG OFF =====================	
var activePage = true;
var count_time = 0; 

function showInformation() {
	
	if (activePage) {
		count_time = 0; 

	} else {
		
		
		if (count_time == 1) { 
			count_time = 0; 
			document.location.href="sair.php";
		}
		count_time++;
	}

	setTimeout("showInformation();", 600000);
}
// =============================================================================================

$(document).ready(function() {
	$(window).load(function(){
		$(window).unload(function(){
			$.post( "sair.php" );
		});
	});
	
		 
    $(function() {
        $(window)
			.mouseenter(function(){ activePage = true;})
            .focus(function() { activePage = true; })
			.focusin(function() { activePage = true; })
            .blur(function() { activePage = false; });
 
        showInformation();
    });	 

	// EFEITO ENTER ================================
	$('input,select').live("keypress",function(e){
		/*
		 * verifica se o evento é Keycode (para IE e outros browsers)
		 * se não for pega o evento Which (Firefox)
		*/
	   var tecla = (e.keyCode?e.keyCode:e.which);
		
	   /* verifica se a tecla pressionada foi o ENTER */
	   if(tecla == 13){
		   /* guarda o seletor do campo que foi pressionado Enter */
		   campo =  $('input,select');
		   /* pega o indice do elemento*/
		   indice = campo.index(this);
		   /*soma mais um ao indice e verifica se não é null
			*se não for é porque existe outro elemento
		   */
		  if(campo[indice+1] != null){
			 /* adiciona mais 1 no valor do indice */
			 proximo = campo[indice + 1];
			 /* passa o foco para o proximo elemento */
			 proximo.focus();
		  }
   		}
	});
	// =============================================
	
	//Regula o tamanho da tela
	
	
	$(".jquery-waiting-base-container").waiting({modo:"slow"});
	
	//MENU SIDEBAR
	$("#menu").kendoMenu();
	
	// FUNÇÃO PARA CRIAR AS JANELAS DO SISTEMA ========================================================================
	function criarJanela(ancoraJanela, altura, largura){

		//Ancora Janela = nome da ancora da pagina.
		var titulo = $('a[name="'+ ancoraJanela +'"]').attr("title");
		
		//Função para criar tela.
		$('a[name="'+ ancoraJanela +'"]').live("click", function(e){ 
			e.preventDefault(); 
		});
		
		var eventos = $("#" + ancoraJanela),
		bt_eventos = $('a[name="'+ ancoraJanela +'"]').bind("click", function() {
					eventos.data("kendoWindow").open().center();
					bt_eventos.show();
				});
				
		if (!eventos.data("kendoWindow")) {
			eventos.kendoWindow({
				width: largura,
				height: altura,
				resizable: false,
				actions: ["Close"],
				title: titulo,
				close: function() {
							bt_eventos.show();
						}
			});
		}
		
		$("#" + ancoraJanela).data("kendoWindow").close();
		
	}
	// ================================================================================================================
	
		
	function criarJanelaZoom(ancoraJanela, altura, largura, maximizar){
		//Ancora Janela = nome da ancora da pagina.
		
		var titulo = $('a[name="'+ ancoraJanela +'"]').attr("title");
		
		//Função para criar tela.
		$('a[name="'+ ancoraJanela +'"]').live("click", function(e){ 
			e.preventDefault(); 
		});
		
		var eventos = $("#" + ancoraJanela),
		bt_eventos = $('a[name="'+ ancoraJanela +'"]').bind("click", function() {
					eventos.data("kendoWindow").open().center();
					bt_eventos.show();
				});
				
		function onMaximize(e){
			//$("#"+ ancoraJanela).load(ancoraJanela+'.php');
			maximizar
		}
				
		if (!eventos.data("kendoWindow")) {
			eventos.kendoWindow({
				width: largura,
				height: altura,
				resizable: true,
				actions: ["Minimize","Maximize","Close"],
				title: titulo,
				close: function() {
							bt_eventos.show();
						},
				resize: onMaximize
			});
		}
		
		$("#" + ancoraJanela).data("kendoWindow").close();
		
	}
	
	//efeito de borda em botões quando selecionado =====================================================
	$('input[type="button"], a').live("focus",function(){
		$(this).css({border:'1px solid #4D74FB'});
	}).live("focusout",function(){
		$(this).css({border:'1px solid #94C0D2'});
	});
	// =================================================================================================

	// CRIAR JANELAS DO MENU CADASTROS =================================================================
		//sub-menu pessoas ++++++++++++++++++++++++++++++
		criarJanelaZoom("cadastro_entidade_tipo",350,810);
		criarJanela("cadastro_entidade_pessoa",520,860);
		criarJanela("cadastro_entidade_pesquisa_pessoa",320,800);
		//+++++++++++++++++++++++++++++++++++++++++++++++
		
		//sub-menu produtos ++++++++++++++++++++++++++++++++
		criarJanela("cadastro_produto", 360, 750);
		criarJanela("cadastro_produto_grupo_sub", 300, 650);
		criarJanela("cadastro_produto_tabela_preco", 300, 800);
		criarJanela("cadastro_produto_pesquisa",320,800);
		criarJanela("cadastro_configuracao_empresa",320,800);
		criarJanela("cadastro_configuracao_filial",320,800);
		criarJanelaZoom("cadastro_financeiro_financeira",320,800);
		criarJanelaZoom("cadastro_financeiro_tipo_pagamento",320,800);
		criarJanelaZoom("cadastro_financeiro_parametros_financeira",400, 650);
		criarJanelaZoom("cadastro_financeiro_forma_pagamento",220, 650);
		criarJanelaZoom("cadastro_marketing_perguntas",400,650);
		//++++++++++++++++++++++++++++++++++++++++++++++++++
		
		//sub-menu controle de usuarios ++++++++++++++++++++
		criarJanelaZoom("controle_usuario_cadastrar",400, 650);
		criarJanelaZoom("controle_usuario_acesso",450,800);
		criarJanelaZoom("controle_usuario_restricao",500,810);
		criarJanelaZoom("controle_usuario_grupo_sub", 400,600);
		//++++++++++++++++++++++++++++++++++++++++++++++++++
		
		// sub-menu localidade +++++++++++++++++++++++++++++
		criarJanelaZoom("cadastro_cidade",400,900);
		criarJanelaZoom("cadastro_estado",400,800);
		// +++++++++++++++++++++++++++++++++++++++++++++++++
		
		criarJanelaZoom("cadastro_empresa", 550, 930);
		criarJanelaZoom("cadastro_medida", 315, 610);
		
		
		
	// =================================================================================================
	
	//CRIAR JANELAS DO MENU FINANCEIRO =================================================================
		//sub-menu cadastros ++++++++++++++++++++++++++++++++++++++
		criarJanela("cadastro_financeiro_condicaopagamento",400, 650);
		criarJanelaZoom("pesquisa_financeira",400, 650);
		criarJanelaZoom("pesquisa_condicao_pagamento",400, 650);
		criarJanelaZoom("financeiro_cartoes_parametros",420, 850);
		
		// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++financeiro_cartoes_parametros
		
		criarJanela("contas_a_receber",570,900);
		
	// =================================================================================================
	
	
	//CRIAR JANELAS DO MENU ORÇAMENTOS =================================================================
		
		criarJanelaZoom("pedido_orcamento",520,860);
		criarJanela("pedido_orcamento_pesquisar",520,860);
		
	// =================================================================================================
	
	//CRIAR JANELAS DO MENU RELATORIOS =================================================================
		
		criarJanelaZoom("relatorios_vendedores_carteira_cliente",520,860);
		
	// =================================================================================================

	// CRIAR JANELAS DO MENU PEDIDOS ===================================================================
		
		criarJanelaZoom("pedido_pedidos_enviar",520,860);
		criarJanelaZoom("pedido_pedidos_enviados",520,860);
		criarJanela("pedido_relatorios",500,500);
		criarJanela("pedido_relatorio2",400,600);
		
	// =================================================================================================



	
	//CRIAR JANELAS DO MENU GEO-MARKETING ==============================================================
	
		criarJanelaZoom("geo",400, 650);
	
	// =================================================================================================
	
	
		criarJanela("salvar_imagem",120,400);
	
	
	//Corrige altura da tela ===========================================================================
	$('#corpo').css({height: $(window).outerHeight()-156, marginTop:'-30px'});
	$('#principal').css({height: $(window).outerHeight(	) - 30});
	// =================================================================================================


	//ATALHOS  ====================================================================
	var pressedAlt = false; 
	
	document.onkeyup=function(e){ 
		if(e.which == 18) 
		pressedAlt =false;
		
		if(e.which == 17)
		pressedAlt =false;
	}
	document.onkeydown=function(e){
		if(e.which == 18)
			pressedAlt = true; 
		
		//ALT + C = Pesquisa de cliente
		if(e.which == 67 && pressedAlt == true) { 
			//Aqui vai o código e chamadas de funções para o alt+c
			$('a[name="cadastro_entidade_pesquisa_pessoa"]').click();
			$('input[name="entidade_texto_pesquisa"]').focus();
			pressedAlt = false;
		}
		
		//ALT + P = Pesquisa de produto
		if(e.which == 80 && pressedAlt == true){
			//Aqui vai o código e chamadas de funções para o alt+p
			$('a[name="cadastro_produto_pesquisa"]').click();
			$('input[name="produto_texto_pesquisa"]').focus();
			pressedAlt = false;
		}
		

	}
	// =================================================================================================

	$(document).bind('onunload',function(){
		$.post(' sair.php')
	})
		
		//EFEITO DE CAIXA ALTA =======================================================================================.
		$("input").live("keyup",function(e){
			
				$(this).val($(this).val().toUpperCase());
		});


	$('a[name="geo"]').live("click",function(){ 
		$('#geo').load('geo.php');
		$('input[name="geo_localiza_cliente"]').click();
	})

});