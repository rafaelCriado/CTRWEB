//Efeito de Abas ==============================================
$("#tabstrip_tabela_preco").kendoTabStrip({
	animation:	{
		open: {
			
			effects: "fadeIn"
		}
	}

});
// ============================================================

//Tela de cadastro de produtos ================================

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


// ================== TABELAS DE PREÇO (1º ABA) ===============================================================

// BOTÃO CADASTRAR TABELA DE PREÇO ==========================================================
$('input[name="tabela_preco_nova_bt_gravar"]').live("click",function(e){
	e.preventDefault();
	
	//Variaveis
	var tabela_preco	= $('input[name="tabela_preco_nome"]');
	
	//Validação de Variaveis
	if(tabela_preco == ''){
		erro(tabela_preco,'Digite a tabela de preço');
	}else{
					//Dados preenchidos faça
		$.ajax({
			url: 'php/cadastro/produto_tabela_preco/add_nova_tabela.php', 
			dataType: 'html',
			data: { 
					"tabela_preco"	: 		tabela_preco.val(), 
				},
			type: 'POST',
	  beforeSend: function(){
						$('.retorno_tabela_preco_nova').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
					},
		success: function(data, textStatus) {
					$('.retorno_tabela_preco_nova').html('<p>' + data + '</p>');
					$('#tabela_preco_lista').load('php/cadastro/produto_tabela_preco/lista_de_tabelas_de_preco.php');
					
					//$('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php');
					
					limparTodos('form[name="form_tabela_preco_nova"] input[type="text"]');
					tabela_preco.focus();
					setTimeout(function(){$('.retorno_tabela_preco_nova').html('');},5000);
				 },
		error: function(xhr,er) {
					$('.retorno_tabela_preco_nova').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
				 }		
				 
		});						
	}

});
// ==========================================================================================


//EVENTO DO BOTÃO NOVA TABELA PREÇO APLICAR =================================================


$('a[name="new_tab_preco_bt_aplicar"]').live("click",function(e){
	e.preventDefault();
	
	var codigo = $(this).attr("id");
	
	$.getJSON(
		"php/cadastro/produto_tabela_preco/aplicar_indice_venda.php", 
		{
			codigo_tabela: codigo
		},
		
		function(data){
			
			$('span.retorno_tabela_preco_nova').html(data.msg);
			setTimeout(function(){$('span.retorno_tabela_preco_nova').html('');},5000);

		}
	);
});
//===========================================================================================



//EVENTO DO BOTÃO NOVA TABELA PREÇO ALTERAR =================================================
$('a[name="new_tab_preco_bt_alterar"]').live("click",function(e){
	e.preventDefault();
	
	var codigo = $(this).attr("id");
	$.get("php/cadastro/produto_tabela_preco/tela_alteracao.php", 
		{id: codigo},
		function(data){
			$('#tabela_preco_form_nova').html(data);

		}
	);
});
//===========================================================================================

