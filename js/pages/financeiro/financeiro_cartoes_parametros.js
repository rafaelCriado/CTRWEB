//Altura da tela central
setInterval(
	function(){
		
		var esquerda 	 = $('div#cc_esquerda').innerHeight();
		var altura_form	 = (esquerda*92)/100;
		
		
		$('div#cc_form').css({height:altura_form});
	},
	100);
	
	
//Estado inicial do formulário ========================================
var estado_inicial = function(){
	var input = $('form[name="cartao_credito_form"] input, form[name="cartao_credito_form"] select');
	input.attr('disabled','disabled');
	
	var botao = $('div#botoes_cc input');
	botao.removeAttr('disabled');
	
	var input_text = $('div#cc_form_sup input');
	input_text.attr('value','');
}
estado_inicial();
// ====================================================================

// Atualizar lista ====================================================
var atualizar_lista = function(){
	$.post(
		'php/financeiro/cartoes/parametros/lista_forma_pagamento.php',
		function(data){
			$('div#cc_esquerda').html(data);
		}
	);
}
// ====================================================================

//Evento clicar em novo ===============================================
var bt_novo = function(){
	var bt = $('input[name="cc_bt_novo"]');
	
	bt.click(function(e){
		e.preventDefault();
		
		//Evento
		var botao = $(this);
		botao.attr('name','cc_bt_cancelar');
		botao.attr('value','Cancelar');
		bt_cancelar();
		
		$('div#parcela_cc div').html('');
		
		
		var form   = $('form[name="cartao_credito_form"] input, form[name="cartao_credito_form"] select');
		var codigo = $('input[name="cc_codigo_demo"]');
		
		
		form.removeAttr('disabled');
		
		var input_text = $('div#cc_form_sup input');
		input_text.attr('value','');
		
		codigo.attr('disabled','disabled');
		
		
	});
	
}
bt_novo();
// ====================================================================

//Evento clicar em cancelar ===========================================
var bt_cancelar = function(){
	var bt = $('input[name="cc_bt_cancelar"]');
	
	bt.click(function(e){
		e.preventDefault();
		
		//Evento
		var botao = $(this);
		botao.attr('name','cc_bt_novo');
		botao.attr('value','Novo');
		bt_novo();
		
		
		var form   = $('form[name="cartao_credito_form"] input, form[name="cartao_credito_form"] select');

		form.attr('disabled','disabled');;
		
		
		var input_text = $('div#cc_form_sup input');
		input_text.attr('value','');
		
		var botao = $('div#botoes_cc input');
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
			'php/financeiro/cartoes/parametros/formulario.php',
			{'id':id},
			function(data){
				$('div#cc_form_sup').html(data);
				setTimeout(function(){	
								
								$('input[name="cc_rede"]').attr('disabled','disabled');
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
seleciona_forma_de_pagamento('.linha_cc');

// Evento botão excluir ===============================================
var bt_excluir = function(){
	var bt = $('input[name="cc_bt_excluir"]');
	
	
	
	
		bt.click(function(){
			var id = $('input[name="cc_codigo"]').val();
			var confirma = confirm('Deseja realmente excluir?');
			if(id != ''){
				if(confirma){
					$.getJSON(
						'php/financeiro/cartoes/parametros/delete_cartao_credito.php',
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
	var bt = $('input[name="cc_bt_salvar"]');
	
	bt.click(function(e) {
        e.preventDefault();
		
		var codigo 				= $('input[name="cc_codigo"]').val();
		var rede				= $('input[name="cc_rede"]').val();
		var transacao			= $('select[name="cc_transacao"]').val();
		var descricao			= $('input[name="cc_descricao"]').val();
		var maximo_parcela 		= $('input[name="cc_parcela_maximo"]').val();
		var repasse				= $('input[name="cc_repasse"]').val();
		var fechamento		 	= $('select[name="cc_fechamento"]').val();
		var recebimento		 	= $('select[name="cc_forma_recebimento"]').val();
		var parcelamento 		= $('select[name="cc_parcelamento"]').val();
		
		
		//Verifica se é produto novo ou é alteração
		if(codigo == ''){
			
			//NOVA FORMA DE PAGAMENTO
			$.getJSON(
				'php/financeiro/cartoes/parametros/insert_cartao.php',
				{ 
					'rede'				:	rede,
					'transacao'			:	transacao,
					'descricao'			: 	descricao,
					'maximo_parcela'	: 	maximo_parcela,
					'repasse'			: 	repasse,
					'fechamento'		: 	fechamento,
					'recebimento'		: 	recebimento,
					'parcelamento'		: 	parcelamento
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
				
				
				
				//parametros
				
				var parametros = '';
				$('input[name^="cc_taxa_"]').each(function() {
                    parametros = parametros + '|' + $(this).val();
                });
				
				
				$.getJSON(
					'php/financeiro/cartoes/parametros/update_cartao.php',
					{ 
						'codigo'			:	codigo,
						'rede'				:	rede,
						'transacao'			:	transacao,
						'descricao'			: 	descricao,
						'maximo_parcela'	: 	maximo_parcela,
						'repasse'			: 	repasse,
						'fechamento'		: 	fechamento,
						'recebimento'		: 	recebimento,
						'parcelamento'		: 	parcelamento,
						'parametros'		:	parametros
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




