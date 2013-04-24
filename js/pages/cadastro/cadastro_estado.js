// Página de Cadastro de Estados
	
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
	
	
	
	
	
	//EVENTO DO BOTÃO NOVO_ESTADO_BT_CADASTRAR===================================================
	$('input[name="novo_estado_bt_cadastrar"]').click(function(){
		var nome 		= $('input[name="novo_estado_nome"]');
		var abreviatura	= $('input[name="novo_estado_abreviatura"]');
		var codigo_pais	= $('input[name="novo_estado_pais"]');
		
		if(nome.val() == '' || nome.val() == null){
			erro(nome,'Escreva a descrição');
		}else{
			if(abreviatura.val() == '' || abreviatura.val() == null){
				erro(abreviatura, 'Digite a Abreviatura');
			}else{
				if(codigo_pais.val() == '' || codigo_pais.val() == null){
					erro(codigo_pais, 'Digite o codigo do páis');
				}else{
					
					//Caso todos os campos estiverem preenchidos faça
					$.ajax({
						url: 'php/cadastro/estado/add_novo_estado.php', 
						dataType: 'html',
						data: { nome_: nome.val(), abreviatura_:abreviatura.val(), codigo_pais_:codigo_pais.val()},
						type: 'POST',
						success: function(data, textStatus) {
									$('.resultado_novo_estado').html('<p>' + data + '</p>');
									$('#retorno_novo_estado').load('php/cadastro/estado/lista_de_estados.php');
									
									//Atualização de telas.
									$('#cadastro_cidade').load('cadastro_cidade.php');
									
									limparTodos('form[name="novo_estado"] input[type="text"]');
									nome.focus();
									setTimeout(function(){$('.resultado_novo_estado').html('');},5000);
								 },
						error: function(xhr,er) {
									$('.resultado_novo_estado').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
								 }		
								 
					});						
				}
			}
		}
	});
	//===========================================================================================
	

	
	
	//EVENTO DO BOTÃO NOVO_ESTADO_BT_LIMPAR======================================================
	$('input[name="novo_estado_bt_limpar"]').live("click", function(){
		//Inicio
		limparTodos('form[name="novo_estado"] input[type="text"]');
		//Fim
	});
	//===========================================================================================



	
	
	//EVENTO DO BOTÃO NOVO_ESTADO_BT_EXCLUIR ====================================================
	$('a[name="novo_estado_bt_excluir"]').click(function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/cadastro/estado/excluir_estado.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_novo_estado').html('<p>' + data + '</p>');
							$('#retorno_novo_estado').load('php/cadastro/estado/lista_de_estados.php');
							
							//Atualização de telas.
							$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_novo_estado').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_novo_estado').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
	
	//EVENTO DO BOTÃO NOVA_ESTADO_BT_ALTERAR ====================================================
	$('a[name="novo_estado_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		
		$.get("php/cadastro/estado/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_novo_estado').html(data);
			}
		);
	});
	//===========================================================================================
	