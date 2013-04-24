//altera value tipo_pesquisa_entidade_selecionada
function altera_tipo_pesquisa_entidade_selecionada(seletor){
	seletor.live("click",function(e){
		e.preventDefault();
		$('input[name="tipo_pesquisa_entidade_selecionada"]').val(seletor.val());
		$('input[name^="tipo_pesquisa_entidade_"]').removeClass('botao_ativado');
		seletor.addClass('botao_ativado');
	})
}
// ===============================================

// EFEITO DE CLICAR EM BOTÕES ==================================================================
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_nome"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_fantasia"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_endereco"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_cidade"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_codigo"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_telefone"]'));
altera_tipo_pesquisa_entidade_selecionada($('input[name="tipo_pesquisa_entidade_cpf"]'));
// =============================================================================================


//Efeito de pesquisa dinamica ==================================================================
$('input[name="entidade_texto_pesquisa"]').live("keyup",function(){
	
	//Variaveis
	var texto_pesquisa = $(this).val();
	var tipo_pesquisa = $('input[name="tipo_pesquisa_entidade_selecionada"]').val();

	//Requisição
	$.ajax({
		url: 'php/entidade/pesquisa/pesquisa_entidade.php', 
		dataType: 'html',
		data: {
					"texto"			: texto_pesquisa,
					"tipo_pesquisa"	: tipo_pesquisa,
				},

		type: 'POST',
		success: function(data) {
					//Preenche tabela
					$('#entidade_pesquisa_tabela').html(data);
				},
		error: function() {
					//Erro
					alert('Erro de requisição');	
				 }		
	});
	
	
})

// ==============================================================================================


