// Página de Cadastro de Cidades
	
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
	
	//Função para verificar se é numero
	function verificaNumero(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	}
	
	$('input[name="nova_cidade_codigo_nacional"]').live("keypress",verificaNumero);
	$('input[name="nova_cidade_codigo_ibge"]').live("keypress",verificaNumero);

	
	
	
	//EVENTO DO BOTÃO NOVA_CIDADE_BT_CADASTRAR===================================================
	$('input[name="nova_cidade_bt_cadastrar"]').click(function(){
		
		var nome 			= $('input[name="nova_cidade_cidade"]');
		var estado			= $('select[name="nova_cidade_estado"]');
		var codigo_nacional	= $('input[name="nova_cidade_codigo_nacional"]');
		var codigo_ibge		= $('input[name="nova_cidade_codigo_ibge"]');
		
		if(nome.val() == '' || nome.val() == null){
			erro(nome,'Escreva a cidade');
		}else{
			if(estado.val() == '' || estado.val() == null){
				erro(estado, 'Escolha o estado');
			}else{
				if(codigo_nacional.val() == '' || codigo_nacional.val() == null){
					erro(codigo_nacional, 'Digite o codigo nacional');
				}else{
					if(codigo_ibge.val() == '' || codigo_ibge.val() == null){
						erro(codigo_ibge, 'Digite o codigo do IBGE');
					}else{
						
						//Caso todos os campos estiverem preenchidos faça
						$.ajax({
							url: 'php/cadastro/cidade/add_nova_cidade.php', 
							dataType: 'html',
							data: { nome_: nome.val(), 
									estado_:estado.val(), 
									codigo_nacional_:codigo_nacional.val(), 
									codigo_ibge_:codigo_ibge.val()
								},
							type: 'POST',
							success: function(data, textStatus) {
										$('.resultado_nova_cidade').html('<p>' + data + '</p>');
										$('#retorno_nova_cidade').load('php/cadastro/cidade/lista_de_cidades.php');
										
										//Atualização de telas.
										$('#cadastro_empresa').load('cadastro_empresa.php');
										
										limparTodos('form[name="nova_cidade"] input[type="text"]');
										nome.focus();
										setTimeout(function(){$('.resultado_nova_cidade').html('');},5000);
									 },
							error: function(xhr,er) {
										$('.resultado_nova_cidade').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
									 }		
									 
						});						
					}
				}
			}
		}
	});
	//===========================================================================================
	

	
	
	//EVENTO DO BOTÃO NOVA_CIDADE_BT_LIMPAR======================================================
	$('input[name="nova_cidade_bt_limpar"]').click(function(){
		//Inicio
		limparTodos('form[name="nova_cidade"] input[type="text"]');
		//Fim
	});
	//===========================================================================================



	
	
	//EVENTO DO BOTÃO NOVA_CIDADE_BT_EXCLUIR ====================================================
	$('a[name="nova_cidade_bt_excluir"]').click(function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/cadastro/cidade/excluir_cidade.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_nova_cidade').html('<p>' + data + '</p>');
							$('#retorno_nova_cidade').load('php/cadastro/cidade/lista_de_cidades.php');
							
							//Atualização de telas.
							$('#cadastro_empresa').load('cadastro_empresa.php');
							
							setTimeout(function(){$('.resultado_nova_cidade').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_nova_cidade').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
	
	
	//EVENTO DO BOTÃO NOVA_CIDADE_BT_ALTERAR ====================================================
	$('a[name="nova_cidade_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		
		$.get("php/cadastro/cidade/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_nova_cidade').html(data);
			}
		);
	});
	//===========================================================================================
