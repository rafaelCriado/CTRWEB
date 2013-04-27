// JavaScript Document

var PedRel_bt_limpar = function(botao){
	/*Carrega */	
	$(botao).click(function(e){
		e.preventDefault();
		
		preencheDiv('#PedRel_DIV','Aqui eu recebi o valor');
		
		
	})
	
	
}

PedRel_bt_limpar('input:button[name="PedRel_BT_LIMPAR"]');




var preencheDiv = function(div, corpo){
	
	/* Função genérica para preencher DIV*/
	
	$(div).html(corpo);
}