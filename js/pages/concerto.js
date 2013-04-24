$(function(){// Conserto
	
	
	//JANELA Cadastro -> Localidade -> UF  ======================================================================//
	
	
	//Evento para carregar lista de eventos cadastrados
	$('select[name="evento"]').change(function(){
					
		$.post("php/lista_de_versoes_android.php", 
			{tipo:$(this).val()},
				function(valor){
					$("#retorno_horario_evento").html(valor);
	  	});
	});
	
	

	//JANELA Cadastro de Tipos dos Eventos ++++++++++++++++++++++
	$('a[name="tipos_evento"]').live("click", function(e){ 
		e.preventDefault(); 
	});
	
	var tipos_evento = $("#tipo_evento"),
	bt_tipos_evento = $('a[name="tipos_evento"]').bind("click", function() {
				tipos_evento.data("kendoWindow").open().center();
				bt_tipos_evento.show();
			});
			
	if (!tipos_evento.data("kendoWindow")) {
		tipos_evento.kendoWindow({
			width: "800px",
			height: "400px",
			resizable: false,
			actions: ["Close"],
			title: "Tipos de Eventos",
			close: function() {
						bt_tipos_evento.show();
					}
		});
	}
	
	$("#tipo_evento").data("kendoWindow").close();
	
	//Excluir tipo de evento
	$('a[name="bt_excluir_tipo_curso"]').live("click", function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/excluir_tipo_evento.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_tipo_evento').html('<p>' + data + '</p>');
							$('#retorno_tipo_evento').load('php/lista_de_tipos_de_cursos.php');
						 },
				error: function(xhr,er) {
							$('.resultado_tipo_evento').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	
	//Botão Cadastrar o tipo do evento
	$('input[name="bt_cadastrar_tipo_evento"]').live("click", function(e){
		e.preventDefault();
		
		var tipo_evento = $('input[name="tipo_evento"]').val();

		$.ajax({
			url: 'php/add_tipo_evento.php', 
			dataType: 'html',
			data: { tipo:tipo_evento},

			type: 'POST',
			success: function(data, textStatus) {
						$('.resultado_tipo_evento').html('<p>' + data + '</p>');
						$('#retorno_tipo_evento').load('php/lista_de_tipos_de_cursos.php');
					 },
			error: function(xhr,er) {
						$('.resultado_tipo_evento').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
					 
		});
		
	});
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//FIM EVENTO==============================================================
					
					
					
					
					$('.bt_horario').live("click", function(e){
						e.preventDefault();
	
						var id_ = $(this).attr("title");
						
						var window_clock = $("#window_clock"),
							undo = $(".bt_horario")
									.bind("click", function() {
										window_clock.data("kendoWindow").open();
										
									});
	
						var onClose = function() {
							
							undo.show();
						}
					   
	
						if (!window_clock.data("kendoWindow")) {
							window_clock.kendoWindow({
								width: "900px",
								actions: ["Minimize", "Maximize", "Close"],
								title: "Horário",
								content: "clock_cursos.php?id="+id_,
								close: onClose,
								
							});
						}
						
					});
				

				
				
	//Central de Atualizações
	
	//Botão Cadastrar Versão
	$('input[name="bt_cadastrar_versao"]').live("click", function(e){
		e.preventDefault();
		
		var version = $('input[name="versao"]').val();
		var detal = $('input[name="detalhe"]').val();
		var verSifat = $('input[name="versao_sifat"]').val();
		var tip = $('select[name="tipo"]').val();
		var url = $('input[name="link"]').val();
		
		$.ajax({
			url: 'php/add_versao.php', 
			dataType: 'html',
			data: { versao:version, detalhe: detal, versao_sifat:verSifat, tipo:tip, links:url},

			type: 'POST',
			success: function(data, textStatus) {
						$('.resultado_android').html('<p>' + data + '</p>');
						$('#retor_android').load('php/lista_de_versoes_android.php?tipo='+tip)
					 },
			error: function(xhr,er) {
						$('.resultado_android').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
					 
		});
		
		
		
		
		
		
	});
		var mobile = $("#mobile"),
		undo_mobile = $('a[name="a_mobileShop"]').bind("click", function() {
						 mobile.data("kendoWindow").open().center();
						 undo_mobile.show();
					   });

	if(!mobile.data("kendoWindow")){
		mobile.kendoWindow({
			width: "900px",
			height: "400px",
			actions: ["Minimize", "Maximize", "Close"],
			title: "Central de Atualizações",
			close: function() {
				undo_mobile.show();
			}
		});
	}
	
	$("#mobile").data("kendoWindow").close();
	
	$('select[name="tipo"]').kendoComboBox();
	
	$("#calendar").kendoCalendar({
		culture: "pt-BR"
	});
	
		
				
				
	
				
	$('a[name="bt_excluir_versao"]').live("click", function(e){
		e.preventDefault();
		var vrs = $('select[name="tipo"]').val();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/excluir_versao.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_android').html('<p>' + data + '</p>');
							$('#retor_android').load('php/lista_de_versoes_android.php?tipo='+vrs);
						 },
				error: function(xhr,er) {
							$('.resultado_android').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	
	
	//Cadastro de Aplicativos
	$('a[name="cadastro_aplicativos"]').click(function(e){ e.preventDefault(); });
		var window = $("#cadastro_aplicativos"),
		undo = $('a[name="cadastro_aplicativos"]').bind("click", function() {
					window.data("kendoWindow").open().center();
					undo.show();
				});
				
		if (!window.data("kendoWindow")) {
			window.kendoWindow({
				width: "800px",
				height: "400px",
				resizable: false,
				actions: ["Close"],
				title: "Cadatro de Aplicativos",
				close: function() {
							undo.show();
						}
			});
		}
		
		$("#cadastro_aplicativos").data("kendoWindow").close();	
		
	});
	
	//Botão Cadastrar Aplicativo
	$('input[name="bt_cadastrar_aplicativo"]').live("click", function(e){
		e.preventDefault();
		
		var name = $('input[name="nome_aplicativo"]').val();
		
		$.ajax({
			url: 'php/add_aplicativo.php', 
			dataType: 'html',
			data: { nome:name },

			type: 'POST',
			success: function(data, textStatus) {
						
						$('.resultado_cadastro_aplicativo').html('<p>' + data + '</p>');
						$('#retor_cadastro_aplicativo').load('php/lista_de_tipos_aplicativos.php');
					 },
			error: function(xhr,er) {
						$('.resultado_cadastro_aplicativo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
		});
	});
	
	//Botão excluir Aplicativo
	$('a[name="bt_excluir_aplicativo"]').live("click", function(e){
		e.preventDefault();

		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/excluir_aplicativo.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_cadastro_aplicativo').html('<p>' + data + '</p>');
							$('#retor_cadastro_aplicativo').load('php/lista_de_tipos_aplicativos.php');
						 },
				error: function(xhr,er) {
							$('.resultado_cadastro_aplicativo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	
	
	
		
	
});