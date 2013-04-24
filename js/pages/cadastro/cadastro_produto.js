
//Tela de cadastro de produtos =======================================================================

function formatReal( int )  
{  
        var tmp = int+'';  
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
        if( tmp.length > 6 )  
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");  
  
        return tmp;  
}  

function getMoney( str )  
{  
        return parseInt( str.replace(/[\D]+/g,'') );  
}  

//Efeito de Abas =====================================================================================
$("#tabstrip_produto").kendoTabStrip({
	animation:	{
		open: {
			
			effects: "fadeIn"
		}
	}

});
// ===================================================================================================

//Efeito seleciona empresa ===========================================================================
$('select[name="empresa_produto"]').live("change",function(){
	var empresa = $(this).val();
	
	$.get(
		"php/cadastro/produto/busca_empresa.php",
		{codigo_empresa:empresa},
		function(data){
			$('.empresa_produto_nome').html(data);
		}
	);
});
// ===================================================================================================

//Efeito de atualizar a janela =======================================================================
$('a[name="bt_produto_atualizar"]').live("click",function(){
	$('#cadastro_produto').load('cadastro_produto.php');
});
// ===================================================================================================

// FUNÇÃO ERRO =======================================================================================
function erro(variavel, texto){
	variavel.attr('placeholder',texto);
	variavel.focus();
	variavel.css({background:'#FBB5BF', color:'red', fontWeight:'bold'});
	variavel.keypress(function(){ $(this).css({background:'#fff', color:'red', fontWeight:'normal'});});
}
// ===================================================================================================

//FUNÇÃO LIMPA CAMPOS ================================================================================
function limparTodos(seletor){
	$(seletor).each(function(){
		$(this).val('');
	});
}
// ===================================================================================================

//FUNÇÃO VERIFICA SE É NUMERO ========================================================================
function verificaNumero(e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
// ===================================================================================================

//CAMPOS QUE SÓ ACEITAM NUMEROS ======================================================================
$('input[name="produto_ncm"]').keypress(verificaNumero);
$('input[name="produto_largura"]').keypress(verificaNumero);
$('input[name="produto_altura"]').keypress(verificaNumero);
$('input[name="produto_comprimento"]').keypress(verificaNumero);
$('input[name="produto_peso_liquido"]').keypress(verificaNumero);
$('input[name="produto_peso_bruto"]').keypress(verificaNumero);
// ===================================================================================================

// EFEITO PARA PREENCHER SUBGRUPO DE ACORDO COM O GRUPO ==============================================
$('select[name="produto_seleciona_grupo"]').change(function(){
	var grupo = $(this).val();
	
	if(grupo != '' || grupo != 0){
		
		//Caso o campo grupo tenha valor faça
		$('select[name="produto_seleciona_subgrupo"]').hide();
		//$('.carregando').show();
		$.getJSON(
			'php/requisitions/subgrupos.ajax.php?search=',
			{entidade_grupo: $(this).val(), ajax: 'true'}, 
			function(j){
				var options = '';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].codigo_subgrupo + '">' + j[i].subgrupo + '</option>';
				}	
				$('select[name="produto_seleciona_subgrupo"]').html(options).show();
				//$('.carregando').hide();
			}
		);
	} else {
		$('select[name="produto_seleciona_subgrupo"]').html('<option value="">-- Escolha um estado --</option>');
	}
});
// ===================================================================================================

//MASCARAS ===========================================================================================
	//Produto NCM ==========================================
	$('input[name="produto_ncm"]')
		.focus(function(){
			$(this).keydown(function(e){
				
				var t = $(this).val().length;
				
				if(t == 4 && e.which != 8){
					$(this).val($(this).val() + '.');
				}else if( t == 7 && e.which != 8){
					$(this).val($(this).val() + '.');
				}
				
			});
	});
	// ======================================================
// ===================================================================================================

