//Altura da tela central
setInterval(
	function(){
		
		var esquerda 	 = $('div#fp_esquerda').innerHeight();
		var altura_form	 = (esquerda*90)/100;
		
		
		$('div#fp_form').css({height:altura_form});
	},
	100);

	var add_upload = function(){
		
		$('input:button[name="fp_bt_imagem"]').addClass('img_carregar');
		$('input:button[name="fp_bt_imagem"]').removeClass('oculto');
		
	}

	var remove_upload = function(){
		
		$('input:button[name="fp_bt_imagem"]').addClass('oculto');
		$('input:button[name="fp_bt_imagem"]').removeClass('img_carregar');
		
	}



// Imagem =============================================================
	var imagem = function(){
		add_upload();
		$('input:button[name="fp_bt_imagem"]').click(function(e){
			e.preventDefault();
			
			$('a[name="salvar_imagem"]').click();
			var codigo = $('input[name="fp_codigo_demo"]').val();
			$.ajax({ 
					 url: 'php/cadastro/financeiro/forma_pagamento/carregar_imagem_forma_pagamento.php', 
				dataType: 'html',
					type:  "GET",
					data: { id: codigo},
			  beforeSend: function(){
								$('#salvar_imagem').html(
										'<img src="img/carregando.gif" alt="Aguarde">');
							},
				 success: function(data) {
								$('#salvar_imagem').html(data);
							 },
					error: function(xhr,er) {
								$('#salvar_imagem').html(
									'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
									'<br />Tipo de erro: ' + er +'</p>')	
								}
			});
			
		})
		
	}
// ====================================================================







	
	
//Estado inicial do formulário ========================================
var estado_inicial = function(){
	remove_upload();
	var input = $('form[name="forma_pagamento_form"] input, form[name="forma_pagamento_form"] select');
	input.attr('disabled','disabled');
	
	var botao = $('div#botoes_fp input');
	botao.removeAttr('disabled');
	
	var input_text = $('div#fp_form_sup input');
	input_text.attr('value','');
}
estado_inicial();
// ====================================================================

// Atualizar lista ====================================================
var atualizar_lista = function(){
	$.post(
		'php/cadastro/financeiro/forma_pagamento/lista_forma_pagamento.php',
		function(data){
			$('div#fp_esquerda').html(data);
		}
	);
}
// ====================================================================

//Evento clicar em novo ===============================================
var bt_novo = function(){
	var bt = $('input[name="fp_bt_novo"]');
	
	bt.click(function(e){
		e.preventDefault();
		
		//Evento
		var botao = $(this);
		botao.attr('name','fp_bt_cancelar');
		botao.attr('value','Cancelar');
		bt_cancelar();
		
		
		
		
		var form   = $('form[name="forma_pagamento_form"] input, form[name="forma_pagamento_form"] select');
		var codigo = $('input[name="fp_codigo_demo"]');
		
		
		form.removeAttr('disabled');
		
		var input_text = $('div#fp_form_sup input');
		input_text.attr('value','');
		
		codigo.attr('disabled','disabled');
		remove_upload();
		
	});
	
}
bt_novo();
// ====================================================================

//Evento clicar em cancelar ===========================================
var bt_cancelar = function(){
	var bt = $('input[name="fp_bt_cancelar"]');
	
	bt.click(function(e){
		e.preventDefault();
		
		//Evento
		var botao = $(this);
		botao.attr('name','fp_bt_novo');
		botao.attr('value','Novo');
		bt_novo();
		remove_upload();
		
		
		var form   = $('form[name="forma_pagamento_form"] input, form[name="forma_pagamento_form"] select');

		form.attr('disabled','disabled');;
		
		
		var input_text = $('div#fp_form_sup input');
		input_text.attr('value','');
		
		var botao = $('div#botoes_fp input');
		botao.removeAttr('disabled');
	});
	
}
// ====================================================================

var seleciona_forma_de_pagamento = function(classe){
	$(classe).click(function(e){
		e.preventDefault();
		var valor = classe;
		
		
		
		//Efeito visual;
		efeito_cor_linha_tabela(valor);
		
		
		//Evento;
		var id = $(this).attr('id');
		
		$.post(
			'php/cadastro/financeiro/forma_pagamento/formulario.php',
			{'id':id},
			function(data){
				$('div#fp_form_sup').html(data);
				setTimeout(function(){
								$('form[name="forma_pagamento_form"] select').attr('disabled','disabled');
								imagem();
							},500);
				
			}
		);
		
		
	});
}


var efeito_cor_linha_tabela = function(classe){
	
		var id = $(classe).attr('id');
		
		/*$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
		$('tr[id="'+id+'"],  tr[id="'+id+'"]  td').addClass('tr_selecionada');*/
		
	
}
seleciona_forma_de_pagamento('.linha_fp');

// Evento botão excluir ===============================================
var bt_excluir = function(){
	var bt = $('input[name="fp_bt_excluir"]');
	
	
	
	
		bt.click(function(){
			var id = $('input[name="fp_codigo"]').val();
			var confirma = confirm('Deseja realmente excluir?');
			if(id != ''){
				if(confirma){
					$.getJSON(
						'php/cadastro/financeiro/forma_pagamento/delete_forma_pagamento.php',
						{ 'id': id },
						function(data){
							alert(data[0].mensagem);
							if(data[0].codigo_retorno == 1){
								estado_inicial();
								atualizar_lista();
							}
						}
					);
				
				}
			}
		});
	
	
}
bt_excluir();
// ====================================================================


// Evento do botão salvar =============================================

var bt_salvar = function(){
	var bt = $('input[name="fp_bt_salvar"]');
	
	bt.click(function(e) {
        e.preventDefault();
		
		var codigo 			= $('input[name="fp_codigo"]').val();
		var descricao		= $('input[name="fp_descricao"]').val();
		var valor_max		= $('input[name="fp_valor_maximo"]').val();
		var tipo_venda		= $('select[name="fp_tipo_venda"]').val();
		var tipo_pagamento 	= $('select[name="fp_tipo_pagamento"]').val();
		var parcela_max		= $('input[name="fp_parcela_maximo"]').val();
		
		
		
		//Verifica se é produto novo ou é alteração
		if(codigo == ''){
			
			//NOVA FORMA DE PAGAMENTO
			$.getJSON(
				'php/cadastro/financeiro/forma_pagamento/insert_forma_pagamento.php',
				{ 
					'descricao'		: descricao,
					'valor_max'		: valor_max,
					'tipo_venda'	: tipo_venda,
					'tipo_pagamento': tipo_pagamento,
					'parcela_max'	: parcela_max
				},
				function(data){
					alert(data[0].texto);
					if(data[0].codigo_retorno == 1){
						atualizar_lista();
					}
				}
			);		
		}else{
			
			var confirmacao = confirm('Deseja realizar a alteração?');
			
			if(confirmacao){
				//Atualiza forma de pagamento
				$.getJSON(
					'php/cadastro/financeiro/forma_pagamento/update_forma_pagamento.php',
					{ 
						'descricao'		: descricao,
						'valor_max'		: valor_max,
						'parcela_max'	: parcela_max,
						'id': codigo
					},
					function(data){
						
						alert(data.texto);
						if(data.codigo == 1){
							atualizar_lista();
						}
					}
				)	
			}
			
		}
		
    });
}
bt_salvar();

// ====================================================================


