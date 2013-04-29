/* JAVASCRIPT PEDIDO -> ORÇAMENTO ==========================================================================
		autor: Rafael Marques Criado
		data : 23/01/2013
   alterações: 	
   ==========================================================================================================*/
$(document).ready(function(e) {

	//CRIA AS ABAS ++++++++++++++++++++++++++++++++++++++++
	$("#tabstrip_pedido_orcamento").kendoTabStrip({
		animation:	{
			open: {
				
				effects: "fadeIn"
			}
		}
	
	});
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	function produto(variavel){
		var retorno = variavel.split('_');
		return retorno[1];
	}
	
	$('h2.accordion').click(function(){
		$(this).parent().find('div.accordion').slideToggle("slow");
	});
	
	$('a[name^="produto_"]').live('click',function(e){ 
		$('input[name="produto_select"]').val($(this).attr('id'));
		$('#produto_selecinado_ac').html(produto($(this).attr('name'))).attr('name',$(this).attr('id'));
	});
	
	
	$('a[name="continuar_op_passo_dois"]').live('click',function(e){
		e.preventDefault();
		if($('input[name="produto_select"]').val() != ''){
			$('#ca-container').removeClass('passo-ativo');
			$('#ca-container').addClass('passo-desativado');
			
			$('#container-3passo').removeClass('passo-desativado');
			$('#container-3passo').addClass('passo-ativo');
			
			$('.divPassoaPasso span:eq(1)').removeClass('passo_selecionado');
			$('.divPassoaPasso span:eq(2)').addClass('passo_selecionado');
			
			
			$('a[name="voltar_op_passo_um"]').attr('name','voltar_op_passo_dois');
			$(this).attr('name','continuar_op_passo_tres');
			
			
			
		}else{
			alert('Escolha um produto');
		}
	});
	
	
	$('a[name="voltar_op_passo_dois"]').live('click',function(e){
		e.preventDefault();
		$('#container-3passo').removeClass('passo-ativo');
		$('#container-3passo').addClass('passo-desativado');
		
		$('#ca-container').removeClass('passo-desativado');
		$('#ca-container').addClass('passo-ativo');
		
		$('.divPassoaPasso span:eq(2)').removeClass('passo_selecionado');
		$('.divPassoaPasso span:eq(1)').addClass('passo_selecionado');
		
		$('a[name="continuar_op_passo_tres"]').attr('name','continuar_op_passo_dois');
		$('a[name="voltar_op_passo_dois"]').attr('name','voltar_op_passo_um');
		
		
		
		
	})
	
	$('a[name="voltar_op_passo_um"]').live('click',function(e){
		e.preventDefault();
		
		$('#tabstrip_pedido_orcamento ul li:eq(0)').click();
		
	})
	
	
	$('a[name="continuar_op_passo_tres"]').live('click',function(){
		$('div#tabstrip_pedido_orcamento ul li:eq(2)').click();	
	});	
	
	// ********************************* ABA INICIO ***********************************
		
		
		
		
		
		// PREENCHER COM DATA ATUAL (INPUT DATA)=================
		var preenche_data_atual = function(campo){
			
			var input = $(campo);
			
			var data = new Date();
			var dia  = data.getDate();
			var mes	 = data.getMonth()+1;
			var ano  = data.getFullYear();
			
			if(input.val() == ''){
				input.val(dia+'/'+mes+'/'+ano);
			}
		}
		preenche_data_atual('input[name="po_data"]');
		// ======================================================
		
		
		// BUSCA CLIENTE (INPUT NOME) ===========================
		
			$('input[name="po_name"]').focus(function(){ 
				
				var codigo_cliente = $('input[name="po_codigo_cliente"]').val();
				
				if(codigo_cliente == 0){
					$('a[name="cadastro_entidade_pesquisa_pessoa"]').click();
					var id = setInterval(function(){
						//pedido_orcamento|CODIGO:po_codigo_cliente,NOME:po_name
						if($('input[name="tipo_pesquisa_tela_retorno"]').val() != 'pedido_orcamento|CODIGO:po_codigo_cliente,NOME:po_name'){
						
							$('input[name="tipo_pesquisa_tela_retorno"]').val('pedido_orcamento|CODIGO:po_codigo_cliente,NOME:po_name');
							
						}else{
							clearInterval(id);
						}
					},1000);
						
				}
			});
		
		// ======================================================
		
		
		// Botão novo cliente ====================================
			$('a[name="bt_orc_novo_cliente"]').live("click",function(e){
				e.preventDefault();
				$('a[name="cadastro_entidade_pessoa"]').click();
				setTimeout(
					function(){
						$('a[name="bt_entidade_nova"]').click();
					}
					,1000);
			});
		
		// =======================================================
		
		
		// Botão pesquisar =======================================
			$('a[name="bt_orc_pesquisar_cliente"]').live("click",function(e){
				e.preventDefault()
				$('a[name="cadastro_entidade_pesquisa_pessoa"]').click();
					setTimeout(function(){
						$('input[name="tipo_pesquisa_tela_retorno"]').val('pedido_orcamento|CODIGO:po_codigo_cliente,NOME:po_name')}
						,2000);
			});
		// =======================================================
		
		
		
		// VERIFICAR SEM CAMPO CLIENTE ESTA VAZIO================
		
			$('input[name="po_name"]').live('change',function(){
				$('#tabstrip_pedido_orcamento ul li:eq(2)').click();
			});
		
		// ======================================================
		
		// EVENTO BOTÃO =========================================
			$('input[name="po_continuar"]').click(function(){
				if($('input[name="po_name"]').val() == ''){
					
					$('input[name="po_codigo_cliente"]').val('0');
					$('input[name="po_name"]').val('');
					alert('Cliente não foi escolhido');
					
				}else if($('input[po_codigo_cliente]').val() == 0){
					
					alert('Cliente não localizado!');
					$('input[name="po_name"]').val('');
					
				}else if($('input[name="po_data"]').val() == ''){
					
					alert('Escreva uma data!');
					
				}else{

					$('#tabstrip_pedido_orcamento ul li:eq(1)').click();

				}
				
			})
		// ======================================================
		
		
		
	// ********************************************************************************
	
	
	// CLICAR AO GRUPO =============================================
		$('a[name="tela_produtos_categoria"]').live('click',function(e){
			e.preventDefault();
			
			//Variavel
			var grupo  = $(this).attr('id');
			var nGrupo = $(this).attr('title');
			
			//Esconde tela primeiro passo
			$('div.primeiro_passo').css({display:'none'});
			
			//Mostra Segundo Passo
			$('div.segundo_passo').css({display:'inline-block'});
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/tela_segundo_passo.php',
				{ 
					"grupo" : grupo,
					"nGrupo": nGrupo
				},
				function(data){
					$('div.segundo_passo').html(data);
				}
			);
		});
		
	// =============================================================

	// CLICAR AO SUBGRUPO =============================================
		$('a[name="tela_produtos_subcategoria"]').live('click',function(e){
			e.preventDefault();
			
			//Variavel
			var ID  = $(this).attr('id');
			
			ID 				= ID.split('|');
			
			var cGrupo 		= ID[0];
			var cSubgrupo 	= ID[1];
			
			var NOME 		= $(this).attr('title');
			
			NOME 			= NOME.split('|');
			
			var nGrupo 		= NOME[0];
			var nSubgriupo 	= NOME[1];
			
			
			//Esconde tela primeiro passo
			$('div.segundo_passo').css({display:'none'});
			
			//Mostra Segundo Passo
			$('div.terceiro_passo').css({display:'inline-block'});
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/tela_terceiro_passo.php',
				{ 
					"cGrupo" 	: cGrupo,
					"nGrupo"	: nGrupo,
					"cSubgrupo" : cSubgrupo,
					"nSubgrupo"	: nSubgriupo
				},
				function(data){
					$('div.terceiro_passo').html(data);
				}
			);
		});
		
	// =============================================================
	
	
	//Ao Selecionar a dimensão verifica a linha. =====================
		$('select[name="prod_dim"]').live("change",function(){
			
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/linhas.php?search=',
				{ 
					grupo	: $('input[name="cGrupo"]').val(), 
					subgrupo: $('input[name="cSubgrupo"]').val(),
					medidas	: $('select[name="prod_dim"]').val()
				}, 
				
				function(j){
					
					$('#recebe_linhas').html(function(){
						var options = '<select name="prod_linhas"><option value="">Escolha a linha</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].LINHA + '">' + j[i].LINHA + '</option>';
						}
						options += '</select>';	
						return options;
					});
				});			
			
			
		});
	// =============================================================


	//Ao Selecionar a linha verifica o acabamento. =====================
		$('select[name="prod_linhas"]').live("change",function(){
			
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/acabamentos.php?search=',
				{ 
					grupo	: $('input[name="cGrupo"]').val(), 
					subgrupo: $('input[name="cSubgrupo"]').val(),
					medidas	: $('select[name="prod_dim"]').val(),
					linhas	: $('select[name="prod_linhas"]').val()
				}, 
				
				function(j){
					
					$('#recebe_acabamentos').html(function(){
						var options = '<select name="prod_acabamentos"><option value="">Escolha o acabamento</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].ACABAMENTO + '">' + j[i].ACABAMENTO + '</option>';
						}
						options += '</select>';	
						return options;
					});
				});			
			
			
		});
	// =============================================================

	//Ao Selecionar a acabamento verifica a cores. =====================
		$('select[name="prod_acabamentos"]').live("change",function(){
			
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/cores.php?search=',
				{ 
					grupo		: $('input[name="cGrupo"]').val(), 
					subgrupo	: $('input[name="cSubgrupo"]').val(),
					medidas		: $('select[name="prod_dim"]').val(),
					linhas		: $('select[name="prod_linhas"]').val(),
					acabamentos	: $('select[name="prod_acabamentos"]').val()
				}, 
				
				function(j){
					
					$('#recebe_cores').html(function(){
						var options = '<select name="prod_cor"><option value="">Escolha a cor</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].COR + '">' + j[i].COR + '</option>';
						}
						options += '</select>';	
						return options;
					});
				});			
			
			
		});
	// =============================================================
	
	//Ao Selecionar a cor verifica a posição =====================
	
		
		
		
		$('select[name="prod_cor"]').live("change",function(){
			
			$('#or_kits').css({display:'block'}).html('<img src="img/grupos/posicoes/123.jpg" height="100%" width="100%">');
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/posicao.php?search=',
				{ 
					grupo		: $('input[name="cGrupo"]').val(), 
					subgrupo	: $('input[name="cSubgrupo"]').val(),
					medidas		: $('select[name="prod_dim"]').val(),
					linhas		: $('select[name="prod_linhas"]').val(),
					acabamentos	: $('select[name="prod_acabamentos"]').val(),
					cor			: $('select[name="prod_cor"]').val()
				}, 
				
				function(j){
					
					$('#recebe_posicao').html(function(){
						var options = '<select name="prod_posicao"><option value="">Escolha a posição</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].POSICAO + '">' + j[i].POSICAO + '</option>';
						}
						options += '</select>';	
						return options;
					});
					
					$('#or_kits').css({display:'block'});
					
			
		});
	// =============================================================

	$('select[name="prod_posicao"]').live("change",function(){
		$.getJSON(
			'modulos/riolax/pedido/orcamento/PHP/voltagem.php?search=',
			{
				grupo		: $('input[name="cGrupo"]').val(), 
				subgrupo	: $('input[name="cSubgrupo"]').val(),
				medidas		: $('select[name="prod_dim"]').val(),
				linhas		: $('select[name="prod_linhas"]').val(),
				posicao		: $('select[name="prod_posicao"]').val(),
				acabamentos	: $('select[name="prod_acabamentos"]').val(),
				cor			: $('select[name="prod_cor"]').val()
			},
			function(j){
				$('#recebe_voltagem').html(function(){
					var options = '<select name="prod_voltagem"><option value="">Escolha a posição</option>';	
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].VOLTAGEM + '">' + j[i].VOLTAGEM + '</option>';
					}
					options += '</select>';	
					return options;
				});
				
				$('#or_kits').css({display:'block'});			
			}
		);
	});

	