//EFEITO DO duplo clique na linha da pesquisa====================================================
$('.tr_table_pesquisa_entidade').live('dblclick',function(e){

	e.preventDefault();
	//Variaveis
	var entidade = $(this).attr('id');
	var tela_retorno = $('input[name="tipo_pesquisa_tela_retorno"]').val();

	//CASO POSSUA UMA TELA DE RETORNO FAÇA
	if(tela_retorno != 0){
		
		var info = tela_retorno.split('|');
		var tela_requisicao = info[0];
		
		var variaveis = info[1].split(',');
		var num_variaveis = variaveis.length;
		
		var campo_pedido = [];
		var campo_preencher = [];
		
		for(var x=0; x<num_variaveis; x++){
			var valores = variaveis[x].split(':');
			
			campo_pedido[x] = valores[0];
			campo_preencher[x] = valores[1];
		}
		
		$.ajax({
			url: 'php/requisitions/entidade.ajax.php', 
			dataType: 'json',
			data: { "entidade": entidade},
			type: 'POST',
			success: function(data) {
						
						// ============================= FECHA TELA ==========================================
						$('#cadastro_entidade_pesquisa_pessoa').parent().closest('div').css({display:'none'});
						// ===================================================================================
						
						for(var y=0; y<num_variaveis; y++){
							
							var valor = eval('data.'+campo_pedido[y]);
							$('input[name="' + campo_preencher[y] + '"]').val(valor)
							
						}
						$('input[name="tipo_pesquisa_tela_retorno"]').val('0');
					 },
					 
			error: function(xhr,er) {
						$('#entidade').html(xhr+er);
							
					 }
		});
		
	}else{
		//Aciona o evento de abrir a janela de entidade
		$('a[name="cadastro_entidade_pessoa"]').click();
		
		setTimeout($.ajax({
			url: 'php/requisitions/entidade.ajax.php', 
			dataType: 'json',
			data: { "entidade": entidade},
			type: 'POST',
			success: function(data) {
						
						//aba principal
						$('input[name="entidade_nome"]').val(data.NOME);
						$('input[name="entidade_codigo_pessoa"]').val(data.CODIGO);
						$('input[name="entidade_codigo_pessoa_usado"]').val(data.CODIGO);
						$('input[name="entidade_codigo_pessoa"]').attr('disabled');
						$('input[name="entidade_fantasia"]').val(data.APELIDO);
						$('input[name="entidade_fone_comercial"]').val(data.FONE_COMERCIAL);
						$('input[name="entidade_fone_celular"]').val(data.FONE_CELULAR);
						$('input[name="entidade_fone_residencial"]').val(data.FONE_RESIDENCIAL);
						$('input[name="entidade_endereco"]').val(data.ENDERECO);
						$('input[name="entidade_numero"]').val(data.NUMERO);
						$('input[name="entidade_bairro"]').val(data.BAIRRO);
						$('input[name="entidade_cep"]').val(data.CEP);
						$('select[name="entidade_estado"]').val(data.CODIGO_ESTADO);
															
						$('select[name="entidade_cidade"]').hide();
						$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO , ajax: 'true'}, function(j){
							var options = '';	
							for (var i = 0; i < j.length; i++) {
								options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
							}	
							$('select[name="entidade_cidade"]').html(options).show();
						});
							
						setTimeout(function(){$('select[name="entidade_cidade"]').val(data.CODIGO_CIDADE)},1000);
						
						$('input[name="entidade_email"]').val(data.EMAIL);
						$('input[name="entidade_site"]').val(data.SITE);
						$('input[name="entidade_rg"]').val(data.RG);
						$('input[name="cnpj_cpf"]').val(data.CPF);
						$('input[name="entidade_nascimento"]').val(data.DATA_NASCIMENTO);
	
						//aba vinculos
						$('select[name="entidade_pessoa_gerente_atendimento"]').val(data.GERENTE);
						$('select[name="entidade_pessoa_praca_pagamento"]').val(data.PRACA);
						$('select[name="entidade_pessoa_cfop"]').val(data.CFOP);
						$('select[name="entidade_pessoa_representante"]').val(data.REPRESENTANTE);
						$('input[name="entidade_pessoa_comissao"]').val(data.COMISSAO);
						
						//aba enderecos
						$('input[name="entidade_endereco_cobranca"]').val(data.ENDERECO_COBRANCA);
						$('input[name="entidade_numero_cobranca"]').val(data.NUMERO_COBRANCA);
						$('input[name="entidade_bairro_cobranca"]').val(data.BAIRRO_COBRANCA);
						$('input[name="entidade_cep_cobranca"]').val(data.CEP_COBRANCA);
						$('select[name="entidade_estado_cobranca"]').val(data.CODIGO_ESTADO_COBRANCA);
	
						$('select[name="entidade_cidade_cobranca"]').hide();
						$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO_COBRANCA , ajax: 'true'}, function(j){
							var options = '';	
							for (var i = 0; i < j.length; i++) {
								options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
							}	
							$('select[name="entidade_cidade_cobranca"]').html(options).show();
						});
							
						setTimeout(function(){$('select[name="entidade_cidade_cobranca"]').val(data.CODIGO_CIDADE)},1000);
						
						//$('input[name="entidade_endereco_adicional"]').val(data.GERENTE);
						//$('input[name="entidade_numero_adicional"]').val(data.GERENTE);
						//$('input[name="entidade_bairro_adicional"]').val(data.GERENTE);
						//$('input[name="entidade_cep_adicional"]').val(data.GERENTE);
						//$('select[name="entidade_estado_adicional"]').val(data.GERENTE);
						//$('select[name="entidade_cidade_adicional"]').val(data.GERENTE);
						
						//aba crediario
						$('select[name="entidade_pessoa_bloqueado"]').val(data.BLOQUEIO);
						$('input[name="entidade_pessoa_limite"]').val(data.LIMITE_CREDITO);
						$('select[name="entidade_pessoa_prazo"]').val(data.COMPRA_A_PRAZO);
						$('input[name="entidade_local_trabalho"]').val(data.LOCAL_TRABALHO);
						$('input[name="entidade_profissao"]').val(data.PROFISSAO);
						$('input[name="entidade_tempo_trabalho"]').val(data.TEMPO_TRABALHO);
						$('input[name="entidade_salario"]').val(data.SALARIO);
						$('input[name="entidade_endereco_trabalho"]').val(data.ENDERECO_TRABALHO);
	
						$('input[name="entidade_conjuge"]').val(data.CONJUGE);
						$('input[name="entidade_cpf_conjuge"]').val(data.CPF_CONJUGE);
						$('input[name="entidade_rg_conjuge"]').val(data.RG_CONJUGE);
						$('input[name="entidade_local_trabalho_conjuge"]').val(data.LOCAL_TRABALHO_CONJUGE);
						$('input[name="entidade_tempo_local_trabalho_conjuge"]').val(data.TEMPO_TRABALHO_CONJUGE);
						$('input[name="entidade_salario_conjuge"]').val(data.SALARIO_CONJUGE);
						
						//aba complementos
						$('input[name="entidade_mae"]').val(data.MAE);
						$('input[name="entidade_pai"]').val(data.PAI);
						$('ul#menu_entidade_pessoa li').removeClass('k-state-disabled');
						$('form[name="add_entidade"] input[type="text"], form[name="add_entidade"] input[type="checkbox"], form[name="add_entidade"] select').attr('disabled',false);
	
						$('input[name="entidade_codigo_pessoa"]').attr('disabled', true);
	
					 },
					 
			error: function(xhr,er) {
						$('#entidade').html(xhr+er);
							
					 }		
		}),5000);
	}
})
// ==============================================================================================


