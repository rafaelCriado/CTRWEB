// JavaScript Document
var PedRel2_bt_enviar = function(botao){
		
	$(botao).click(function(e){
		e.preventDefault()
		
		PrencherTela('#PedRel2_left','Texto!!!');
		
		PrencherTelaRight('#PedRel2_right');	
	
	});	
	
}

PedRel2_bt_enviar('#PedRel2_bt_enviar')

var PrencherTela = function(div,corpo){
	$(div).html(corpo);
}

var PrencherTelaRight = function(div){
	$.post(
			'php/pedidos/relatorio2/requisicao.php',
			function(data){
				
				PrencherTela(div,data)

			}
			);	
}