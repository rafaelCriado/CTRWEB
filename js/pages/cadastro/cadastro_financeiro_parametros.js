//Função para verificar se é numero =========================================
function verificaNumero(e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
// ==========================================================================

//Campos que aceitam somente numeros ========================================
$('input[name="FC_parametrofinanceiro_qtde_parcelas"]').keypress(verificaNumero);
$('input[name="FC_parametrofinanceiro_primeira_parcela"]').keypress(verificaNumero);
$('input[name="FC_parametrofinanceiro_diferenca_parcela"]').keypress(verificaNumero);
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
$('input[name="FC_parametrofinanceiro_bt_novo"]').live('click',function(e){
	e.preventDefault();
	limparTodos('form[name="FC_parametrofinanceiro"] input');
	$('#cadastro_financeiro_parametros_financeira').load('cadastro_financeiro_parametros_financeira.php');
});
// ==========================================================================

// EVENTO BOTÃO SALVAR ======================================================
$('input[name="FC_parametrofinanceiro_bt_incluir"]').click(function(e){
	e.preventDefault();
	
	//VARIAVEIS
	var descricao 		  = $('select[name="FC_parametrofinanceiro_descricao"]');				
	var qtde_parcelas 	  = $('input[name="FC_parametrofinanceiro_qtde_parcelas"]');				
	var carencia  		  = $('input[name="FC_parametrofinanceiro_carencia"]');				
	var parametro_condicao= $('input[name="codigo_parametro_financeira"]');
	
	
	
	//Validação
	if(descricao.val() == ''){
		erro(descricao,'Digite a descricao');
	}else{
		if(qtde_parcelas.val() == '' || qtde_parcelas.val() == 0){
			erro(qtde_parcelas,'');
		}else{
			if(carencia.val() == ''){
				erro(carencia,'');
			}else{
				
					
				
				
				//VERIFICA SE É NOVO CADASTRO OU ALTERAÇÃO
				
				if ( parametro_condicao.val() == ''){
					
					$.getJSON(
						'php/cadastro/financeiro/parametros/insert_parametros_financeira.php', 
						{ 
							"descricao"			:descricao.val(),
							"qtde_parcelas"		:qtde_parcelas.val(),
							"carencia"			:carencia.val()
							
						},
						function(j){
							var codigo_parametro_financeira = qtde_parcelas.val()+'|'+carencia.val()+'|'+descricao.val();
							var texto = j[0].texto;	
							
							$('.retorno_FC_parametrofinanceiro').html(texto);
							setTimeout(function(){$('.retorno_FC_parametrofinanceiro').html('');},4000);
							
							if(codigo_parametro_financeira != 0){
								$.get(
									'cadastro_financeiro_parametros_financeira.php',
									{ "codigo_parametro_financeira": codigo_parametro_financeira},
									function(data){
										$('#cadastro_financeiro_parametros_financeira').html(data);
									}
								)
							}
						}
					);
				
				}else{
					
					//Rotina de alteração de produto
					alert('ALTERAÇÃO NÃO PERMITIDA \n\n Clique em novo e crie uma nova forma de pagamento')									
					
					
				}
				
			}
		}
	}
});
// ==========================================================================

// EVENTO BOTÃO ATUALIZAR ===================================================
$('input[name="FC_parametrofinanceiro_bt_atualizar"]').live("click",function(e){
	e.preventDefault();
	$.post(
		'financeiro_cadastro_parametrofinanceiro.php',
		{ condigo_condicao_pagamento: ''},
		function(data){
			$('#financeiro_cadastro_parametrofinanceiro').html(data);
		}
	);
})
// ==========================================================================

//Efeito de Abas ============================================================
$("#tabstrip_FC_parametrofinanceiro").kendoTabStrip({
	animation:	{
		open: {
			
			effects: "fadeIn"
		}
	}

});
// ==========================================================================

//EFEITO BOTÃO EDITAR =======================================================
$('a[name="FC_parametrofinanceiro_bt_editar"]').click(function(e){
	e.preventDefault();
	
	
	var parametro_financeiro 		= $(this).attr('id');
	
	var param = parametro_financeiro.replace('|','_');
	 param = param.replace('|','_');
	 param = param.replace('|','_');
	 param = param.replace('|','_');
	 param = param.replace('|','_');
	
	
	
	var valor = $('#idP_'+ param ).html();
	
	$('#idP_'+ param).html('<input type="text" name="texto_alteracao" value="'+valor+'" >').focus();
	$('#idP_'+ param).append('<a href="" name="salvar_alteracao_usuario_acesso" title="Salvar"><img src="img/salvar.png"></a>');
	
	$('input[name="texto_alteracao"]').focus();
	$('input[name="texto_alteracao"]').focusout(function(){
		
		if($(this).val() == valor){
		
			$('#idP_'+ param).html(valor);
		
		}else{
		
			var novo_valor = $(this).val();
			var confirma = confirm('Deseja realizar alteração?');
			
			if(confirma){
				$.ajax({
					url: 'php/cadastro/financeiro/parametros/update_parametro_financeiro_parcela.php', 
					dataType: 'html',
					data: {
								"valor" 				: novo_valor,
								"parametro" 			: parametro_financeiro
							},
		
					type: 'POST',
					success: function(data, textStatus) {
								$('.retorno_FC_parametrofinanceiro').html(data);
								$('#idP_'+ param).html(novo_valor);
								setTimeout(function(){$('.retorno_FC_parametrofinanceiro').html('');},4000);
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
$('a[name="FC_parametrofinanceiro_bt_editar_forma"]').click(function(e) {
	e.preventDefault();
	
	//Recebe condição de pagamento
	var condicao_pagamento = $(this).attr('id');
	$.post(
		'cadastro_financeiro_parametros_financeira.php',
		{ "codigo_parametro_financeira": condicao_pagamento, "alteracao": 1},
		function(data){
			$('#cadastro_financeiro_parametros_financeira').html(data);
		}
	)

});
// ==========================================================================

// EFEITO BOTÃO EXCLUIR FORMA DE PAGAMENTO ==================================
$('a[name="FC_parametrofinanceiro_bt_excluir_forma"]').click(function(e){
	e.preventDefault();
	
	//variavel
	var parametro_financeira = $(this).attr('id');
	var confirma = confirm('Deseja excluir realmente?');
	
	
	
	
	if(confirm){
		$.ajax({
			url: 'php/cadastro/financeiro/parametros/delete_parametro_financeira.php', 
			dataType: 'json',
			data: {
						"parametro_financeira"	: parametro_financeira
					},

			type: 'POST',
			success: function(data) {
						//alert(data);
						
						var msg 	= data[0].mensagem;
						var codRet = data[0].codigo_retorno;
						
						if(codRet == 1){
							$('tr#'+ parametro_financeira).hide();
							$.post(
								'cadastro_financeiro_parametros_financeira.php',
								{ },
								function(data){
									$('#cadastro_financeiro_parametros_financeira').html(data);
									alert(msg);
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
