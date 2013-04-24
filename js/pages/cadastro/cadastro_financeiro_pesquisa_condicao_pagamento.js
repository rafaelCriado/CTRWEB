var seleciona_orcamento = function(){
	$('table.pesquisa_condicao_pagamento tr').live('dblclick',function(){
			
			
			var id = $(this).attr('id');
			var tela_retorno = $('input[name="pesquisa_condicao_pagamento_tela_retorno"]').val();
			
			
			
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
				url: 'php/requisitions/condicao_pagamento.ajax.php', 
				dataType: 'json',
				data: { "id": id},
				type: 'POST',
				success: function(data) {
							
							// ============================= FECHA TELA ==========================================
							$('#pesquisa_condicao_pagamento').parent().closest('div').css({display:'none'});
							// ===================================================================================
							
							for(var y=0; y<num_variaveis; y++){
								
								var valor = eval('data.'+campo_pedido[y]);
								$('input[name="' + campo_preencher[y] + '"]').val(valor)
								
							}
							$('input[name="pesquisa_condicao_pagamento_tela_retorno"]').val('0');
						 },
						 
				error: function(xhr,er) {
							$('#pesquisa_condicao_pagamento').html(xhr+er);
								
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
seleciona_linha('table.pesquisa_condicao_pagamento tr');




var seleciona_financeira = function(){
	
	var financeira = $('select[name="filtro_cp_financeira"]');
	
	financeira.change(function(e) {
        if(financeira.val() != ''){
			
			var carencia = $('select[name="filtro_cp_carencia"]').val();
			var parcelas = $('select[name="filtro_cp_qtde_parcela"]').val();
			
			$.ajax({
				   url: 'php/cadastro/financeiro/pesquisa/pesquisa_filtros.php', 
			  dataType: 'html',
			  	  type: "POST",
				  data: { 'financeira': financeira.val(), 'carencia': carencia, 'parcelas': parcelas },
			beforeSend: function(){
							$('#pcp_table').html(
									'<img src="img/carregando.gif" alt="Aguarde">');
						},
			   success: function(data) {
							$('#pcp_table').html(data);
						 },
				 error: function(xhr,er) {
							$('#pcp_table').html(
									'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
									'<br />Tipo de erro: ' + er +'</p>')	
						}		
			});	
		}
    });
	
}
seleciona_financeira();



var seleciona_carencia = function(){
	
	var carencia = $('select[name="filtro_cp_carencia"]');
	
	carencia.change(function(e) {
        if(carencia.val() != ''){
			
			var financeira = $('select[name="filtro_cp_financeira"]').val();
			var parcelas = $('select[name="filtro_cp_qtde_parcela"]').val();
			
			$.ajax({
				   url: 'php/cadastro/financeiro/pesquisa/pesquisa_filtros.php', 
			  dataType: 'html',
			  	  type: "POST",
				  data: { 'financeira': financeira, 'carencia': carencia.val(), 'parcelas': parcelas },
			beforeSend: function(){
							$('#pcp_table').html(
									'<img src="img/carregando.gif" alt="Aguarde">');
						},
			   success: function(data) {
							$('#pcp_table').html(data);
						 },
				 error: function(xhr,er) {
							$('#pcp_table').html(
									'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
									'<br />Tipo de erro: ' + er +'</p>')	
						}		
			});	
		}
    });
	
}
seleciona_carencia();

var seleciona_parcela = function(){
	
	var parcelas = $('select[name="filtro_cp_qtde_parcela"]');
	
	parcelas.change(function(e) {
        if(parcelas.val() != ''){
			
			var financeira = $('select[name="filtro_cp_financeira"]').val();
			var carencia   = $('select[name="filtro_cp_carencia"]').val();
			
			$.ajax({
				   url: 'php/cadastro/financeiro/pesquisa/pesquisa_filtros.php', 
			  dataType: 'html',
			  	  type: "POST",
				  data: { 'financeira': financeira, 'carencia': carencia, 'parcelas': parcelas.val() },
			beforeSend: function(){
							$('#pcp_table').html(
									'<img src="img/carregando.gif" alt="Aguarde">');
						},
			   success: function(data) {
							$('#pcp_table').html(data);
						 },
				 error: function(xhr,er) {
							$('#pcp_table').html(
									'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
									'<br />Tipo de erro: ' + er +'</p>')	
						}		
			});	
		}
    });
	
}
seleciona_parcela();



