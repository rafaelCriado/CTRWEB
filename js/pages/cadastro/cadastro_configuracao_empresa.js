//Efeito de Abas ==============================================
$("#tabstrip_configuracao_loja").kendoTabStrip({
	animation:	{
		open: {
			
			effects: "fadeIn"
		}
	}

});
// ============================================================



$('input[name="start_bt_cp"]').click(function(e){
	e.preventDefault();
	
	
	$('a[name="pesquisa_condicao_pagamento"]').click();
	
	setTimeout(function(){$.post('pesquisa_condicao_pagamento.php',
			{'parametro': 1},
			function(data){
				$('#pesquisa_condicao_pagamento').html(data);
				setTimeout(function(){$('input[name="pesquisa_condicao_pagamento_tela_retorno"]').val('cadastro_configuracao_empresa|NOME:start_cp_nome,CODIGO:start_cp')},1000);;
				
	});},1000);
	
});









//Botão salvar ================================================
$('input[name="bt_config_loja_salvar"]').click(function(e){
	e.preventDefault();
	
	var tabela_preco = $('select[name="tabela_preco"]');
	var condicao 	 = $('input[name="start_cp"]');
	
	if(tabela_preco.val() != ''){
		
		//Requisição
		$.ajax({
			url: 'php/cadastro/configuracao/loja/update_config_empresa.php', 
			dataType: 'json',
			data: { 'tabela_preco' : tabela_preco.val(),
					'condicao_pagamento' : condicao.val() },
			type: 'POST',
			
			success: function(data) {
						alert(data[0].mensagem);
						if(data[0].codigo != 0){
							
							
							$('a[name="cadastro_configuracao_empresa"]').click();
							
							
						}
					 },
			error: function(xhr,er) {
						alert('Erro de requisição');
					 }		
					 
		});
					
	}else{
		alert('Escolhar uma tabela de preço!');
	}
	
})
// ============================================================



//Bt excluir ===================================================================
$('a[name="ex_cp_start"]').click(function(){
	$.ajax({
		url: 'php/cadastro/configuracao/loja/exclui_condicao_pagamento.php', 
		dataType: 'json',

		type: 'POST',
		
		success: function(data) {
					alert(data[0].mensagem);
					if(data[0].codigo != 0){
						
						
						$('a[name="cadastro_configuracao_empresa"]').click();
						
						
					}
				 },
		error: function(xhr,er) {
					alert('Erro de requisição');
				 }		
				 
	});	
});
// ============================================================================