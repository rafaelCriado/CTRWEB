// Página de Cadastro de Usuários

	//Função de erro	
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
	
	
	//EVENTO DO BOTÃO NOVO USUARIO BT CADASTRAR===================================================
	$('input[name="novo_usuario_bt_cadastrar"]').click(function(){
		var nome 		= $('input[name="novo_usuario_nome"]');
		var senha		= $('input[name="novo_usuario_senha"]');
		var cargo		= $('input[name="novo_usuario_cargo"]');
		var grupo		= $('select[name="novo_usuario_grupo"]');
		if(nome.val() == '' || nome.val() == null){
			erro(nome,'Escreva o Usuário');
		}else{
			if(senha.val() == '' || senha.val() == null){
				erro(descricao, 'Digite a Senha');
			}else{
				if(cargo.val() == '' || cargo.val() == null){
					cargo.val('');
				}
				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/controle_usuario/cadastrar/add_novo_usuario.php', 
					dataType: 'html',
					data: { nome_: nome.val(), senha_:senha.val(), cargo_:cargo.val(), grupo_:grupo.val()},
					type: 'POST',
					success: function(data, textStatus) {
								$('.resultado_novo_usuario').html('<p>' + data + '</p>');
								$('#retorno_novo_usuario').load('php/controle_usuario/cadastrar/lista_de_usuarios.php');
								
								//Atualização de telas.
								$('#controle_usuario_restricao').load('controle_usuario_restricao.php');
								
								limparTodos('form[name="novo_usuario"] input[type="text"]');
								limparTodos('form[name="novo_usuario"] input[type="password"]');
								nome.focus();
								setTimeout(function(){$('.resultado_novo_usuario').html('');},5000);
							 },
					error: function(xhr,er) {
								$('.resultado_novo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
							 }		
				});						
			}
		}
	});
	//===========================================================================================
	
	
	//EVENTO DO BOTÃO NOVA_MEDIDA_BT_LIMPAR======================================================
	$('input[name="novo_usuario_bt_limpar"]').click(function(){
		//Inicio
		limparTodos('form[name="novo_usuario"] input[type="text"]');
		limparTodos('form[name="novo_usuario"] input[type="password"]');
		//Fim
	});
	//===========================================================================================

	
	//EVENTO DO BOTÃO NOVO USUARIO BT EXCLUIR ====================================================
	$('a[name="novo_usuario_bt_excluir"]').click(function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/controle_usuario/cadastrar/excluir_usuario.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_novo_usuario').html('<p>' + data + '</p>');
							$('#retorno_novo_usuario').load('php/controle_usuario/cadastrar/lista_de_usuarios.php');
							
							//Atualização de telas.
							$('#controle_usuario_restricao').load('controle_usuario_restricao.php');

							
							setTimeout(function(){$('.resultado_novo_usuario').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_novo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================

	
	//EVENTO DO BOTÃO NOVO USUARIO BT ALTERAR ====================================================
	$('a[name="novo_usuario_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");

		$.get("php/controle_usuario/cadastrar/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_novo_usuario').html(data);
			}
		);
	});
	//===========================================================================================