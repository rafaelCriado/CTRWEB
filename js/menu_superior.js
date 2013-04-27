//JS MENU SUPERIOR

// CARREGA TELA DE UNIDADE DE MEDIDA **************************
	$('a[name="cadastro_medida"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			       url: 'cadastro_medida.php', 
			  dataType: 'html',
			beforeSend: function(){
							$('#cadastro_medida').html(
									'<img src="img/carregando.gif" alt="Aguarde">');
						},
			   success: function(data) {
							$('#cadastro_medida').html(data);
						 },
				 error: function(xhr,er) {
							$('#cadastro_medida').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 	}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE EMPRESA ************************
	$('a[name="cadastro_empresa"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_empresa.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_empresa').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_empresa').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_empresa').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE ESTADO *************************
	$('a[name="cadastro_estado"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_estado.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_estado').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_estado').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_estado').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE CIDADE *************************
	$('a[name="cadastro_cidade"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_cidade.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_cidade').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_cidade').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_cidade').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE USUARIO ************************
	$('a[name="controle_usuario_cadastrar"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'controle_usuario_cadastrar.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#controle_usuario_cadastrar').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#controle_usuario_cadastrar').html(data);
					 },
			 error: function(xhr,er) {
						$('#controle_usuario_cadastrar').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE TELA ***************************
	$('a[name="controle_usuario_acesso"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'controle_usuario_acesso.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#controle_usuario_acesso').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#controle_usuario_acesso').html(data);
					 },
			 error: function(xhr,er) {
						$('#controle_usuario_acesso').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE GRUPO E SUBGRUPO ***************
	$('a[name="controle_usuario_grupo_sub"]').live("click", function(e){
	  
	  e.preventDefault();
	  $.ajax({
			 url: 'controle_usuario_grupo_sub.php', 
		dataType: 'html',
	  beforeSend: function(){
					  $('#controle_usuario_grupo_sub').html(
							  '<img src="img/carregando.gif" alt="Aguarde">');
				  },
		 success: function(data) {
					  $('#controle_usuario_grupo_sub').html(data);
				   },
		   error: function(xhr,er) {
					  $('#controle_usuario_grupo_sub').html(
							  '<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
							  '<br />Tipo de erro: ' + er +'</p>')	
				  }		
	  });	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE RESTRIÇÕES *********************
	$('a[name="controle_usuario_restricao"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'controle_usuario_restricao.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#controle_usuario_restricao').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#controle_usuario_restricao').html(data);
					 },
			 error: function(xhr,er) {
						$('#controle_usuario_restricao').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE FORMA DE PAGAMENTO *************
	$('a[name="cadastro_financeiro_condicaopagamento"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_financeiro_condicaopagamento.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_financeiro_condicaopagamento').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_financeiro_condicaopagamento').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_financeiro_condicaopagamento').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE TIPO DE ENTIDADE ***************
	$('a[name="cadastro_entidade_tipo"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_entidade_tipo.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_entidade_tipo').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_entidade_tipo').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_entidade_tipo').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE ORÇAMENTO **********************************
	$('a[name="pedido_orcamento"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_orcamento.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_orcamento').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_orcamento').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_orcamento').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PESQUISA PEDIDO/ORÇAMENTO ******************
	$('a[name="pedido_orcamento_pesquisar"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_orcamento_pesquisar.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_orcamento_pesquisar').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_orcamento_pesquisar').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_orcamento_pesquisar').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CARTEIRA DE CLIENTES ***********************
	$('a[name="relatorios_vendedores_carteira_cliente"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'relatorios_vendedores_carteira_cliente.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#relatorios_vendedores_carteira_cliente').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#relatorios_vendedores_carteira_cliente').html(data);
					 },
			 error: function(xhr,er) {
						$('#relatorios_vendedores_carteira_cliente').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PESQUISA DE PESSOA**************************
	$('a[name="cadastro_entidade_pesquisa_pessoa"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_entidade_pesquisa_pessoa.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_entidade_pesquisa_pessoa').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_entidade_pesquisa_pessoa').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_entidade_pesquisa_pessoa').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE FICHA TECNICA ******************
	$('a[name="cadastro_produto_ficha_tecnica"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_produto_ficha_tecnica.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_produto_ficha_tecnica').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_produto_ficha_tecnica').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_produto_ficha_tecnica').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE PRODUTO ************************
	$('a[name="cadastro_produto"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_produto.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_produto').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_produto').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_produto').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CONFIGURAÇÃO DE EMPRESA ********************
	$('a[name="cadastro_configuracao_empresa"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_configuracao_empresa.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_configuracao_empresa').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_configuracao_empresa').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_configuracao_empresa').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CONFIGURAÇÃO DE MARKETING ******************
	$('a[name="cadastro_marketing_perguntas"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_marketing_perguntas.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_marketing_perguntas').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_marketing_perguntas').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_marketing_perguntas').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE FINANCEIRAS ********************
	$('a[name="cadastro_financeiro_financeira"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_financeiro_financeira.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_financeiro_financeira').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_financeiro_financeira').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_financeiro_financeira').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE PARAMETROS DAS FINANCEIRAS *****
	$('a[name="cadastro_financeiro_parametros_financeira"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_financeiro_parametros_financeira.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_financeiro_parametros_financeira').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_financeiro_parametros_financeira').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_financeiro_parametros_financeira').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CADASTRO DE PESQUISA FINANCEIRA ************
	$('a[name="pesquisa_financeira"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pesquisa_financeira.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pesquisa_financeira').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pesquisa_financeira').html(data);
					 },
			 error: function(xhr,er) {
						$('#pesquisa_financeira').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PESQUISA CONDICAO DE PAGAMENTO *************
	$('a[name="pesquisa_condicao_pagamento"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pesquisa_condicao_pagamento.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pesquisa_condicao_pagamento').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pesquisa_condicao_pagamento').html(data);
					 },
			 error: function(xhr,er) {
						$('#pesquisa_condicao_pagamento').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PESQUISA CADASTRO DE TIPO DE PAGAMENTO *****
	$('a[name="cadastro_financeiro_tipo_pagamento"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_financeiro_tipo_pagamento.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_financeiro_tipo_pagamento').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_financeiro_tipo_pagamento').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_financeiro_tipo_pagamento').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PESQUISA CADASTRO DE FORMA DE PAGAMENTO ****
	$('a[name="cadastro_financeiro_forma_pagamento"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_financeiro_forma_pagamento.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_financeiro_forma_pagamento').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_financeiro_forma_pagamento').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_financeiro_forma_pagamento').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PARAMETROS DE CARTAO DE CREDITO ************
	$('a[name="financeiro_cartoes_parametros"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'financeiro_cartoes_parametros.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#financeiro_cartoes_parametros').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#financeiro_cartoes_parametros').html(data);
					 },
			 error: function(xhr,er) {
						$('#financeiro_cartoes_parametros').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE CONFIGURAÇÃO DE FILIAL *********************
	$('a[name="cadastro_configuracao_filial"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'cadastro_configuracao_filial.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#cadastro_configuracao_filial').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#cadastro_configuracao_filial').html(data);
					 },
			 error: function(xhr,er) {
						$('#cadastro_configuracao_filial').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PEDIDOS A ENVIAR ***************************
	$('a[name="pedido_pedidos_enviar"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_pedidos_enviar.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_pedidos_enviar').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_pedidos_enviar').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_pedidos_enviar').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE PEDIDOS ENVIADOS ***************************
	$('a[name="pedido_pedidos_enviados"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_pedidos_enviados.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_pedidos_enviados').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_pedidos_enviados').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_pedidos_enviar').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************


// CARREGA TELA DE RELATÓRIOS MENU PEDIDO **********************
	$('a[name="pedido_relatorios"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_relatorios.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_relatorios').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_relatorios').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_relatorios').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************

// CARREGA TELA DE RELATÓRIOS 2 MENU PEDIDO **********************
	$('a[name="pedido_relatorio2"]').live("click", function(e){
		
		e.preventDefault();
		$.ajax({
			   url: 'pedido_relatorio2.php', 
		  dataType: 'html',
		beforeSend: function(){
						$('#pedido_relatorio2').html(
								'<img src="img/carregando.gif" alt="Aguarde">');
					},
		   success: function(data) {
						$('#pedido_relatorio2').html(data);
					 },
			 error: function(xhr,er) {
						$('#pedido_relatorio2').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});	
	});
// ************************************************************