//EFEITO AO CLICAR DUAS VEZES NA TR  ============================================================
$('#entidade_pesquisa_aba_dois_table tr').dblclick(function(e){
	
	e.preventDefault();
	
	//Variaveis
	var entidade = $(this).attr('id');
	
	//Aciona o evento de abrir a janela de entidade
	$('a[name="cadastro_entidade_pessoa"]').click();
	
	setTimeout($.ajax({
		url: 'php/requisitions/entidade.ajax.php', 
		dataType: 'json',
		data: { "entidade": entidade},
		type: 'POST',
		success: function(data) {
					
					//aba principal
					$('input[name="entidade_nome"]').val(data.NOME);
					$('input[name="entidade_codigo_pessoa"]').val(data.CODIGO);
					$('input[name="entidade_codigo_pessoa_usado"]').val(data.CODIGO);
					$('input[name="entidade_fantasia"]').val(data.APELIDO);
					$('input[name="entidade_fone_comercial"]').val(data.FONE_COMERCIAL);
					$('input[name="entidade_fone_celular"]').val(data.FONE_CELULAR);
					$('input[name="entidade_fone_residencial"]').val(data.FONE_RESIDENCIAL);
					$('input[name="entidade_endereco"]').val(data.ENDERECO);
					$('input[name="entidade_numero"]').val(data.NUMERO);
					$('input[name="entidade_bairro"]').val(data.BAIRRO);
					$('input[name="entidade_cep"]').val(data.CEP);
					$('select[name="entidade_estado"]').val(data.CODIGO_ESTADO);
														
					$('select[name="entidade_cidade"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade"]').val(data.CODIGO_CIDADE)},1000);
					
					$('input[name="entidade_email"]').val(data.EMAIL);
					$('input[name="entidade_site"]').val(data.SITE);
					$('input[name="entidade_rg"]').val(data.RG);
					$('input[name="cnpj_cpf"]').val(data.CPF);
					$('input[name="entidade_nascimento"]').val(data.DATA_NASCIMENTO);

					//aba vinculos
					$('select[name="entidade_pessoa_gerente_atendimento"]').val(data.GERENTE);
					$('select[name="entidade_pessoa_praca_pagamento"]').val(data.PRACA);
					$('select[name="entidade_pessoa_cfop"]').val(data.CFOP);
					$('select[name="entidade_pessoa_representante"]').val(data.REPRESENTANTE);
					$('input[name="entidade_pessoa_comissao"]').val(data.COMISSAO);
					
					//aba enderecos
					$('input[name="entidade_endereco_cobranca"]').val(data.ENDERECO_COBRANCA);
					$('input[name="entidade_numero_cobranca"]').val(data.NUMERO_COBRANCA);
					$('input[name="entidade_bairro_cobranca"]').val(data.BAIRRO_COBRANCA);
					$('input[name="entidade_cep_cobranca"]').val(data.CEP_COBRANCA);
					$('select[name="entidade_estado_cobranca"]').val(data.CODIGO_ESTADO_COBRANCA);

					$('select[name="entidade_cidade_cobranca"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO_COBRANCA , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade_cobranca"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade_cobranca"]').val(data.CODIGO_CIDADE)},1000);
					
					//$('input[name="entidade_endereco_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_numero_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_bairro_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_cep_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_estado_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_cidade_adicional"]').val(data.GERENTE);
					
					//aba crediario
					$('select[name="entidade_pessoa_bloqueado"]').val(data.BLOQUEIO);
					$('input[name="entidade_pessoa_limite"]').val(data.LIMITE_CREDITO);
					$('select[name="entidade_pessoa_prazo"]').val(data.COMPRA_A_PRAZO);
					$('input[name="entidade_local_trabalho"]').val(data.LOCAL_TRABALHO);
					$('input[name="entidade_profissao"]').val(data.PROFISSAO);
					$('input[name="entidade_tempo_trabalho"]').val(data.TEMPO_TRABALHO);
					$('input[name="entidade_salario"]').val(data.SALARIO);
					$('input[name="entidade_endereco_trabalho"]').val(data.ENDERECO_TRABALHO);

					$('input[name="entidade_conjuge"]').val(data.CONJUGE);
					$('input[name="entidade_cpf_conjuge"]').val(data.CPF_CONJUGE);
					$('input[name="entidade_rg_conjuge"]').val(data.RG_CONJUGE);
					$('input[name="entidade_local_trabalho_conjuge"]').val(data.LOCAL_TRABALHO_CONJUGE);
					$('input[name="entidade_tempo_local_trabalho_conjuge"]').val(data.TEMPO_TRABALHO_CONJUGE);
					$('input[name="entidade_salario_conjuge"]').val(data.SALARIO_CONJUGE);
					
					//aba complementos
					$('input[name="entidade_mae"]').val(data.MAE);
					$('input[name="entidade_pai"]').val(data.PAI);
					$('ul#menu_entidade_pessoa li').removeClass('k-state-disabled');
					$('form[name="add_entidade"] input[type="text"], form[name="add_entidade"] input[type="checkbox"], form[name="add_entidade"] select').attr('disabled',false);
					//$('input[name="entidade_codigo_pessoa_usado"]').attr('disabled',true);
				 },
		error: function(xhr,er) {
					$('#entidade').html(xhr+er);
						
				 }		
	}),2000);			
})
// ==============================================================================================
//EFEITO DO BOTÃO VISUALIZAR CLIENTE ============================================================
$('a[name="pes_ent_bt_vis"]').live('click',function(e){
	e.preventDefault();
	
	//Variaveis
	var entidade = $(this).attr('id');
	
	//Aciona o evento de abrir a janela de entidade
	$('a[name="cadastro_entidade_pessoa"]').click();
$.ajax({
		url: 'php/requisitions/entidade.ajax.php', 
		dataType: 'json',
		data: { "entidade": entidade},
		type: 'POST',
		success: function(data) {
					
					//aba principal
					$('input[name="entidade_nome"]').val(data.NOME);
					$('input[name="entidade_codigo_pessoa"]').val(data.CODIGO);
					$('input[name="entidade_codigo_pessoa_usado"]').val(data.CODIGO);
					$('input[name="entidade_fantasia"]').val(data.APELIDO);
					$('input[name="entidade_fone_comercial"]').val(data.FONE_COMERCIAL);
					$('input[name="entidade_fone_celular"]').val(data.FONE_CELULAR);
					$('input[name="entidade_fone_residencial"]').val(data.FONE_RESIDENCIAL);
					$('input[name="entidade_endereco"]').val(data.ENDERECO);
					$('input[name="entidade_numero"]').val(data.NUMERO);
					$('input[name="entidade_bairro"]').val(data.BAIRRO);
					$('input[name="entidade_cep"]').val(data.CEP);
					$('select[name="entidade_estado"]').val(data.CODIGO_ESTADO);
														
					$('select[name="entidade_cidade"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade"]').val(data.CODIGO_CIDADE)},1000);
					
					$('input[name="entidade_email"]').val(data.EMAIL);
					$('input[name="entidade_site"]').val(data.SITE);
					$('input[name="entidade_rg"]').val(data.RG);
					$('input[name="cnpj_cpf"]').val(data.CPF);
					$('input[name="entidade_nascimento"]').val(data.DATA_NASCIMENTO);

					//aba vinculos
					$('select[name="entidade_pessoa_gerente_atendimento"]').val(data.GERENTE);
					$('select[name="entidade_pessoa_praca_pagamento"]').val(data.PRACA);
					$('select[name="entidade_pessoa_cfop"]').val(data.CFOP);
					$('select[name="entidade_pessoa_representante"]').val(data.REPRESENTANTE);
					$('input[name="entidade_pessoa_comissao"]').val(data.COMISSAO);
					
					//aba enderecos
					$('input[name="entidade_endereco_cobranca"]').val(data.ENDERECO_COBRANCA);
					$('input[name="entidade_numero_cobranca"]').val(data.NUMERO_COBRANCA);
					$('input[name="entidade_bairro_cobranca"]').val(data.BAIRRO_COBRANCA);
					$('input[name="entidade_cep_cobranca"]').val(data.CEP_COBRANCA);
					$('select[name="entidade_estado_cobranca"]').val(data.CODIGO_ESTADO_COBRANCA);

					$('select[name="entidade_cidade_cobranca"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO_COBRANCA , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade_cobranca"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade_cobranca"]').val(data.CODIGO_CIDADE)},1000);
					
					//$('input[name="entidade_endereco_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_numero_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_bairro_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_cep_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_estado_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_cidade_adicional"]').val(data.GERENTE);
					
					//aba crediario
					$('select[name="entidade_pessoa_bloqueado"]').val(data.BLOQUEIO);
					$('input[name="entidade_pessoa_limite"]').val(data.LIMITE_CREDITO);
					$('select[name="entidade_pessoa_prazo"]').val(data.COMPRA_A_PRAZO);
					$('input[name="entidade_local_trabalho"]').val(data.LOCAL_TRABALHO);
					$('input[name="entidade_profissao"]').val(data.PROFISSAO);
					$('input[name="entidade_tempo_trabalho"]').val(data.TEMPO_TRABALHO);
					$('input[name="entidade_salario"]').val(data.SALARIO);
					$('input[name="entidade_endereco_trabalho"]').val(data.ENDERECO_TRABALHO);

					$('input[name="entidade_conjuge"]').val(data.CONJUGE);
					$('input[name="entidade_cpf_conjuge"]').val(data.CPF_CONJUGE);
					$('input[name="entidade_rg_conjuge"]').val(data.RG_CONJUGE);
					$('input[name="entidade_local_trabalho_conjuge"]').val(data.LOCAL_TRABALHO_CONJUGE);
					$('input[name="entidade_tempo_local_trabalho_conjuge"]').val(data.TEMPO_TRABALHO_CONJUGE);
					$('input[name="entidade_salario_conjuge"]').val(data.SALARIO_CONJUGE);
					
					//aba complementos
					$('input[name="entidade_mae"]').val(data.MAE);
					$('input[name="entidade_pai"]').val(data.PAI);
					$('ul#menu_entidade_pessoa li').removeClass('k-state-disabled');
					$('form[name="add_entidade"] input[type="text"], form[name="add_entidade"] input[type="checkbox"], form[name="add_entidade"] select').attr('disabled',false);
					
					$('input[name="entidade_codigo_pessoa"]').attr('disabled',true)
				 },
		error: function(xhr,er) {
					$('#entidade').html(xhr+er);
						
				 }		
	});			
})
// ==============================================================================================


