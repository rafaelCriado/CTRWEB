var seleciona_orcamento = function(){
	$('table.pesquisa_financeira tr').live('dblclick',function(){
			
			
			var id = $(this).attr('id');
			var tela_retorno = $('input[name="pesquisa_financeira_tela_retorno"]').val();
			
		if(tela_retorno != 0){
		
			var info = tela_retorno.split('|');
			var tela_requisicao = info[0];
			
			var variaveis = info[1].split(',');
			var num_variaveis = variaveis.length;
			
			var campo_pedido = [];
			var campo_preencher = [];
			
			for(var x=0; x<num_variaveis; x++){
				var valores = variaveis[x].split(':');
				
				campo_pedido[x] = valores[0];
				campo_preencher[x] = valores[1];
				
			}
			
			$.ajax({
				url: 'php/requisitions/financeira.ajax.php', 
				dataType: 'json',
				data: { "id": id},
				type: 'POST',
				success: function(data) {
							
							// ============================= FECHA TELA ==========================================
							$('#pesquisa_financeira').parent().closest('div').css({display:'none'});
							// ===================================================================================
							
							for(var y=0; y<num_variaveis; y++){
								
								var valor = eval('data.'+campo_pedido[y]);
								$('input[name="' + campo_preencher[y] + '"]').val(valor)
								
							}
							$('input[name="tipo_pesquisa_produto_tela_retorno"]').val('0');
						 },
						 
				error: function(xhr,er) {
							$('#pesquisa_financeira').html(xhr+er);
								
						 }
			});
			
		}
	});
}

seleciona_orcamento();




var seleciona_linha = function(tabela){
		$(tabela).live('click',function(e){
				var id = $(this).attr('id');
				$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
				$('tr[id="'+id+'"], tr[id="'+id+'"] td').addClass('tr_selecionada');
		});
	}
seleciona_linha('table.pesquisa_financeira tr');