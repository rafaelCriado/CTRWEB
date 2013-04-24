// Página de Cadastro de Unidade de Medidas
	
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
	
	
	
	
	
	//EVENTO DO BOTÃO NOVA_MEDIDA_BT_CADASTRAR===================================================
	$('input[name="nova_medida_bt_cadastrar"]').live("click", function(){
		var codigo 		= $('input[name="nova_medida_codigo"]');
		var descricao	= $('input[name="nova_medida_descricao"]');
		
		if(codigo.val() == '' || codigo.val() == null){
			erro(codigo,'Escreva a medida');
		}else{
			if(descricao.val() == '' || descricao.val() == null){
				erro(descricao, 'Digite a Descrição');
			}else{
				
					
					//Caso todos os campos estiverem preenchidos faça
					$.ajax({
						url: 'php/cadastro/medida/add_nova_medida.php', 
						dataType: 'html',
						data: { codigo_: codigo.val(), descricao_:descricao.val()},
						type: 'POST',
		  				beforeSend: function(){
							$('.resultado_nova_medida').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
						},
						success: function(data, textStatus) {
									$('.resultado_nova_medida').html('<p>' + data + '</p>');
									$('#retorno_nova_medida').load('php/cadastro/medida/lista_de_medidas.php');
									
									//Atualização de telas.
									//$('#cadastro_cidade').load('cadastro_cidade.php');
									
									limparTodos('form[name="nova_medida"] input[type="text"]');
									codigo.focus();
									setTimeout(function(){$('.resultado_nova_medida').html('');},5000);
								 },
						error: function(xhr,er) {
									$('.resultado_nova_medida').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
								 }		
								 
					});						
				
			}
		}
	});
	//===========================================================================================
	

	
	
	//EVENTO DO BOTÃO NOVA_MEDIDA_BT_LIMPAR======================================================
	$('input[name="nova_medida_bt_limpar"]').live("click", function(){
		//Inicio
		limparTodos('form[name="nova_medida"] input[type="text"]');
		//Fim
	});
	//===========================================================================================



	
	
	//EVENTO DO BOTÃO NOVA_MEDIDA_BT_EXCLUIR ====================================================
	$('a[name="nova_medida_bt_excluir"]').live("click", function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/cadastro/medida/excluir_medida.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
		  		beforeSend: function(){
							$('.resultado_nova_medida').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
						},
				success: function(data, textStatus) {
							$('.resultado_nova_medida').html('<p>' + data + '</p>');
							$('#retorno_nova_medida').load('php/cadastro/medida/lista_de_medidas.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_nova_medida').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_nova_medida').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
		//EVENTO DO BOTÃO NOVA_MEDIDA_BT_ALTERAR ====================================================
	//alterar
	$('a[name="nova_medida_bt_alterar"]').live("click",function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		
		$.get("php/cadastro/medida/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_nova_medida').html(data);
			}
		);
	});
	//===========================================================================================