//EFEITO AO CLICAR DUAS VEZES NA TR  ============================================================
$('#entidade_pesquisa_aba_dois_table tr').dblclick(function(e){
	e.preventDefault();
	
	//Variaveis
	var entidade = $(this).attr('id');
	
	//Aciona o evento de abrir a janela de entidade
	$('a[name="cadastro_entidade_pessoa"]').click();
$.ajax({
		url: 'php/requisitions/entidade.ajax.php', 
		dataType: 'json',
		data: { "entidade": entidade},
		type: 'POST',
		success: function(data) {
					
					//aba principal
					$('input[name="entidade_nome"]').val(data.NOME);
					$('input[name="entidade_codigo_pessoa"]').val(data.CODIGO);
					$('input[name="entidade_codigo_pessoa_usado"]').val(data.CODIGO);
					$('input[name="entidade_fantasia"]').val(data.APELIDO);
					$('input[name="entidade_fone_comercial"]').val(data.FONE_COMERCIAL);
					$('input[name="entidade_fone_celular"]').val(data.FONE_CELULAR);
					$('input[name="entidade_fone_residencial"]').val(data.FONE_RESIDENCIAL);
					$('input[name="entidade_endereco"]').val(data.ENDERECO);
					$('input[name="entidade_numero"]').val(data.NUMERO);
					$('input[name="entidade_bairro"]').val(data.BAIRRO);
					$('input[name="entidade_cep"]').val(data.CEP);
					$('select[name="entidade_estado"]').val(data.CODIGO_ESTADO);
														
					$('select[name="entidade_cidade"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade"]').val(data.CODIGO_CIDADE)},1000);
					
					$('input[name="entidade_email"]').val(data.EMAIL);
					$('input[name="entidade_site"]').val(data.SITE);
					$('input[name="entidade_rg"]').val(data.RG);
					$('input[name="cnpj_cpf"]').val(data.CPF);
					$('input[name="entidade_nascimento"]').val(data.DATA_NASCIMENTO);

					//aba vinculos
					$('select[name="entidade_pessoa_gerente_atendimento"]').val(data.GERENTE);
					$('select[name="entidade_pessoa_praca_pagamento"]').val(data.PRACA);
					$('select[name="entidade_pessoa_cfop"]').val(data.CFOP);
					$('select[name="entidade_pessoa_representante"]').val(data.REPRESENTANTE);
					$('input[name="entidade_pessoa_comissao"]').val(data.COMISSAO);
					
					//aba enderecos
					$('input[name="entidade_endereco_cobranca"]').val(data.ENDERECO_COBRANCA);
					$('input[name="entidade_numero_cobranca"]').val(data.NUMERO_COBRANCA);
					$('input[name="entidade_bairro_cobranca"]').val(data.BAIRRO_COBRANCA);
					$('input[name="entidade_cep_cobranca"]').val(data.CEP_COBRANCA);
					$('select[name="entidade_estado_cobranca"]').val(data.CODIGO_ESTADO_COBRANCA);

					$('select[name="entidade_cidade_cobranca"]').hide();
					$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: data.CODIGO_ESTADO_COBRANCA , ajax: 'true'}, function(j){
						var options = '';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
						}	
						$('select[name="entidade_cidade_cobranca"]').html(options).show();
					});
						
					setTimeout(function(){$('select[name="entidade_cidade_cobranca"]').val(data.CODIGO_CIDADE)},1000);
					
					//$('input[name="entidade_endereco_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_numero_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_bairro_adicional"]').val(data.GERENTE);
					//$('input[name="entidade_cep_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_estado_adicional"]').val(data.GERENTE);
					//$('select[name="entidade_cidade_adicional"]').val(data.GERENTE);
					
					//aba crediario
					$('select[name="entidade_pessoa_bloqueado"]').val(data.BLOQUEIO);
					$('input[name="entidade_pessoa_limite"]').val(data.LIMITE_CREDITO);
					$('select[name="entidade_pessoa_prazo"]').val(data.COMPRA_A_PRAZO);
					$('input[name="entidade_local_trabalho"]').val(data.LOCAL_TRABALHO);
					$('input[name="entidade_profissao"]').val(data.PROFISSAO);
					$('input[name="entidade_tempo_trabalho"]').val(data.TEMPO_TRABALHO);
					$('input[name="entidade_salario"]').val(data.SALARIO);
					$('input[name="entidade_endereco_trabalho"]').val(data.ENDERECO_TRABALHO);

					$('input[name="entidade_conjuge"]').val(data.CONJUGE);
					$('input[name="entidade_cpf_conjuge"]').val(data.CPF_CONJUGE);
					$('input[name="entidade_rg_conjuge"]').val(data.RG_CONJUGE);
					$('input[name="entidade_local_trabalho_conjuge"]').val(data.LOCAL_TRABALHO_CONJUGE);
					$('input[name="entidade_tempo_local_trabalho_conjuge"]').val(data.TEMPO_TRABALHO_CONJUGE);
					$('input[name="entidade_salario_conjuge"]').val(data.SALARIO_CONJUGE);
					
					//aba complementos
					$('input[name="entidade_mae"]').val(data.MAE);
					$('input[name="entidade_pai"]').val(data.PAI);
					$('ul#menu_entidade_pessoa li').removeClass('k-state-disabled');
					$('form[name="add_entidade"] input[type="text"], form[name="add_entidade"] input[type="checkbox"], form[name="add_entidade"] select').attr('disabled',false);
					
  					$('input[name="entidade_codigo_pessoa"]').attr('disabled',true)

				 },
		error: function(xhr,er) {
					$('#entidade').html(xhr+er);
						
				 }		
	});			
})
// ==============================================================================================


//efeita em tabela 
$('.tr_table_pesquisa_entidade').live('click',function(){
	
	var id = $(this).attr('id');
	
	$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
	$('tr[id="'+id+'"], tr[id="'+id+'"] td').addClass('tr_selecionada');
	$('a[name="pes_ent_bt_vis"]').css({color:'#7F8AC2'});
	$('a[name="pes_ent_bt_vis"]:only-child').css({color:'#fff'});
	
	
	
});