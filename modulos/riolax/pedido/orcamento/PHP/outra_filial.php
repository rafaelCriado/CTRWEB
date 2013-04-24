<style>
	#tabstrip_pedido_orcamento-3{ height:456px}
</style>
<div style="height:300px;">
	<h4>O Cliente selecionado para este orçamento, pertence a outra filial, precisamos saber o motivo do cliente estar fazendo este orçamento em sua filial?</h4>
    <textarea name="atuacao_outra_filial_texto" cols="30" rows="15" style="width:100%"></textarea>
    <br />
	<br />

    <input type="button" name="bt_continuar_gravar_orcamento" value="Salvar" />
    <input type="button" name="bt_voltar_gravar_orcamento" value="Voltar" />
</div>
<script>
	var bt_voltar_gravar_orcamento = function(){
		$('input[name="bt_voltar_gravar_orcamento"]').click(function(){
			
			$('#orcamento_detalhar_parcelas').css({display:'block'})
			$('#orcamento_filial_sem_atuacao').css({display:'none'})
		});
	}
	bt_voltar_gravar_orcamento();
	
	var salvar = function(){
		
		var bt = $('input[name="bt_continuar_gravar_orcamento"]');
		
		bt.click(function(e){
			e.preventDefault();
			
			var texto = $('textarea[name="atuacao_outra_filial_texto"]').val()
			
			
			if(texto == '' || texto.length < 50 ){
				
				alert('Digite o motivo, com no minimo 50 caracteres.');
				
			}else{
				
				grava_orcamento2();
				
				
			}
			
		});
		
	}
	salvar();
	
	
		var grava_orcamento2 = function(){
			
			 var texto 					= $('textarea[name="atuacao_outra_filial_texto"]').val();
			 var cliente 				= $('input[name="orc_cliente"]').val();
			 var usuario 				= $('input[name="orc_usuario"]').val();
			 var data					= $('input[name="orc_data"]').val();
			 var data_final				= $('input[name="orc_data_final"]').val();
			 var prazo_entrega			= $('input[name="orc_prazo_entrega"]').val();  	
			 var frete					= $('input[name="orc_valor_frete"]').val();
			 var desconto				= $('input[name="orc_desconto"]').val();
			 var total					= $('input[name="orc_total"]').val();
			 var observacao				= $('textarea[name="obs_orc"]').val();
			 var categoria				= $('input[name="orc_categoria"]').val();
			 var modelo					= $('input[name="orc_modelo"]').val();
			 var medida					= $('input[name="orc_medida"]').val();
			 var linha					= $('input[name="orc_linha"]').val();
			 var acabamento				= $('input[name="orc_acabamento"]').val();
			 var cores					= $('input[name="orc_cores"]').val();
			 var posicao				= $('input[name="orc_posicao"]').val();
			 var voltagem				= $('input[name="orc_voltagem"]').val();
			 var fechamento				= $('input[name="orc_fechamento"]').val();
			 var adicional				= $('input[name="orc_valor_adicional"]').val();
			 var previsao_venda			= $('select[name="orc_prev_venda"]').val();
			 var condicao_pagamento		= $('input[name="orc_condicao_codigo"]').val();
			 var valor_tx_abertura  	= $('input[name="orc_detal_financeira_tx_abert"]').val();
			 var addFreteFinanc     	= 0;
			 var addAdicionalFinanc 	= 0;
			 var forma_pagamento  		= $('select[name="orc_forma_pagamento"]').val();
			 var forma_pagamento_teste 	= $('input[name="orc_forma_pagamento_teste"]').val();
			 
			 if(forma_pagamento_teste != ''){
				 forma_pagamento = forma_pagamento_teste;
			 }
			 
			 if($('input[name="orc_adicional_incluir"]').is(':checked')){
				 addAdicionalFinanc = 1;
			 }

			 if($('input[name="orc_frete_incluir"]').is(':checked')){
				 addFreteFinanc = 1;
			 }
			 

			$.ajax({
				url: 'modulos/riolax/pedido/orcamento/PHP/grava_orcamento.php', 
				dataType: 'json',
				data: {
						"cliente" 				: cliente,
						"usuario" 				: usuario,
						"data" 					: data,
						"data_final"			: data_final,
						"prazo_entrega"			: prazo_entrega,
						"frete" 				: frete,
						"desconto" 				: desconto,
						"observacao" 			: observacao,									
						"categoria"				: categoria,
						"modelo"				: modelo,
						"medida"				: medida,
						"linha"					: linha,
						"acabamento"			: acabamento,
						"cores"					: cores,
						"posicao"				: posicao,
						"voltagem"				: voltagem,
						"fechamento"			: fechamento,
						"adicional"				: adicional,
						"previsao_venda"		: previsao_venda,
						"condicao_pagamento"	: condicao_pagamento,
						"adicionar_frete"		: addFreteFinanc,									  
						"adicionar_adicional"	: addAdicionalFinanc,	
						"taxa_abertura"			: valor_tx_abertura,
						"forma_pagamento"		: forma_pagamento,
						"motivo"				: texto								  
					},

				type: 'POST',
				success: function(data) {
							if(data[0].codigo_retorno == 0){
								alert(data[0].texto);
							}else{
								$('#tabstrip_pedido_orcamento ul li:eq(3)').click()
								alert(data[0].texto + data[0].codigo_retorno);
								$.post(
									'modulos/riolax/pedido/orcamento/PHP/tela_pesquisa.php',
									{
										"orcamento" : data[0].codigo_retorno,
										"status"	: 1
									},
									function(data){
										$('div#po_aba_quatro').html(data);
									}
								);
								
							}
							
						 },
				error: function(xhr,er) {
							alert('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	;
						 }		
			});
			 
	}

</script>

