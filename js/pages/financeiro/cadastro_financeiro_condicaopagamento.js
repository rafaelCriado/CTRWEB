//Função para verificar se é numero =========================================
function verificaNumero(e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
// ==========================================================================

//Campos que aceitam somente numeros ========================================
$('input[name="FC_formapagamento_qtde_parcelas"]').keypress(verificaNumero);
$('input[name="FC_formapagamento_primeira_parcela"]').keypress(verificaNumero);
$('input[name="FC_formapagamento_diferenca_parcela"]').keypress(verificaNumero);
// ==========================================================================

//Função de erro ============================================================
function erro(variavel, texto){
	variavel.attr('placeholder',texto);
	variavel.focus();
	variavel.css({background:'#FBB5BF', color:'red', fontWeight:'bold'});
	variavel.keypress(function(){ $(this).css({background:'#fff', color:'red', fontWeight:'normal'});});
}
// ==========================================================================

//Limpa todos os campos =====================================================
function limparTodos(seletor){
	$(seletor).each(function(){
		$(this).val('');
	});
}
// ==========================================================================

// EVENTO BOTÃO LIMPAR ======================================================
$('input[name="FC_formapagamento_bt_novo"]').live('click',function(e){
	e.preventDefault();
	limparTodos('form[name="FC_formapagamento"] input');
	$('#cadastro_financeiro_condicaopagamento').load('cadastro_financeiro_condicaopagamento.php');
});
// ==========================================================================

// EVENTO BOTÃO SALVAR ======================================================
$('input[name="FC_formapagamento_bt_incluir"]').click(function(e){
	e.preventDefault();
	
	//VARIAVEIS
	var descricao 		  = $('input[name="FC_formapagamento_descricao"]');				
	var qtde_parcelas 	  = $('input[name="FC_formapagamento_qtde_parcelas"]');				
	var primeira_parcela  = $('input[name="FC_formapagamento_primeira_parcela"]');				
	var diferenca_parcela = $('input[name="FC_formapagamento_diferenca_parcela"]');
	var condicao_selecionada = $('input[name="codigo_condicao_pagamento"]');
	var condPagamento	  = $('input[name="FC_formapagamento_financeira_codigo"]');
	var formPagamento	  = $('select[name="FC_form_pagamento"]');
	
	
	
	//Validação
	if(descricao.val() == ''){
		erro(descricao,'Digite a descricao');
	}else{
		if(qtde_parcelas.val() == '' || qtde_parcelas.val() == 0){
			erro(qtde_parcelas,'Valor de 0 a 99');
		}else{
			if(primeira_parcela.val() == ''){
				erro(primeira_parcela,'Valor deve ser numérico');
			}else{
				if(diferenca_parcela.val() == '' || diferenca_parcela.val() == 0){
					erro(diferenca_parcela,'Valor deve ser numérico');
				}else{
					
					var passa = 1;
					
					//VERIFICA SE TEM FINANCEIRA
					if(condPagamento.val() != ''){
						var financeiro			 = condPagamento.val().split('|')
						var parcelas_financeiras = parseInt(financeiro[0]);
						var parcelas_condicao	 = qtde_parcelas.val();
						
						if(parcelas_financeiras < parcelas_condicao){
							alert('O número de parcelas da condição de pagamento excede o número de parcelas da financeira escolhida!');
							passa = 0;
						}
						
						if(passa == 1){
							var carencia_financeira = parseInt(financeiro[1]);
							var carencia_condicao	= primeira_parcela.val();
							
							if(carencia_financeira != carencia_condicao){
								
								var confirma_condicao = confirm('O dia do vencimento da primeira parcela está divergindo com a carência da financeira! \n\n Deseja Continuar?\n\n\n');
								if(confirma_condicao){
									passa = 1;
								}else{
									passa = 0;
								};
							}
						}
					}
					
					
					//Caso todos os campos estiverem preenchidos faça
					
					
					
					//VERIFICA SE É NOVO CADASTRO OU ALTERAÇÃO
					
					if ( condicao_selecionada.val() == ''){
						
						if(passa == 1){
							$.getJSON(
								'php/financeiro/cadastros/forma_pagamento/insert_forma_pagamento.php?search=', 
								{ 
									"descricao"			:descricao.val(),
									"qtde_parcelas"		:qtde_parcelas.val(),
									"primeira_parcela"	:primeira_parcela.val(),
									"diferenca_parcela"	:diferenca_parcela.val(),
									"condicao_pagamento": condPagamento.val(),
									"forma_pagamento"	: formPagamento.val()
								},
								function(j){
									var codigo_condicao_pagamento = j[0].condigo_condicao_pagamento;
									var texto = j[0].texto;	
									
									$('.retorno_FC_formapagamento').html(texto);
									setTimeout(function(){$('.retorno_FC_formapagamento').html('');},4000);
									
									if(codigo_condicao_pagamento != 0){
										$.post(
											'cadastro_financeiro_condicaopagamento.php',
											{ "condigo_condicao_pagamento": codigo_condicao_pagamento},
											function(data){
												$('#cadastro_financeiro_condicaopagamento').html(data);
											}
										)
									}
								}
							);
						}
					}else{
						
						//Rotina de alteração de produto
						alert('ALTERAÇÃO NÃO PERMITIDA \n\n Clique em novo e crie uma nova forma de pagamento')									
						
						
					}
				}
			}
		}
	}
});
// ==========================================================================

// EVENTO BOTÃO ATUALIZAR ===================================================
$('input[name="FC_formapagamento_bt_atualizar"]').live("click",function(e){
	e.preventDefault();
	$.post(
		'cadastro_financeiro_condicaopagamento.php',
		{ condigo_condicao_pagamento: ''},
		function(data){
			$('#cadastro_financeiro_condicaopagamento').html(data);
		}
	);
})
// ==========================================================================

//Efeito de Abas ============================================================
$("#tabstrip_FC_formapagamento").kendoTabStrip({
	animation:	{
		open: {
			
			effects: "fadeIn"
		}
	}

});
// ==========================================================================

//EFEITO BOTÃO EDITAR =======================================================
$('a[name="FC_formapagamento_bt_editar"]').click(function(e){
	e.preventDefault();
	var condicao_pagamento_codigo = $(this).attr('id');
	var codigo = $('input[name="codigo_condicao_pagamento"]').val();
	var valor = $('#id_'+ condicao_pagamento_codigo).html();
	
	$('#id_'+ condicao_pagamento_codigo).html('<input type="text" name="texto_alteracao" value="'+valor+'" >').focus();
	$('#id_'+ condicao_pagamento_codigo).append('<a href="" name="salvar_alteracao_usuario_acesso" title="Salvar"><img src="img/salvar.png"></a>');
	
	$('input[name="texto_alteracao"]').focus();
	$('input[name="texto_alteracao"]').focusout(function(){
		if($(this).val() == valor){
			$('#id_'+ condicao_pagamento_codigo).html(valor);
		}else{
			var novo_valor = $(this).val();
			var confirma = confirm('Deseja realizar alteração?');
			
			if(confirma){
				$.ajax({
					url: 'php/financeiro/cadastros/forma_pagamento/update_forma_pagamento_parcela.php', 
					dataType: 'html',
					data: {
								"novo_valor" 				: novo_valor,
								"condicao_pagamento_codigo"	: codigo,
								"parcela" 					: condicao_pagamento_codigo
							},
		
					type: 'POST',
					success: function(data, textStatus) {
								$('.retorno_FC_formapagamento').html(data);
								$('#id_'+ condicao_pagamento_codigo).html(novo_valor);
								setTimeout(function(){$('.retorno_FC_formapagamento').html('');},4000);
							 },
					error: function(xhr,er) {
								$('.resultado_nova_tela').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
							 }		
				});	
				
			}
			
		}
	});
});
//===========================================================================

// EFEITO BOTÃO EDITAR FORMA DE PAGAMENTO ===================================
$('a[name="FC_formapagamento_bt_editar_forma"]').click(function(e) {
	e.preventDefault();
	
	//Recebe condição de pagamento
	var condicao_pagamento = $(this).attr('id');
	$.post(
		'cadastro_financeiro_condicaopagamento.php',
		{ "condigo_condicao_pagamento": condicao_pagamento, "alteracao": 1},
		function(data){
			$('#cadastro_financeiro_condicaopagamento').html(data);
		}
	)

});
// ==========================================================================

// EFEITO BOTÃO EXCLUIR FORMA DE PAGAMENTO ==================================
$('a[name="FC_formapagamento_bt_excluir_forma"]').click(function(e){
	e.preventDefault();
	
	//variavel
	var codigo_forma_pagamento = $(this).attr('id');
	var confirma = confirm('Deseja excluir realmente?');
	
	
	
	
	if(confirm){
		$.ajax({
			url: 'php/financeiro/cadastros/forma_pagamento/delete_forma_pagamento_parcela.php', 
			dataType: 'json',
			data: {
						"condicao_pagamento_codigo"	: codigo_forma_pagamento
					},

			type: 'POST',
			success: function(data) {
						//alert(data);
						
						var msg 	= data[0].mensagem;
						var codRet = data[0].codigo_retorno;
						
						if(codRet == 1){
							$('tr#'+ codigo_forma_pagamento).hide();
							$.post(
										'cadastro_financeiro_condicaopagamento.php',
										{ },
										function(data){
											$('#cadastro_financeiro_condicaopagamento').html(data);
										}
									)
							
						}else{
							alert(msg);
							
						}
					},
			error: function() {
						alert('Erro de requisição');	
					 }		
		});	
	}
});
// ==========================================================================
