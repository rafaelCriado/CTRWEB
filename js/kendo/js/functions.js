// JavaScript Document


//Função cria uma janela com o Kendu
//Configurações:
function criarJanela(ancoraJanela, idDivJanela, tituloJanela, altura, largura){
		//Ancora Janela = nome da ancora da pagina.
		
		//Função para criar tela.
		$('a[name="'+ ancoraJanela +'"]').live("click", function(e){ 
			e.preventDefault(); 
		});
		
		var eventos = $("#" + idDivJanela),
		bt_eventos = $('a[name="'+ ancoraJanela +'"]').bind("click", function() {
					eventos.data("kendoWindow").open().center();
					bt_eventos.show();
				});
				
		if (!eventos.data("kendoWindow")) {
			eventos.kendoWindow({
				width: largura,
				height: altura,
				resizable: false,
				actions: ["Close"],
				title: tituloJanela,
				close: function() {
							bt_eventos.show();
						}
			});
		}
		
		$("#" + idDivJanela).data("kendoWindow").close();
		
}