//EFEITO BOTÃO CADASTRAR =============================================================================
$('a[name="bt_produto_cadastrar"]').click(function(e){
	e.preventDefault();
	
	//Variaveis
	var descricao   	= '';
	var codigo_barra 	= '';
	var ncm 			= '';
	var unidade_medida 	= '';
	var grupo		 	= '';
	var subgrupo 		= '';
	var largura 		= '';
	var altura 			= '';
	var comprimento 	= '';
	var peso_liquido 	= '';
	var peso_bruto 		= '';
	var estoque 		= '';
	var cor 			= '';

	var descricao   	= $('input[name="produto_descricao"]');
	var codigo_barra 	= $('input[name="produto_codigo_barra"]');
	var ncm 			= $('input[name="produto_ncm"]');
	var unidade_medida 	= $('select[name="produto_unidade_medida"]');
	var grupo		 	= $('select[name="produto_seleciona_grupo"]');
	var subgrupo 		= $('select[name="produto_seleciona_subgrupo"]');
	var largura 		= $('input[name="produto_largura"]');
	var altura 			= $('input[name="produto_altura"]');
	var comprimento 	= $('input[name="produto_comprimento"]');
	var peso_liquido 	= $('input[name="produto_peso_liquido"]');
	var peso_bruto 		= $('input[name="produto_peso_bruto"]');
	var cor 			= $('input[name="produto_cor"]');
	var estoque 		= $('select[name="produto_estoque"]');
	var tipo= '';
	$('input[name="produto_tipo"]').each(function() {
		
        if($(this).is(':checked')){
			tipo = $(this).val();
		}
    });
	



	if($('input[name="codigo_produto"]').val() == 0){
	
		if(descricao.val() == ''){
			erro(descricao);
		}else{
			if(estoque.val() == ''){
				estoque.focus();
				estoque.css({border:'1px solid red', color:'red'});
			}else{
				$.ajax({
							url: 'php/cadastro/produto/insert_novo_produto.php', 
							dataType: 'json',
							data: {
									"descricao"		: descricao.val(),
									"codigo_barra"	: codigo_barra.val(),
									"ncm"			: ncm.val(),
									"unidade_medida": unidade_medida.val(),
									"grupo"			: grupo.val(),
									"subgrupo"		: subgrupo.val(),
									"largura"		: largura.val(),
									"altura"		: altura.val(),
									"comprimento"	: comprimento.val(),
									"peso_liquido"	: peso_liquido.val(),
									"peso_bruto"	: peso_bruto.val(),
									"estoque"		: estoque.val(),
									"tipo"			: tipo,
									"cor"			: cor.val()
								   },
							type: 'POST',
					  beforeSend: function(){
										$('.retorno_cadastro_produto').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
									},
							success: function(data) {
										var msg 	= data[0].texto;
										var codRet	= data[0].codigo;
										
										$('.retorno_cadastro_produto').html(msg);
										setTimeout(function(){$('.retorno_cadastro_produto').html('');},3000);
										
										//Caso tenha sido inserido com sucesso
										if(codRet != 0){
											$('input[name="codigo_produto1"]').val(codRet);
											$('input[name="codigo_produto"]').val(codRet);
											$.post(
												'cadastro_produto.php',
												{ "produto_codigo": codRet},
												function(data){
													$('#cadastro_produto').html(data);
												}
											)														
										}
										
									 },
							error: function(xhr){
								alert('err');
							}
						});						
			}
		}
		
	}else{
		var confirma = confirm('Deseja realizar essas alterações?');
		if(confirma){
			//EFETUAR ALTERAÇÕES
			
			//Variaveis
			var codigo		   	= '';
			var descricao   	= '';
			var codigo_barra 	= '';
			var ncm 			= '';
			var unidade_medida 	= '';
			var grupo		 	= '';
			var subgrupo 		= '';
			var largura 		= '';
			var altura 			= '';
			var comprimento 	= '';
			var peso_liquido 	= '';
			var peso_bruto 		= '';
			var estoque 		= '';
			var tipo	 		= '';
			var cor	 			= '';

			
			var codigo   		= $('input[name="codigo_produto"]');
			var descricao   	= $('input[name="produto_descricao"]');
			var codigo_barra 	= $('input[name="produto_codigo_barra"]');
			var ncm 			= $('input[name="produto_ncm"]');
			var unidade_medida 	= $('select[name="produto_unidade_medida"]');
			var grupo		 	= $('select[name="produto_seleciona_grupo"]');
			var subgrupo 		= $('select[name="produto_seleciona_subgrupo"]');
			var largura 		= $('input[name="produto_largura"]');
			var altura 			= $('input[name="produto_altura"]');
			var comprimento 	= $('input[name="produto_comprimento"]');
			var peso_liquido 	= $('input[name="produto_peso_liquido"]');
			var peso_bruto 		= $('input[name="produto_peso_bruto"]');
			var cor 			= $('input[name="produto_cor"]');
			var estoque 		= $('select[name="produto_estoque"]');
			var tipo	 		= $('input[name="produto_tipo"]');
		
			if(descricao.val() == ''){
				erro(descricao);
			}else{
				if(estoque.val() == ''){
					estoque.focus();
					estoque.css({border:'1px solid red', color:'red'});
				}else{
					$.ajax({
								url: 'php/cadastro/produto/update_produto.php', 
								dataType: 'json',
								data: {
										"codigo"		: codigo.val(),
										"descricao"		: descricao.val(),
										"codigo_barra"	: codigo_barra.val(),
										"ncm"			: ncm.val(),
										"unidade_medida": unidade_medida.val(),
										"grupo"			: grupo.val(),
										"subgrupo"		: subgrupo.val(),
										"largura"		: largura.val(),
										"altura"		: altura.val(),
										"comprimento"	: comprimento.val(),
										"peso_liquido"	: peso_liquido.val(),
										"peso_bruto"	: peso_bruto.val(),
										"estoque"		: estoque.val(),
										"tipo"			: tipo.val(),
										"cor"			: cor.val()
									   },
								type: 'POST',
						  beforeSend: function(){
											$('.retorno_cadastro_produto').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
										},
								success: function(data) {
											var msg 	= data[0].texto;
											var codRet	= data[0].codigo;
											
											$('.retorno_cadastro_produto').html(msg);
											setTimeout(function(){$('.retorno_cadastro_produto').html('');},3000);
											
											//Caso tenha sido inserido com sucesso
											if(codRet != 0){
												$('input[name="codigo_produto1"]').val(codRet);
												$('input[name="codigo_produto"]').val(codRet);
												$.post(
													'cadastro_produto.php',
													{ "produto_codigo": codRet},
													function(data){
														$('#cadastro_produto').html(data);
													}
												)														
											}
											
										 },
								error: function(xhr){
									alert('err');
								}
							});						
				}
			}
		}
	}
});
// ===================================================================================================

