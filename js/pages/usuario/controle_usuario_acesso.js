// Página de Cadastro de Tela de Acessos
	
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
	

	//EVENTO DO BOTÃO NOVA TELA BT CADASTRAR ====================================================
	$('input[name="nova_tela_bt_cadastrar"]').click(function(){
		var descricao 		= $('input[name="nova_tela_descricao"]');
		
		if(descricao.val() == '' || descricao.val() == null ){
			erro(descricao,'Escreva a Descrição');
			
		}else{
			
			//Caso todos os campos estiverem preenchidos faça
			$.ajax({
				url: 'php/controle_usuario/tela_acessos/add_nova_tela_acesso.php', 
				dataType: 'html',
				data: { descricao_: descricao.val()},
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_nova_tela').html('<p>' + data + '</p>');
							$('#retorno_nova_tela').load('php/controle_usuario/tela_acessos/lista_de_telas_de_acesso.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');
							
							limparTodos('form[name="nova_tela"] input[type="text"]');
							
							descricao.focus();
							setTimeout(function(){$('.resultado_nova_tela').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_nova_tela').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
						 
			});						
			
		}
		
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVA_TELA_BT_LIMPAR =======================================================
	$('input[name="nova_tela_bt_limpar"]').live("click", function(){
		//Inicio
		limparTodos('form[name="nova_tela"] input[type="text"]');
		//Fim
	});
	//===========================================================================================

	//EVENTO DO BOTÃO NOVA_TELA_BT_EXCLUIR ======================================================
	$('a[name="nova_tela_bt_excluir"]').click(function(e){

		e.preventDefault();
		var id_ = $(this).attr("title");
		
		decisao = confirm("Deseja realmente excluir?");
		
		if(decisao){
			$.ajax({
				url: 'php/controle_usuario/tela_acessos/excluir_tela_acesso.php', 
				dataType: 'html',
				data: { id:id_ },
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_nova_tela').html('<p>' + data + '</p>');
							$('#retorno_nova_tela').load('php/controle_usuario/tela_acessos/lista_de_telas_de_acesso.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_nova_tela').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_nova_tela').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================

	//EVENTO DO BOTÃO NOVA_TELA_BT_ALTERAR ======================================================
	$('a[name="nova_tela_bt_alterar"]').click(function(e){
		e.preventDefault();
		var id_ = $(this).attr("id");
		
		var valor = $("#"+ id_).html();
		
		$("#"+ id_).html('<input type="text" name="texto_alteracao" value="'+valor+'" >');
		$("#"+ id_).append('<a href="" name="salvar_alteracao_usuario_acesso" title="Salvar"><img src="img/salvar.png"></a>');
		$('input[name="texto_alteracao"]').focus();
		//alert(valor);
		$('input[name="texto_alteracao"]').focusout(function(e){
			e.preventDefault();
			if(valor == $(this).val()){
				$("#"+ id_).html(valor);
			}
		});
		
		$('a[name="salvar_alteracao_usuario_acesso"]').click(function(e){
			var txt = $('input[name="texto_alteracao"]').val()
			e.preventDefault();
			$.ajax({
				url: 'php/controle_usuario/tela_acessos/alterar_tela_acesso.php', 
				dataType: 'html',
				data: { id:id_, texto: txt },
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_nova_tela').html('<p>' + data + '</p>');
							$('#retorno_nova_tela').load('php/controle_usuario/tela_acessos/lista_de_telas_de_acesso.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_nova_tela').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_nova_tela').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		});
	});
	//===========================================================================================