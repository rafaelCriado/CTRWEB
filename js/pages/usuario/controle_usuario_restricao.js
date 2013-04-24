// Página de Cadastro de Usuários
	
	function erro(variavel, texto){
		variavel.attr('placeholder',texto);
		variavel.focus();
		variavel.css({background:'#FBB5BF', color:'red', fontWeight:'bold'});
		variavel.keypress(function(){ $(this).css({background:'#fff', color:'red', fontWeight:'normal'});});
	}
	
	//Limpa todos os campos
	function limparTodos(seletor){
		$(seletor).each(function(){
			$(this).val('');
		});
	}
	
	//Desabilita botão salvar ===================================================================
	$('input[name="restricao_bt_salvar"]').css({display:'none'});
	// ==========================================================================================
	
	//EVENTO AO SELECIONAR USUARIO 	=============================================================
	$('select[name="restricao_usuario"]').live("change", function(){
		var id = $(this).val();
		
		if(id != ''){
			/**/
			
			
			//Listas as empresas ja vinculadas
			$.post(
				'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php', 
				{ codigo_usuario: id },
				function(data)
				{
					$('#restricao_empresa_usuario').html('');
					$('#restricao_empresa_usuario').html(data);

				}
			);	
			
			//LIsta as permissões por usuário.
			$.post(
				'php/controle_usuario/restricao/lista_de_telas_de_acesso.php', 
				{ codigo_usuario: id },
				function(data)
				{
					$('#restricao_lista_acesso').html('');
					$('#restricao_lista_acesso').html(data);
	
					//Botão Salvar
					$('input[name="restricao_bt_salvar"]').css({display:'block'})
				}
			);	

		}
	})
	//===========================================================================================

	//EVENTO AO SELECIONAR GRUPO ================================================================
	$('select[name="restricao_usuario_grupo"]').live("change", function(){
		var id = $(this).val();

		if(id != ''){
			/**/
			
			
			//Listas as empresas ja vinculadas
			$.post(
				'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php', 
				{ 
					grupo			: id,
				},
				function(data)
				{
					$('#restricao_empresa_usuario').html('');
					$('#restricao_empresa_usuario').html(data);

				}
			);	
			
			//LIsta as permissões por usuário.
			$.post(
				'php/controle_usuario/restricao/lista_de_telas_de_acesso.php', 
				{ grupo				: id },
				function(data)
				{
					$('#restricao_lista_acesso').html('');
					$('#restricao_lista_acesso').html(data);
	
					//Botão Salvar
					$('input[name="restricao_bt_salvar"]').css({display:'block'})
				}
			);	

		}
	})
	//===========================================================================================
	
	//Botão Salvar ==============================================================================
	$('input[name="restricao_bt_salvar"]').live(
		"click",											
		function(){
			
			//Cria array com as informações dos checksbox
			var array = new Array();
			var check_array = $("#restricao_lista_acesso").find("input:checkbox").size();
			$("#restricao_lista_acesso").find("input:checkbox").each(function(){
				
				var valor = $(this).attr("name") + '_' + $(this).val();
				
				if($(this).is(':checked')==true){
					valor = valor + "_1";
				}
				
				//alert(valor);
				array.push(valor);
				
			});
			
			//Cria array com as empresas selecionadas.
			var empresa = new Array();
			var empresa_array = $("#restricao_empresa_usuario").find('a[name^="restricao_empresa_"]').size();
			
			/*$("#restricao_empresa_usuario").find('a[name="restricao_empresa_grupo_excluir"]').each(function(){
				
				var valor = $(this).attr("name") + '_';
				empresa.push(valor);
				
			})*/
						
			if($('select[name="escolha_tipo_restricao"]').val() == 1){
				//Por usuario	
				
				//Usuario
				var usuario = $('select[name="restricao_usuario"]').val();
				
				if(empresa_array == 0){
					alert('Deve haver uma empresa selecionada!');
				}else{
					if(check_array == 0){
						alert('Não há restrição selecionada!');
					}
					
					$.ajax({
						url: 'php/controle_usuario/restricao/atualizar_restricoes.php', 
						dataType: 'html',
						data: { 
								"array":array,
								"usuario":usuario, 
								"empresa":empresa 
							  },
						type: 'POST',
						beforeSend: function(){
							$('#restricao_lista_acesso').html('<h2>Salvando...</h2>');
						},
						success: function(data, textStatus) {
									$('#restricao_lista_acesso').html('');
									var id = $('select[name="restricao_usuario"]').val();
									$('.resultado_controle_usuario_restricao').html(data);
									$.post(
										'php/controle_usuario/restricao/lista_de_telas_de_acesso.php', 
										{ codigo_usuario: id },
										function(data)
										{
											$('#restricao_lista_acesso').html('');
											$('#restricao_lista_acesso').html(data);
							
										}
									);		//$('#retorno_novo_usuario').load('php/controle_usuario/cadastrar/lista_de_usuarios.php');
									
									//Atualização de telas.
									//$('#cadastro_cidade').load('cadastro_cidade.php');
									
									limparTodos('form[name="novo_usuario"] input[type="text"]');
									limparTodos('form[name="novo_usuario"] input[type="password"]');
									codigo.focus();
									setTimeout(function(){$('.resultado_novo_usuario').html('');},5000);
								 },
						error: function(xhr,er) {
									$('.resultado_novo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
								 }		
								 
					});	
					
				}
			}
			
			if($('select[name="escolha_tipo_restricao"]').val() == 2){
				//Por grupo	
				
				//Usuario
				var grupo = $('select[name="restricao_usuario_grupo"]').val();
				
				if(empresa_array == 0){
					alert('Deve haver uma empresa selecionada!');
				}else{
					if(check_array == 0){
						alert('Não há restrição selecionada!');
					}
					
					$.ajax({
						url: 'php/controle_usuario/restricao/atualizar_restricoes.php', 
						dataType: 'html',
						data: { 
								"array":array,
								"grupo":grupo, 
								"empresa":empresa 
							  },
						type: 'POST',
						beforeSend: function(){
							$('#restricao_lista_acesso').html('<h2>Salvando...</h2>');
						},
						success: function(data, textStatus) {
									$('#restricao_lista_acesso').html('');
									var id = $('select[name="restricao_usuario_grupo"]').val();
									$('.resultado_controle_usuario_restricao').html(data);
								$.post(
										'php/controle_usuario/restricao/lista_de_telas_de_acesso.php', 
										{ grupo: id },
										function(data)
										{
											$('#restricao_lista_acesso').html('');
											$('#restricao_lista_acesso').html(data);
							
										}
									);		
									//$('#retorno_novo_usuario').load('php/controle_usuario/cadastrar/lista_de_usuarios.php');
									
									//Atualização de telas.
									//$('#cadastro_cidade').load('cadastro_cidade.php');
									
									limparTodos('form[name="novo_usuario"] input[type="text"]');
									limparTodos('form[name="novo_usuario"] input[type="password"]');
									codigo.focus();
									setTimeout(function(){$('.resultado_novo_usuario').html('');},5000);
								 },
						error: function(xhr,er) {
									$('.resultado_novo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
								 }		
					});	
				}
			}
		}
	);
	// ==========================================================================================
	
	//CHECKBOX ==================================================================================
	$("#restricao_empresa_usuario").toggle(
		function(){
			$("input:checkbox").attr("checked",true);
		},
		function(){
			$("input:checkbox").attr("checked",false);
		}
	)
	//===========================================================================================
	
	//Vincular empresa ==========================================================================
	$('input[name="bt_vincular_usuario_empresa"]').live("click",function(e){
		e.preventDefault();
		
		var empresas = new Array();
		$("#empresas_cadastradas_select option:selected").each(function() {
			empresas.push($(this).val());
		});
		
		if($('select[name="escolha_tipo_restricao"]').val() == 1){
			var user = $('select[name="restricao_usuario"]').val();
			if(user != '' || user != 0){
			$.get("php/controle_usuario/restricao/vincular_usuario_empresa.php", 
				{"usuario":user, "empresas": empresas},
				function(data){
					$('#result_vincular_empresa').html(data);
					
					$.get(
						'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php',
						{ "codigo_usuario": user},
						function(retorno){
							$('#restricao_empresa_usuario').html(retorno);
							setTimeout($('#result_vincular_empresa').html(''),5000);
						}
					);
					
					
					
				}
			);
			}else{
				alert('Escolha um tipo de restrição e um usuário');
			}
			
		}

		if($('select[name="escolha_tipo_restricao"]').val() == 2){
		
			var grupo = $('select[name="restricao_usuario_grupo"]').val();
			if(grupo != 0 || grupo != ''){
			$.get("php/controle_usuario/restricao/vincular_usuario_empresa.php", 
				{	"grupo":grupo, "empresas": empresas},
				function(data){
					
					$('#result_vincular_empresa').html(data);

					$.get(
						'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php',
						{ "grupo": grupo},
						function(retorno){
							$('#restricao_empresa_usuario').html(retorno);
							setTimeout($('#result_vincular_empresa').html(''),5000);
						}
					);
					
				}
			);
			}else{
				alert('Escolha um tipo de restrição e um grupo');
			}
		}
		
		
		
	});
	// ==========================================================================================

	//Evento marcar todos os checkboxes==========================================================
	$('input[name="all_permissao"]').live("change",function(){
		if(this.checked){
			$("input[name^='permissao_']").each(function(){
					$(this).attr("checked", "checked");
			});
		}else{
			$("input[name^='permissao_']").each(function(){
				$(this).removeAttr("checked");
			});
		}
	})	
	// ==========================================================================================

		//Oculta modal =====================================================================
		$("#modal_restricao").hide();
		// =================================================================================
		
		// Evento Botão para mostrar modal de adicionar empresa=============================
		$('a[name="controle_usuario_restricao_adicionar_empresa"]').live("click",function(){
			$("#modal_restricao").addClass('modal');
			
			$("#modal_restricao").show();
			
		});
		// =================================================================================
		
		// Evento Botão para fechar modal de adicionar empresa =============================
		$('a[name="fechar_modal_restricao"]').live("click",function(e){
			e.preventDefault();
			$("#modal_restricao").hide();
		});
		// =================================================================================
		
		
		//Evento para escolher tipo de restrição ===========================================
		$('select[name="escolha_tipo_restricao"]').live("change",function(){
			$.get(
				'php/controle_usuario/restricao/tipo_restricao.php',
				{ opcao : $(this).val()},
				function(data){
					$('#select_controle_usuario').html(data);
				}
			);
		});
		// =================================================================================
		
		//Evento excluir empresa vinculada por usuario======================================
		$('a[name="restricao_empresa_excluir"]').live("click",function(e){
			e.preventDefault();
			
			//Variaveis
			var vinculo_usuario = $('select[name="restricao_usuario"]').val();
			var vinculo_empresa = $(this).attr('id');
			
			//Requisição
			$.post(
				'php/controle_usuario/restricao/excluir_vincular_usuario_empresa.php',
				{ usuario: vinculo_usuario, empresa : vinculo_empresa},
				function(data){
					//Recebe informações da requisição
					alert(data);
					
					//Atualiza lista de empresas liberadas.
					$.post(
						'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php',
						{ codigo_usuario: vinculo_usuario },
						function(data){
							//Atualiza lista de empresas liberadas.
							$('#restricao_empresa_usuario').html(data);
						}
					);
				}
			);
		});
		//==================================================================================

		//Evento excluir empresa vinculada por grupo======================================
		$('a[name="restricao_empresa_grupo_excluir"]').live("click",function(e){
			e.preventDefault();
			
			//Variaveis
			var vinculo_grupo = $('select[name="restricao_usuario_grupo"]').val();
			var vinculo_empresa = $(this).attr('id');
			
			//Requisição
			$.post(
				'php/controle_usuario/restricao/excluir_vincular_usuario_empresa.php',
				{ 
					grupo: vinculo_grupo, 
					empresa : vinculo_empresa
				},
				function(data){
					//Recebe informações da requisição
					alert(data);
					
					//Atualiza lista de empresas liberadas.
					$.post(
						'php/controle_usuario/restricao/lista_de_empresas_por_usuario.php',
						{ grupo: vinculo_grupo },
						function(data){
							//Atualiza lista de empresas liberadas.
							$('#restricao_empresa_usuario').html(data);
						}
					);
				}
			);
		});
		//==================================================================================