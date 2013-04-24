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


// ================== GRUPO GRUPO GRUPO ===============================================================

// BOTÃO CADASTRAR GRUPO ======================================
$('input[name="bt_produto_grupo_salvar"]').live("click",function(e){
	e.preventDefault();
	
	//Variaveis
	var empresa = $('select[name="empresa_produto_grupo"]');
	var grupo	= $('input[name="produto_grupo_descricao"]');
	
	//Validação de Variaveis
	if(empresa == ''){
		erro(empresa,'Escolha uma empresa');
	}else{
		if(grupo == ''){
			erro(grupo,'Escreva o nome do grupo');
		}else{
			//Dados preenchidos faça
			$.ajax({
				url: 'php/cadastro/produto_grupo_sub/add_novo_grupo.php', 
				dataType: 'html',
				data: { 
						"empresa"	: 		empresa.val(), 
						"grupo"		:		grupo.val(), 
					},
				type: 'POST',
		  beforeSend: function(){
							$('.retorno_produto_grupo').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
						},
				success: function(data, textStatus) {
							$('.retorno_produto_grupo').html('<p>' + data + '</p>');
							$('#div_produto_lista_grupos').load('php/cadastro/produto_grupo_sub/lista_de_grupos.php');
							
							$('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php');
							
							limparTodos('form[name="form_produto_grupo"] input[type="text"]');
							grupo.focus();
							setTimeout(function(){$('.retorno_produto_grupo').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.retorno_produto_grupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
						 
			});						
		}
	}
});
// ============================================================

//EVENTO DO BOTÃO NOVO GRUPO B ALTERAR ====================================================
$('a[name="novo_produto_grupo_bt_alterar"]').live("click",function(e){
	e.preventDefault();
	
	var codigo = $(this).attr("id");
	$.get("php/cadastro/produto_grupo_sub/tela_alteracao.php", 
		{id: codigo},
		function(data){
			$('#formulario_produto_grupo').html(data);

		}
	);
});
//===========================================================================================

//EVENTO DO BOTÃO NOVO GRUPO EXCLUIR====================================================
$('a[name="novo_produto_grupo_bt_excluir"]').live("click", function(e){
	e.preventDefault();
	var id_ = $(this).attr("title");
	decisao = confirm("Deseja realmente excluir?");
	if (decisao){
		$.ajax({
			url: 'php/cadastro/produto_grupo_sub/excluir_grupo.php', 
			dataType: 'html',
			data: { id:id_},

			type: 'POST',
	  beforeSend: function(){
						$('.retorno_produto_grupo').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
					},
			success: function(data, textStatus) {
						$('.retorno_produto_grupo').html('<p>' + data + '</p>');
						$('#div_produto_lista_grupos').load('php/cadastro/produto_grupo_sub/lista_de_grupos.php');
						
						//Atualização de telas.
						//$('#cadastro_empresa').load('cadastro_empresa.php');
						
						setTimeout(function(){$('.retorno_produto_grupo').html('');},5000);
						$('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php');
					 },
			error: function(xhr,er) {
						$('.retorno_produto_grupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
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
$('input[name="bt_produto_subgrupo_salvar"]').click(function(e){
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