//EVENTO DO BOTÃO NOVO GRUPO EXCLUIR=========================================================
$('a[name="new_tab_preco_bt_excluir"]').live("click", function(e){
	e.preventDefault();
	var id_ = $(this).attr("title");
	decisao = confirm("Deseja realmente excluir?");
	if (decisao){
		$.ajax({
			url: 'php/cadastro/produto_tabela_preco/excluir_tabela.php', 
			dataType: 'html',
			data: { id:id_},

			type: 'POST',
	  beforeSend: function(){
						$('.retorno_tabela_preco_nova').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
					},
			success: function(data, textStatus) {
						$('.retorno_tabela_preco_nova').html('<p>' + data + '</p>');
						$('#tabela_preco_lista').load('php/cadastro/produto_tabela_preco/lista_de_tabelas_de_preco.php');
						
						//Atualização de telas.
						//$('#cadastro_empresa').load('cadastro_empresa.php');
						
						setTimeout(function(){$('.retorno_tabela_preco_nova').html('');},5000);
						$('#cadastro_produto_tabela_preco').load('cadastro_produto_tabela_preco.php');
					 },
			error: function(xhr,er) {
						$('.retorno_tabela_preco_nova').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
		});
	}	
	
});
//===========================================================================================

// ======================FIM GRUPO FIM GRUPO ==========================================================


// ================== SUBGRUPO SUBGRUPO SUBGRUPO ======================================================

// EVENTO QUANDO ESCOLHE GRUPO (CHANGE)================================================================
$('select[name="produto_subgrupo_grupo"]').live("change",function(){
	
	//Variaveis
	var grupo = $(this).val();
	
	if(grupo != 0 || grupo != ''){
		//Caso não esteja vazio o grupo faça
		
		$.get(
			'php/cadastro/produto_grupo_sub/lista_de_subgrupos.php',
			{ "grupo": grupo},
			function(data){
				$('#div_produto_lista_sub').html(data);
			}
		);
		
	}
	
});
// ====================================================================================================

// BOTÃO CADASTRAR SUBGRUPO ===========================================================================
$('input[name="bt_produto_subgrupo_salvar"]').live("click",function(e){
	e.preventDefault();
	
	//Variaveis
	var grupo		= $('select[name="produto_subgrupo_grupo"]');
	var subgrupo	= $('input[name="produto_subgrupo_descricao"]');
	
	//Validação
	if(subgrupo == ''){
		erro(subgrupo,'Escreva o nome do subgrupo');
	}else{
		//Dados preenchidos faça
		$.ajax({
			url: 'php/cadastro/produto_grupo_sub/add_novo_subgrupo.php', 
			dataType: 'html',
			data: { 
					"grupo"		:		grupo.val(), 
					"subgrupo"	:		subgrupo.val()
				},
	  beforeSend: function(){
					$('.retorno_produto_grupo').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
				},
			type: 'POST',
			beforeSend: function(){
				
				$('.retorno_produto_subgrupo').html('<img href="img/ajax-loader.gif">');
			},
			success: function(data, textStatus) {
						$('.retorno_produto_subgrupo').html('<p>' + data + '</p>');
						
						$.get(
							'php/cadastro/produto_grupo_sub/lista_de_subgrupos.php',
							{"grupo"		:		grupo.val()},
							function(data){
								$('#div_produto_lista_sub').html(data);
							}
						);
						
						limparTodos('form[name="form_produto_subgrupo"] input[type="text"]');
						grupo.focus();
						setTimeout(function(){$('.retorno_produto_subgrupo').html('');},5000);
					 },
			error: function(xhr,er) {
						$('.retorno_produto_subgrupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
		});						
	}
});
// ====================================================================================================

//EVENTO DO BOTÃO NOVO SUBGRUPO B ALTERAR =============================================================
$('a[name="novo_produto_subgrupo_bt_alterar"]').live("click",function(e){
	e.preventDefault();
	
	var codigo = $(this).attr("id");
	$.get("php/cadastro/produto_grupo_sub/tela_alteracao_sub.php", 
		{id: codigo},
		function(data){
			$('#formulario_produto_subgrupo').html(data);

		}
	);
});
//=====================================================================================================

//EVENTO DO BOTÃO NOVO SUBGRUPO EXCLUIR================================================================
$('a[name="novo_produto_subgrupo_bt_excluir"]').live("click", function(e){
	e.preventDefault();
	var id_ = $(this).attr("title");
	decisao = confirm("Deseja realmente excluir?");
	if (decisao){
		$.ajax({
			url: 'php/cadastro/produto_grupo_sub/excluir_subgrupo.php', 
			dataType: 'html',
			data: { id:id_},

			type: 'POST',
			success: function(data, textStatus) {
						$('.retorno_produto_subgrupo').html('<p>' + data + '</p>');
						
						$.get(
							'php/cadastro/produto_grupo_sub/lista_de_subgrupos.php',
							{
								"grupo": $('select[name="produto_subgrupo_grupo"]').val()
							},
							function(data){
								$('#div_produto_lista_sub').html(data);
							}
						);
						
						
						//Atualização de telas.
						//$('#cadastro_empresa').load('cadastro_empresa.php');
						
						setTimeout(function(){$('.retorno_produto_subgrupo').html('');},5000);
					 },
			error: function(xhr,er) {
						$('.retorno_produto_subgrupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
					 }		
		});
	}	
	
});
//=====================================================================================================


// ======================FIM SUBGRUPO FIM SUBGRUPO =========================================================