// EFEITO BOTÃO EDITAR PRODUTO =======================================================================
$('a[name="prod_bt_editar"]').click(function(e) {
	e.preventDefault();
	
	//Recebe condição de pagamento
	var produto_codigo = $(this).attr('id');
	$.post(
		'cadastro_produto.php',
		{ "produto_codigo": produto_codigo, "alteracao": 1},
		function(data){
			$('#cadastro_produto').html(data);
		}
	)

});
// ===================================================================================================

// BOTÃO EXCLUIR =====================================================================================
$('a[name="prod_bt_excluir"]').click(function(e){
	e.preventDefault();
	
	//variavel
	var codigo 		= $(this).attr('id');
	var confirma	= confirm('Deseja excluir realmente?');
	
	//VERIFICA SE PRODUTO QUE VAI SER DELETADO ESTA ABERTO --------------//
	var produto_selecionado = $('input[name="codigo_produto"]').val();
	
	if(produto_selecionado == codigo){
		//CASO FOR LIMPA TODOS OS CAMPOS
		limparTodos('form[name="add_produto"] input');
		
	}
	//-------------------------------------------------------------------//
	
	
	if(confirm){
		$.ajax({
			url: 'php/cadastro/produto/delete_produto.php', 
			dataType: 'json',
			data: {
						"codigo"	: codigo
					},

			type: 'POST',
			success: function(data) {
						//alert(data);
						
						var msg 	= data[0].mensagem;
						var codRet = data[0].codigo_retorno;
						
						if(codRet == 1){
							$('tr#'+ codigo).hide();
						}
						
						alert(msg);
						
					},
			error: function() {
						alert('Erro de requisição');	
					 }		
		});	
	}
});
//====================================================================================================

