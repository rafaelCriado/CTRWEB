// Página de Cadastro de Empresas
	
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
	
	//Somente numero
	function verificaNumero(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	}
	
	$('input[name="nova_empresa_cnpj"]').live("keypress",verificaNumero);
	$('input[name="nova_empresa_ie"]').live("keypress",verificaNumero);
	$('input[name="nova_empresa_cep"]').live("keypress",verificaNumero);

	
	//Valor default de indice minimo de venda
	$('input[name="nova_empresa_indice_minimo"]').val('1.75');

	

	
	//mascara cnpj
	$('input[name="nova_empresa_cnpj"]').live("keypress",function(){
		var tamanho = $(this).val().length;
		
		if(tamanho == 1 && e.which != 8){
			$(this).val($(this).val()+'.');
		}
		if(tamanho == 6 && e.which != 8){
			$(this).val($(this).val()+'.');
		}
		if(tamanho == 6 && e.which != 10){
			$(this).val($(this).val()+'/');
		}
		if(tamanho == 6 && e.which != 15){
			$(this).val($(this).val()+'-');
		}

		
	});
	
	
	//EVENTO DO BOTÃO NOVA_EMPRESA_BT_CADASTRAR===================================================
	$('input[name="nova_empresa_bt_cadastrar"]').click(function(){
		
		var razao			= $('input[name="nova_empresa_razao"]');
		var fantasia		= $('input[name="nova_empresa_fantasia"]');
		var sigla			= $('input[name="nova_empresa_sigla"]');
		var cnpj 			= $('input[name="nova_empresa_cnpj"]');
		var ie				= $('input[name="nova_empresa_ie"]');
		var endereco		= $('input[name="nova_empresa_endereco"]');
		var bairro			= $('input[name="nova_empresa_bairro"]');
		var complemento		= $('input[name="nova_empresa_complemento"]');
		var numero			= $('input[name="nova_empresa_numero"]');
		var cep				= $('input[name="nova_empresa_cep"]');
		var telefone		= $('input[name="nova_empresa_telefone"]');
		var cidade			= $('select[name="nova_empresa_cidade"]');
		var email			= $('input[name="nova_empresa_email"]');
		var site			= $('input[name="nova_empresa_site"]');
		var indice_venda	= $('input[name="nova_empresa_indice_minimo"]');
		
		if(razao.val() == '' || razao.val() == null){
			erro(razao,'Escreva a razão social');
		}else{
			if(cnpj.val() == '' || cnpj.val() == null){
				erro(cnpj, 'Escreva o CNPJ');
			}else{
				
				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/cadastro/empresa/add_nova_empresa.php', 
					dataType: 'html',
					data: { 
							razao_: 		razao.val(), 
							fantasia_:		fantasia.val(), 
							sigla_:			sigla.val(),
							cnpj_:			cnpj.val(), 
							ie_:			ie.val(), 
							endereco_:		endereco.val(), 
							bairro_:		bairro.val(), 
							complemento_:	complemento.val(), 
							numero_:		numero.val(), 
							cep_:			cep.val(), 
							telefone_:		telefone.val(), 
							cidade_:		cidade.val(), 
							email_:			email.val(), 
							site_:			site.val(),
							indice_venda_:	indice_venda.val()
						},
					type: 'POST',
					beforeSend: function(){
						
						$('.resultado_atualiza_empresa').html('<img href="img/ajax-loader.gif">');
					},
					success: function(data, textStatus) {
								$('.resultado_atualiza_empresa').html('<p>' + data + '</p>');
								$('#retorno_nova_empresa').load('php/cadastro/empresa/lista_de_empresas.php');
								
								limparTodos('form[name="nova_empresa"] input[type="text"]');
								razao.focus();
								setTimeout(function(){$('.resultado_atualiza_empresa').html('');},5000);
							 },
					error: function(xhr,er) {
								$('.resultado_atualiza_empresa').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
							 }		
							 
				});						
			}
		}
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVA_EMPRESA_BT_LIMPAR======================================================
	$('input[name="nova_empresa_bt_limpar"]').click(function(){
		//Inicio
		limparTodos('form[name="nova_empresa"] input[type="text"]');
		//Fim
	});
	//===========================================================================================
	
	//EVENTO DO BOTÃO NOVA_EMPRESA_BT_EXCLUIR ====================================================
	$('a[name="nova_empresa_bt_excluir"]').click(function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/cadastro/empresa/excluir_empresa.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							
							$('.resultado_atualiza_empresa').html('<p>' + data + '</p>');

							$('#retorno_nova_empresa').load('php/cadastro/empresa/lista_de_empresas.php');
							
							setTimeout(function(){$('.resultado_atualiza_empresa').html('');},5000);
							$(this).focus();
							

						 },
				error: function(xhr,er) {
							$('.resultado_atualiza_empresa').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
	//alterar
	$('a[name="nova_empresa_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		
		$.get("php/cadastro/empresa/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_nova_empresa').html(data);
			}
		);
	});
	
	//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
	$('input[name="nova_empresa_bt_salvar"]').click(function(){
		
		var codigo			= $('input[name="nova_empresa_codigo"]');
		var razao			= $('input[name="nova_empresa_razao"]');
		var fantasia		= $('input[name="nova_empresa_fantasia"]');
		var sigla			= $('input[name="nova_empresa_sigla"]');
		var cnpj 			= $('input[name="nova_empresa_cnpj"]');
		var ie				= $('input[name="nova_empresa_ie"]');
		var endereco		= $('input[name="nova_empresa_endereco"]');
		var bairro			= $('input[name="nova_empresa_bairro"]');
		var complemento		= $('input[name="nova_empresa_complemento"]');
		var numero			= $('input[name="nova_empresa_numero"]');
		var cep				= $('input[name="nova_empresa_cep"]');
		var telefone		= $('input[name="nova_empresa_telefone"]');
		var cidade			= $('select[name="nova_empresa_cidade"]');
		var email			= $('input[name="nova_empresa_email"]');
		var site			= $('input[name="nova_empresa_site"]');
		var indice_venda	= $('input[name="nova_empresa_indice_minimo"]');
		
		if(razao.val() == '' || razao.val() == null){
			erro(razao,'Escreva a razão social');
		}else{
			if(cnpj.val() == '' || cnpj.val() == null){
				erro(cnpj, 'Escreva o CNPJ');
			}else{
				
				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/cadastro/empresa/atualizar_empresa.php', 
					dataType: 'html',
					data: { 
							id:				codigo.val(),
							razao_: 		razao.val(), 
							fantasia_:		fantasia.val(), 
							sigla_:			sigla.val(),
							cnpj_:			cnpj.val(), 
							ie_:			ie.val(), 
							endereco_:		endereco.val(), 
							bairro_:		bairro.val(), 
							complemento_:	complemento.val(), 
							numero_:		numero.val(), 
							cep_:			cep.val(), 
							telefone_:		telefone.val(), 
							cidade_:		cidade.val(), 
							email_:			email.val(), 
							site_:			site.val(),
							indice_venda_:	indice_venda.val()
						},
					type: 'POST',
					success: function(data, textStatus) {
								$('.resultado_nova_empresa').html('<p>' + data + '</p>');
								$('#retorno_nova_empresa').load('php/cadastro/empresa/lista_de_empresas.php');
								
								limparTodos('form[name="nova_empresa"] input[type="text"]');
								razao_.focus();
								setTimeout(function(){$('.resultado_nova_empresa').html('');},5000);
							 },
					error: function(xhr,er) {
								$('.resultado_nova_empresa').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
							 }		
							 
				});						
			}
		}
	});
	//===========================================================================================
	
	
	
	//Popula as cidades de acordo com o estado
	$('select[name="nova_empresa_estado"]').live("change", function(){
		if( $(this).val() ) {
			$('select[name="nova_empresa_cidade"]').hide();
			//$('.carregando').show();
			$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: $(this).val(), ajax: 'true'}, function(j){
				var options = '';	
				for (var i = 0; i < j.length; i++) {
					options += '<option title="'+j[i].titulo +'" value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
				}	
				$('select[name="nova_empresa_cidade"]').html(options).show();
				//$('.carregando').hide();
			});
		} else {
			$('select[name="nova_empresa_cidade"]').html('<option value="">Escolha um estado</option>');
		}
	});
	
	
	
	