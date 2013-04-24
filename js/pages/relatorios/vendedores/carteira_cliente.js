// JavaScript Document

var regula_tela = function(){
	var altura_principal = $('div#relatorios_vendedores_carteira_cliente').height();
	var altura_filtro	 = $('div#RCC-cabecalho').height();
	$('div#RCC-corpo').height(altura_principal-altura_filtro - 12);	
}
regula_tela();



var carrega_relatorio = function(){
	
	var botao = $('input[name="RCC_F-bt_consultar"]'),vendedor,previsao,corpo = $('div#RCC-corpo');
	
	botao.click(function(e){
		e.preventDefault();
		
		vendedor = $('select[name="RCC_F-vendedor"]').val();
		previsao = $('select[name="RCC_F-previsao"]').val();
		if(vendedor != '' && previsao != ''){
			
			$.ajax({
					 url: 'php/relatorios/vendedores/carteira_cliente/pesquisa_orcamentos.php',
				dataType: 'html',
					data: { 'vendedor':vendedor, 'previsao': previsao},
					type: 'POST',
				 success: function(data){
					 			corpo.html(data);
						  },
			       error: function(xhr,err){
					   			alert(xhr.status);
				   		  }
				
			});
		}
	});
	
}
carrega_relatorio();