function formatReal( int )  
{  
        var tmp = int;  
		
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
        if( tmp.length > 4 )  
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");  
  
        return tmp;  
}  

function getMoney( str )  
{  
        return parseInt( str.replace(/[\D]+/g,'') );  
}  

var respostas = function(text, codigo, cliente){
	$.ajax({
		url: 'php/pesquisas/inserir_resposta.php', 
		dataType: 'json',
		data: {	"texto" : text, "pergunta":codigo, "cliente":cliente},
		type: 'POST',
		success: function(data) {
					if(data[0].codigo == 1){
						$('table.table_opcional tr#pergunta:eq(2)').html('<td>' + data[0].mensagem + '</td>');
						setTimeout(function(){$('table.table_opcional tr#pergunta').remove()},2000)
					}else{
						alert(data[0].mensagem );
					}
				 },
		error: function(xhr,er) {
					
				 }		
	});
}



var pergunta = function(text, codigo, cliente){
				
				$('table.table_opcional tr.tr_gerar_orcamento')
					.before(
						'<tr id="pergunta"><td colspan="5" style="color:\'red\'"></td></tr>'+
						'<tr id="pergunta"><td colspan="5" style="color:\'red\'">Responda: </td></tr>'+
						'<tr id="pergunta" style="border:1px solid red;"><td colspan="5" style="color:\'red\'">'+ text +'<input type="text"  name="pesquisa_orcamento_texto"><input name="pesquisa_orcamento_gravar" type="button" value="Gravar" class="k-button"> <td></tr>'
					);	
					
					
				$('input[name="pesquisa_orcamento_gravar"]').click(function(e){
					e.preventDefault();
					
					
					var resposta =  $('input[name="pesquisa_orcamento_texto"]').val();
					
					if(resposta == ''){
						alert('Responda a pergunta para continuar');
					}else{
						respostas(resposta,codigo,cliente);
					}
				});
				
	}



	

	//Ao Selecionar a voltagem verifica os kits =====================
		$('select[name="prod_voltagem"]').live("change",function(){
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/valor.php?search=',
				{ 
					grupo		: $('input[name="cGrupo"]').val(), 
					subgrupo	: $('input[name="cSubgrupo"]').val(),
					medidas		: $('select[name="prod_dim"]').val(),
					linhas		: $('select[name="prod_linhas"]').val(),
					acabamentos	: $('select[name="prod_acabamentos"]').val(),
					cor			: $('select[name="prod_cor"]').val(),
					posicao		: $('select[name="prod_posicao"]').val(),
					voltagem	: $('select[name="prod_voltagem"]').val()

				}, 
				function(data){
					$('#valor_inicial_orcamento').html('');
					$('#recebe_voltagem select').after('<div style="line-height:30px; text-align:center" id="valor_inicial_orcamento">Valor: '+data[0].VALOR+'</div>');
				}
			);
			
			
			
			$.getJSON(
				'modulos/riolax/pedido/orcamento/PHP/kits.php?search=',
				{ 
					grupo		: $('input[name="cGrupo"]').val(), 
					subgrupo	: $('input[name="cSubgrupo"]').val(),
					medidas		: $('select[name="prod_dim"]').val(),
					linhas		: $('select[name="prod_linhas"]').val(),
					acabamentos	: $('select[name="prod_acabamentos"]').val(),
					cor			: $('select[name="prod_cor"]').val(),
					posicao		: $('select[name="prod_posicao"]').val()

				}, 
						
				function(j){
							
					$('div#or_kits').html(function(){
						
						$('div#or_kits').find('div.kit_item').each(function(){
							$('div.kit_item').remove(this);
						});
						
						var	div  	= '<table width="99%" class="table_opcional" style="width: 100%;"><tr><td colspan="5" class="k-header"><h3>&nbsp;&nbsp;&nbsp;Opcionais</h3></td></tr>';	
						
						
						for (var i = 0; i < j.length; i++) {
							var option 	= '';	
							var preco = '';
							
							if(j[i].PRECO != ''){
								
								preco = j[i].PRECO;	
							
								preco = preco.split('|');
								
								
								
								
								for(var s = 0; s < preco.length-1; s++){
									
									var variaveis = preco[s].split('*');
									
									var valor = getMoney(variaveis[2]);
									
									option += '<input type="hidden" name="orc_tabela_preco_'+j[i].CODIGO+'" value="' +variaveis[0] + '">  R$ ' + variaveis[2];
									
									
								}
								
								
							}
							
							div += '<tr><td><input type="checkbox" name="'+j[i].CODIGO +'" id="'+ j[i].CODIGO +'"></td>';
							div += '<td><img src="img/produtos/' + j[i].CODIGO+ '.png"></td><td>Kit: ' + j[i].CODIGO + ' </td><td>Descricao: ' + j[i].DESCRICAO;
							div += '</td><td>'+option+'</td></tr>';
						}
						div += '<tr class="tr_gerar_orcamento"><td colspan="5"><input type="button" name="bt_continuar_item_orc" class="k-button" value="Gerar Orçamento"></td></tr></table>'	;
						return div;
					})
							
							$('#or_kits').css({display:'block'});
							
							
							$('input[name="bt_continuar_item_orc"]').click(function(e){
								e.preventDefault();
								
								
								var array = new Array();
								var check_array = $("div#or_kits").find("input:checkbox").size();
								$("div#or_kits").find("input:checkbox:checked").each(function(){
									
									var valor = $(this).attr("name") + '|' + $('input[name="orc_tabela_preco_'+ $(this).attr("name") +'"]').val();
									
									
									
									//alert(valor);
									array.push(valor);
									
								});
								
								$('input[name="orc_fechamento"]').val(array);
								
								

								//$('div#or_kits').html('<div class="bt_finalizar "><input type="input" class="k-button" value="Finalizar" name="Finalizar_ORC"></div>');
								
								//$('input[name="Finalizar_ORC"]').click(function(e){
									//e.preventDefault();
									
									//Variaveis
									var cliente 	= $('input[name="po_codigo_cliente"]').val();
									var categoria 	= $('input[name="cGrupo"]').val();
									var modelo 		= $('input[name="cSubgrupo"]').val();
									var medida 		= $('select[name="prod_dim"]').val();
									var linha 		= $('select[name="prod_linhas"]').val();
									var acabamento 	= $('select[name="prod_acabamentos"]').val();
									var cores 		= $('select[name="prod_cor"]').val();
									var posicao 	= $('select[name="prod_posicao"]').val();
									var voltagem	= $('select[name="prod_voltagem"]').val();
									var fechamento  = $('input[name="orc_fechamento"]').val();
									
									
									if(cliente == 0){
										alert('Clique em inicio e escolha um cliente!');
										$('#tabstrip_pedido_orcamento ul li:eq(0)').click();
										$('input[name="po_name"]').focus();
									}else{
										if(categoria == ''){
											alert('Escolha uma categoria');
										}else{
											if(modelo == ''){
												alert('Escolha o modelo');
											}else{
												if(medida == ''){
													alert('Escolha a medida antes de continuar!');
													}else{
													if(linha == ''){
														alert('Escolha a medida antes de continuar!');
													}else{
														if(acabamento == ''){
															alert('Escolha o acabamento para continuar!');
														}else{
															if(cores == ''){
																alert('Escolha as cores para  continuar!');
															}else{
																if(posicao == ''){
																	alert('Escolha a posicao antes de continuar!');
																}else{
																	if(voltagem == ''){
																		alert('Escolha a voltagem antes de continuar!');
																	}else{
																		
																		//Consulta pesquisa
																		$.ajax({
																			url: 'php/pesquisas/pesquisa.php', 
																			dataType: 'json',
																			data: {	"cliente" : cliente},
																			type: 'POST',
																			success: function(data) {
																						
																						switch(data[0].codigo){
																							
																							case 0:
																								alert(data[0].mensagem);	
																								break;
																						
																							case 1:
																								$('#tabstrip_pedido_orcamento ul li:eq(2)').click();
																				
																									$.ajax({
																										url: 'modulos/riolax/pedido/orcamento/PHP/finalizar.php', 
																										dataType: 'html',
																										data: {
																												"cliente" 		: cliente,
																												"categoria"		: categoria,
																												"modelo"		: modelo,
																												"medida"		: medida,
																												"linha"			: linha,
																												"acabamento"	: acabamento,
																												"cores"			: cores,
																												"posicao"		: posicao,
																												"voltagem"		: voltagem,
																												"fechamento"	: fechamento
																											  },
																						
																										type: 'POST',
																										success: function(data, textStatus) {
																													$('#po_aba_tres').html(data);
																													$("#modal_obs_orc").hide();
																												 },
																										error: function(xhr,er) {
																													$('#po_aba_tres').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
																												 }		
																									});
																								break;
																							
																							case 2:
																								
																								pergunta(data[0].mensagem, data[0].pergunta, cliente);
																								break;
																						
																						}
																						
																						
																						
																						
																						
																						
																					 },
																			error: function(xhr,er) {
																						
																					 }		
																		});
																		
																		
																		
																		
																		
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								//})
								
								
							})
							
							
							
							
						});		
							
					});			
			
			
			
		});
	// =============================================================
	
	
	
	
	// Botão voltar 2 =====================================================================
		$('input[name="bt_po_voltar_2"]').live("click",function(e){
			e.preventDefault();
			
			
			//Esconde tela primeiro passo
			$('div.terceiro_passo').css({display:'none'});
			
			//Mostra Segundo Passo
			$('div.segundo_passo').css({display:'inline-block'});
			
			var cGrupo = '';
			var nGrupo = '';
			
			var cSubgrupo = '';
			var nSubgriupo = '';
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/tela_segundo_passo.php',
				{ 
					"cGrupo" 	: cGrupo,
					"nGrupo"	: nGrupo,
					"cSubgrupo" : cSubgrupo,
					"nSubgrupo"	: nSubgriupo
				},
				function(data){
					$('div.terceiro_passo').html(data);
				}
			);		
		});
	// ====================================================================================

	// Botão voltar 1 =====================================================================
		$('input[name="bt_po_voltar_1"]').live("click",function(e){
			e.preventDefault();
			
			
			//Esconde tela primeiro passo
			$('div.segundo_passo').css({display:'none'});
			
			//Mostra Segundo Passo
			$('div.primeiro_passo').css({display:'inline-block'});
			
			var cGrupo = '';
			var nGrupo = '';
			
			var cSubgrupo = '';
			var nSubgriupo = '';
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/tela_produto.php',
				{ 
					"cGrupo" 	: cGrupo,
					"nGrupo"	: nGrupo,
					"cSubgrupo" : cSubgrupo,
					"nSubgrupo"	: nSubgriupo
				},
				function(data){
					$('div.primeiro_passo').html(data);
				}
			);		
		});
	// ====================================================================================
	
	
	
	//Oculta modal =====================================================================
		
		// =================================================================================
		
		// Evento Botão para mostrar modal de adicionar empresa=============================
		$('input[name="bt_obs_orcamento"]').live("click",function(){
			$("#modal_obs_orc").addClass('modal');
			
			$("#modal_obs_orc").show();
			
		});
		// =================================================================================
		
		
		// =================================================================================
	
		//Enquanto estiver no focus na observação apertar o esc tira  a modal
	
		$('textarea[name="obs_orc"]').focus(function(){
			
			$(this).live('keypress',function(e){
				
				var teclado = (e.keyCode?e.keyCode:e.which);
				
				
				if(teclado == 27){
					$("#modal_obs_orc").hide();
				}
			});
		});
		
		
		// CHECK BOX 
		$("#restricao_lista_acesso").find("input:checkbox").each(function(){
		});
		
		
	
		//Evento botão orc-bt_pesquisar_orcamento
		$('input[name="orc-bt_pesquisar_orcamento"]').live('click',function(e){
				$('a[name="pedido_orcamento_pesquisar"]').click();
				setTimeout(
					function(){
						$('input[name="orcamento_pesquisa_tela_retorno"]').val('pedido_orcamento|NUMERO:search_orc-numero,FRETE:search_orc-frete,NOME:search_orc-cliente,DESCONTO:search_orc-desconto,VALOR_ADICIONAL:search_orc-adicional,FRETE:search_orc-frete,DATA_CADASTRADA:search_orc-data');
					},
					2000
					);

		});
	
		
});	