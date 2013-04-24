// Página de Cadastro de Tipos de Entidade
	
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
	
	//EVENTO DO BOTÃO NOVA CATEGORIA BT CADASTRAR ===============================================
	$('input[name="nova_categoria_entidade_bt_cadastrar"]').click(function(){
		
		var descricao		= $('input[name="nova_categoria_entidade_descricao"]');
		var classificacao	= $('select[name="nova_categoria_entidade_classificacao"]');
		
			if(descricao.val() == '' || descricao.val() == null){
				erro(descricao, 'Escolha o estado');
			}else{
				if(classificacao.val() == '' || classificacao.val() == null){
					erro(classificacao, 'Digite o codigo nacional');
				}else{
						
						//Caso todos os campos estiverem preenchidos faça
						$.ajax({
							url: 'php/entidade/tipo/add_novo_tipo_entidade.php', 
							dataType: 'html',
							data: { 
									descricao_:descricao.val(), 
									classificacao_:classificacao.val(), 
								},
							type: 'POST',
							success: function(data, textStatus) {
										$('.resultado_tipo_entidade').html('<p>' + data + '</p>');
										$('#retorno_novo_tipo_entidade').load('php/entidade/tipo/lista_de_tipo_entidades.php');
										
										//Atualização de telas.
										
										limparTodos('form[name="nova_categoria_entidade"] input[type="text"]');
										codigo.focus();
										setTimeout(function(){$('.resultado_tipo_entidade').html('');},5000);
									 },
							error: function(xhr,er) {
										$('.resultado_tipo_entidade').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
									 }		
									 
						});						
				}
			}
		
	});
	//===========================================================================================

	//EVENTO DO BOTÃO NOVA CATEGORIA ENTIDADE BT LIMPAR =========================================
	$('input[name="nova_categoria_entidade_bt_limpar"]').click( function(){
		//Inicio
		limparTodos('form[name="nova_categoria_entidade"] input[type="text"]');
		//Fim
	});
	//===========================================================================================

	//EVENTO DO BOTÃO NOVA_CIDADE_BT_EXCLUIR ====================================================
	$('a[name="novo_tipo_entidade_bt_excluir"]').live('click', function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/entidade/tipo/excluir_tipo_entidade.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_tipo_entidade').html('<p>' + data + '</p>');
							$('#retorno_novo_tipo_entidade').load('php/entidade/tipo/lista_de_tipo_entidades.php');
							
											
							
							setTimeout(function(){$('.resultado_tipo_entidade').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_tipo_entidade').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================

	//EVENTO DO BOTÃO NOVA_CIDADE_BT_ALTERAR ====================================================
	$('a[name="novo_tipo_entidade_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");

		$.get("php/entidade/tipo/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_nova_categoria_entidade').html(data);
			}
		);
	});
	//===========================================================================================