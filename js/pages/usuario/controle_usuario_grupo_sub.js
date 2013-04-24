// Página de Cadastro de Grupo de usuarios
	
	//Função de erro ============================================================================
	function erro(variavel, texto){
		variavel.attr('placeholder',texto);
		variavel.focus();
		variavel.css({background:'#FBB5BF', color:'red', fontWeight:'bold'});
		variavel.keypress(function(){ $(this).css({background:'#fff', color:'red', fontWeight:'normal'});});
	}
	// ==========================================================================================
	
	//Limpa todos os campos =====================================================================
	function limparTodos(seletor){
		$(seletor).each(function(){
			$(this).val('');
		});
	}
	// ==========================================================================================
	
	//EVENTO DO BOTÃO NOVO GRUPO USUARIO BT CADASTRAR ===========================================
	$('input[name="novo_grupo_usuario_bt_cadastrar"]').live("click", function(){
		var descricao	= $('input[name="novo_grupo_usuario_descricao"]');
		
		if(descricao.val() == '' || descricao.val() == null){
			erro(descricao, 'Digite a Descrição');
		}else{

				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/controle_usuario/grupo/add_novo_grupo_usuario.php', 
					dataType: 'html',
					data: { "descricao":descricao.val()},
					type: 'POST',
					success: function(data, textStatus) {
								$('.resultado_novo_grupo_usuario').html('<p>' + data + '</p>');
								$('#retorno_novo_grupo_usuario').load('php/controle_usuario/grupo/lista_de_grupo_usuarios.php');
								
								//Atualização de telas.
								//$('#cadastro_cidade').load('cadastro_cidade.php');
								
								limparTodos('form[name="novo_grupo_usuario"] input[type="text"]');
								descricao.focus();
								setTimeout(function(){$('.resultado_novo_grupo_usuario').html('');},5000);
							 },
					error: function(xhr,er) {
								$('.resultado_novo_grupo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
							 }		
							 
				});						
			
		}
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVO GRUPO USUARIO BT LIMPAR ==============================================
	$('input[name="novo_grupo_usuario_bt_limpar"]').live("click", function(){
		//Inicio
		limparTodos('form[name="novo_grupo_usuario"] input[type="text"]');
		//Fim
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVO GRUPO USUARIO BT EXCLUIR =============================================
	$('a[name="novo_grupo_usuario_bt_excluir"]').live("click", function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/controle_usuario/grupo/excluir_grupo_usuario.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_novo_grupo_usuario').html('<p>' + data + '</p>');
							$('#retorno_novo_grupo_usuario').load('php/controle_usuario/grupo/lista_de_grupo_usuarios.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_novo_grupo_usuario').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_novo_grupo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVO GRUPO USUARIO BT ALTERAR =============================================
	$('a[name="novo_usuario_grupo_bt_alterar"]').live("click",function(e){
		
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		$.get("php/controle_usuario/grupo/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_novo_grupo_usuario').html(data);
			}
		);
	});
	//===========================================================================================