//EFEITO DE PESQUISA =================================================================================
$('input[name="produto_texto_pesquisa"]').keyup(function(){
	
	//Quando escreve uma letra faça
	var texto = $(this).val();
	var tipo_pesquisa = $('select[name="produto_tipo_pesquisa"]').val();
	
	$.ajax({
		url: 'php/cadastro/produto/pesquisa_produtos.php',
		dataType: 'html',
		data: {
					"texto"			: texto,
					"tipo_pesquisa"	: tipo_pesquisa,
				},

		type: 'POST',
		success: function(data) {
					$('#produto_pesquisa_aba_dois_table').html(data);
				},
		error: function() {
					alert('Erro de requisição');	
				 }		
	});	
	
});
// ===================================================================================================

//Botão novo só existe se tiver produto na tela ======================================================
if($('input[name="codigo_produto"]').val() == 0){
	$('a[name="bt_produto_novo"]').hide()
}
// ===================================================================================================

// BOTÃO NOVO ========================================================================================
$('a[name="bt_produto_novo"]').click(function(){
	$.post(
		'cadastro_produto.php',
		{ },
		function(data){
			$('#cadastro_produto').html(data);
		}
	)
});
// ===================================================================================================




// ****************************************** = ABA PREÇO = **********************************************



/* EVENTO BOTÃO ALTERAR VALOR -------------------------------------------------------------------------- */
$('a[name="tab_prec_inc_bt_alterar"]').click(function(e){
	e.preventDefault();
	
	//Variaveis
	var codigo_tabela  = $(this).attr('id');
	var codigo_produto = $('input[name="codigo_produto"]').val();
	var valor = $('td#' + codigo_tabela).text();
	
	//Altera ou inclui
	$('td[id="'+ codigo_tabela + '"]').html('<input id="'+codigo_tabela+'" type="text" name="produto_preco_alteracao" value="'+valor+'" >');
	$('td[id="'+ codigo_tabela + '"]').append('<a href="#" id="'+codigo_tabela+'" name="alteracao_preco_produto" title="Salvar">Salvar</a>');
	$('input[name="produto_preco_alteracao"]').focus();
	//alert(valor);


	$('input[name="produto_preco_alteracao"]').maskMoney({decimal:",",thousands:"."});
	
	//Botão salvar preço de produto
	$('a[name="alteracao_preco_produto"]').click(function(e){
			
			var codigo_table = $(this).attr('id');
			var valor_minimo = $('input[name="produto_preco_minimo"]').val();
			var valor_produto = $('input[name="produto_preco_alteracao"]').val();
			
			
			valor_minimo = getMoney(valor_minimo );
			valor_produto = getMoney(valor_produto );
			

			if(valor_minimo > valor_produto){
				alert('O valor de venda deve ser maior ou igual o valor minimo de venda');
				$('input[name="produto_preco_alteracao"]').val(formatReal(valor_minimo));
			}else{
				$.getJSON(
					'php/cadastro/produto_tabela_preco/atualizar_preco.php?search=',
					{ 
						"tabela" :	codigo_table, 
						"produto": 	codigo_produto, 
						"valor"  :	valor_produto 
					},
					function(data){
						alert(data.msg);
						
						$('td[id="'+ codigo_table + '"]').html( formatReal(valor_produto) );
					}
				);
			}
		
	});
});
/* ----------------------------------------------------------------------------------------------------- */

/* EVENTO BOTÃO ALTERAR APLICAR INDICE PADRAO DE TABELA ------------------------------------------------ */
$('a[name="tab_prec_inc_bt_aplicar"]').click(function(e){
	e.preventDefault();
	
	//Variaveis
	var codigo_tabela  = $(this).attr('id');
	var codigo_produto = $('input[name="codigo_produto"]').val();
	
	$.getJSON(
		'php/cadastro/produto_tabela_preco/aplicar_indice_venda.php',
		{ 
			"codigo_tabela" :	codigo_tabela, 
			"codigo_produto": 	codigo_produto, 

		},
		function(data){
			alert(data.msg);
			if(data.retorno == 2){
				$('tr td#'+codigo_tabela).html(data.valor);
			}
		}
	);
	
});
/* ----------------------------------------------------------------------------------------------------- */




// *******************************************************************************************************