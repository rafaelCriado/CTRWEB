	//Efeito de Abas
	$("#tabstrip").kendoTabStrip({
		animation:  {
			 open:  {
						effects: "fadeIn"
					}
		}
	
	});
	
	//Quando seleciona o campo cpf ou cnpj retira-se os caracteres especiais		
	$('input[name="cnpj_cpf"]').focusin(function(e) {
		var valor   = $(this).val();
		valor=valor.replace('.','');
		valor=valor.replace('.','');
		valor=valor.replace('/','');
		valor=valor.replace('-','');
		$(this).val(valor);
	});
	
	//Evento de pesquisa com a tecla F2 ainda com o campo CPF/CNPJ em focus
	$('input[name="cnpj_cpf"]').focus(function(){
		$(this).keydown(function(){
			var tamanho = $(this).val().length;
			if( tamanho > 11 && $('h4.entidade_titulo').html() == 'Pessoa Física'){
					$('h4.entidade_titulo').html('Pessoa Jurídica')
					$('#entidade').load('php/entidade/pessoa/form_pessoa_juridica.php');
					$('input[name="entidade_tipo_pessoa"]').val('JURIDICA');
					
			}else if(tamanho <= 11 && $('h4.entidade_titulo').html() == 'Pessoa Jurídica'){
					$('h4.entidade_titulo').html('Pessoa Física')
					$('#entidade').load('php/entidade/pessoa/form_pessoa_fisica.php');
					$('input[name="entidade_tipo_pessoa"]').val('FISICA');
					
			}
		});
		$(this).keydown(function(e){
			if(e.which == 113){
				
				var tamanho = $(this).val().length;
				var valor   = $(this).val();
				if(tamanho == 11){
					var pessoa = 'F';
				}else if( tamanho == 14 ){
					var pessoa = 'J';
				}
				
				if(pessoa == 'J'){
					$('#form_pessoa h4').html('Pessoa Jurídica');
					
					$.ajax({
						url: 'php/entidade/pessoa/form_pessoa_juridica.php', 
						dataType: 'html',
						data: { cnpj: valor},
						type: 'POST',
						success: function(data) {
									$('#entidade').html(data);
									var ativo = $('input[name="_ativo"]').val();
									
									//ENTIDADE ATIVO
									if(ativo == 1){
										$('input[name="entidade_ativo"]:eq(0)').attr('checked',true);
									}else if(ativo == 2){
										$('input[name="entidade_ativo"]:eq(1)').attr('checked', true);
									}
									//ENDEREÇO DE COBRANÇA
									$('input[name="entidade_endereco_cobranca"]').val($('input[name="_entidade_endereco_cobranca"]').val());
									//NUMERO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_numero_cobranca"]').val($('input[name="_entidade_numero_cobranca"]').val());
									//BAIRRO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_bairro_cobranca"]').val($('input[name="_entidade_bairro_cobranca"]').val());
									//CEP ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cep_cobranca"]').val($('input[name="_entidade_cep_cobranca"]').val());
									//CIDADE ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cidade_cobranca"]').val($('input[name="_entidade_cidade_cobranca"]').val());
									//ENTIDADE MÃE
									$('input[name="entidade_mae"]').val($('input[name="_entidade_mae"]').val());
									//ENTIDADE PAI
									$('input[name="entidade_pai"]').val($('input[name="_entidade_pai"]').val());
									//ENTIDADE LOCAL TRABALHO
									$('input[name="entidade_local_trabalho"]').val($('input[name="_entidade_local_trabalho"]').val());
									//ENTIDADE TEMPO TRABALHO
									$('input[name="entidade_tempo_trabalho"]').val($('input[name="_entidade_tempo_trabalho"]').val());
									//ENTIDADE SALARIO
									$('input[name="entidade_salario"]').val($('input[name="_entidade_salario"]').val());
									//ENTIDADE ENDEREÇO TRABALHO
									$('input[name="entidade_endereco_trabalho"]').val($('input[name="_entidade_endereco_trabalho"]').val());
									//ENTIDADE PROFISSAO
									$('input[name="entidade_profissao"]').val($('input[name="_entidade_profissao"]').val());
									//ENTIDADE CATEGORIA
									$('select[name="entidade_categoria_codigo"]').val($('input[name="_entidade_categoria_codigo"]').val());
									//ENTIDADE CIDADE 
									$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
									//ENTIDADE ESTADO 
									$('select[name="entidade_estado"]').val($('input[name="_entidade_estado"]').val());
									
									$('select[name="entidade_cidade"]').hide();
									//$('.carregando').show();
									$.getJSON('php/entidade/pessoa/cidades.ajax.php?search=',{entidade_estado: $('select[name="entidade_estado"]').val(), ajax: 'true'}, function(j){
										var options = '';	
										for (var i = 0; i < j.length; i++) {
											options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
										}	
										$('select[name="entidade_cidade"]').html(options).show();
										$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
										//$('.carregando').hide();
									});

									
								 },
						error: function(xhr,er) {
									$('#entidade').html(xhr+er);
								 }		
					});					
					
									
				}else if( pessoa == 'F' ){
					$('#form_pessoa h4').html('Pessoa Física');

					$.ajax({
						url: 'php/entidade/pessoa/form_pessoa_fisica.php', 
						dataType: 'html',
						data: { cpf: valor},
						type: 'POST',
						success: function(data) {
									$('#entidade').html(data);
									var ativo = $('input[name="_ativo"]').val();
									
									//ENTIDADE ATIVO
									if(ativo == 1){
										$('input[name="entidade_ativo"]:eq(0)').attr('checked',true);
									}else if(ativo == 2){
										$('input[name="entidade_ativo"]:eq(1)').attr('checked', true);
									}
									//ENDEREÇO DE COBRANÇA
									$('input[name="entidade_endereco_cobranca"]').val($('input[name="_entidade_endereco_cobranca"]').val());
									//NUMERO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_numero_cobranca"]').val($('input[name="_entidade_numero_cobranca"]').val());
									//BAIRRO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_bairro_cobranca"]').val($('input[name="_entidade_bairro_cobranca"]').val());
									//CEP ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cep_cobranca"]').val($('input[name="_entidade_cep_cobranca"]').val());
									//CIDADE ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cidade_cobranca"]').val($('input[name="_entidade_cidade_cobranca"]').val());
									//ENTIDADE MÃE
									$('input[name="entidade_mae"]').val($('input[name="_entidade_mae"]').val());
									//ENTIDADE PAI
									$('input[name="entidade_pai"]').val($('input[name="_entidade_pai"]').val());
									//ENTIDADE LOCAL TRABALHO
									$('input[name="entidade_local_trabalho"]').val($('input[name="_entidade_local_trabalho"]').val());
									//ENTIDADE TEMPO TRABALHO
									$('input[name="entidade_tempo_trabalho"]').val($('input[name="_entidade_tempo_trabalho"]').val());
									//ENTIDADE SALARIO
									$('input[name="entidade_salario"]').val($('input[name="_entidade_salario"]').val());
									//ENTIDADE ENDEREÇO TRABALHO
									$('input[name="entidade_endereco_trabalho"]').val($('input[name="_entidade_endereco_trabalho"]').val());
									//ENTIDADE PROFISSAO
									$('input[name="entidade_profissao"]').val($('input[name="_entidade_profissao"]').val());
									//ENTIDADE CATEGORIA
									$('select[name="entidade_categoria_codigo"]').val($('input[name="_entidade_categoria_codigo"]').val());
									//ENTIDADE CIDADE 
									$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
									//ENTIDADE ESTADO 
									$('select[name="entidade_estado"]').val($('input[name="_entidade_estado"]').val());
									
									$('select[name="entidade_cidade"]').hide();
									//$('.carregando').show();
									$.getJSON('php/entidade/pessoa/cidades.ajax.php?search=',{entidade_estado: $('select[name="entidade_estado"]').val(), ajax: 'true'}, function(j){
										var options = '';	
										for (var i = 0; i < j.length; i++) {
											options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
										}	
										$('select[name="entidade_cidade"]').html(options).show();
										$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
										//$('.carregando').hide();
									});

								 },
						error: function(xhr,er) {
									$('#entidade').html(xhr+er);
								 }		
					});	
				}
			}
		});
	});
	
	//Função valida CPF
	function validaCPF(cpf){
		
		var myCPF = cpf.val().replace('.', '').replace('.', '').replace('-', '').replace('/','');

		var numeros, digitos, soma, i, resultado, digitos_iguais;
		digitos_iguais = 1;
 
		if (myCPF.length < 11) {
			alert("CPF inválido.");
			cpf.focus();
			return false;
		}
		for (i = 0; i < myCPF.length - 1; i++)
			if (myCPF.charAt(i) != myCPF.charAt(i + 1)) {
				digitos_iguais = 0;
				break;
			}
		if (!digitos_iguais) {
			numeros = myCPF.substring(0, 9);
			digitos = myCPF.substring(9);
			soma = 0;
			for (i = 10; i > 1; i--)
				soma += numeros.charAt(10 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0)) {
				alert("CPF inválido.");
				cpf.focus();
				return false;
			}
			numeros = myCPF.substring(0, 10);
			soma = 0;
			for (i = 11; i > 1; i--)
				soma += numeros.charAt(11 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1)) {
				alert("CPF inválido.");
				cpf.focus();
				return false;
			}
			return true;
		}
		else {
			alert("CPF inválido.");
			cpf.focus();
			return false;
		}
	}
	
	//Função valida CNPJ
	function validaCNPJ(cnpj){
		return true
		myCNPJ = cnpj.val().replace('.', '').replace('.', '').replace('/', '').replace('-', '');
  
        var mControle = "";
        var aTabCNPJ = new Array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        for (i = 1; i <= 2; i++) {
            mSoma = 0;
            for (j = 0; j < myCNPJ.length; j++)
                mSoma = mSoma + (myCNPJ.substring(j, j + 1) * aTabCNPJ[j]);
            if (i == 2) mSoma = mSoma + (2 * mDigito);
            mDigito = (mSoma * 10) % 11;
            if (mDigito == 10) mDigito = 0;
            mControle1 = mControle;
            mControle = mDigito;
            aTabCNPJ = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3);
        }
        if ((mControle1 * 10) + mControle) {
            return true;
        }
        else {
            alert("CNPJ inválido.");
            cnpj.focus();
            return false;
        }
	}
	
	//Botão cadastrar
	$('a[name="bt_entidade_cadastrar"]').click(function(){
 		if($('select[name="entidade_cidade"]').val() == ''){
			alert('Escolha uma cidade');
		}else if($('input[name="entidade_nome"]').val() == ''){
			$('input[name="entidade_nome"]').focus();
			alert('Identifique o cliente');
			
		}else{
			var validacao = false;
				
			if($('input[name="cnpj_cpf"]').val().length == 11){
				validacao = validaCPF($('input[name="cnpj_cpf"]'));
			}
			
			if($('input[name="cnpj_cpf"]').val().length == 14){
				validacao = validaCNPJ($('input[name="cnpj_cpf"]'));
			}
			
			if(validacao){
				
				var nome_= "";
				var apelido_= "";
				var endereco_= "";
				var numero_= "";
				var bairro_= "";
				var cep_= "";
				var cidade_= "";
				var cpf_cnpj_= "";
				var ie_= "";
				var data_cadastro_= "";
				var site_= "";
				var categoria_= "";
				var mae_= "";
				var pai_= "";
				var rg_= "";
				var email_= "";
				var local_trabalho_= "";
				var endereco_trabalho_= "";
				var entidade_ativo_= "";
				var profissao_= "";
				var data_nascimento_= "";
				var tipo_pessoa_= "";
				var contato_= "";
				var endereco_cobranca_= "";
				var numero_cobranca_ =  "";
				var bairro_cobranca_ =  "";
				var cep_cobranca_ =  "";
				var cidade_cobranca_ =  "";
				var texto_livre_ =  "";
				var limite_credito_ =  "";
				var data_consulta_credito_ =  "";
				var gerente_ =  "";
				var bloqueado_ =  "";
				var prazo_ =  "";
				var estado_civil_ =  "";
				var salario_ =  0;
				var tempo_trabalho_ =  "";
				var nome_conjuge_ =  "";
				var cpf_conjuge_ =  "";
				var rg_conjuge_ =  "";
				var local_trabalho_conjuge_ =  "";
				var tempo_trabalho_conjuge_ =  "";
				var salario_conjuge_ =  0;
				var resposta_consulta_credito_ =  "";
				var codigo_p_vendedores_ =  "";
				var praca_ = "";
				var endereco_complemento_ = "";
				var cfop_ = "";
				var percentual_ = "";
				var codigo_representante_ = "";
				var entidade_fone_comercial = "";
				var entidade_fone_residencial = "";
				var entidade_fone_celular = "";
				
				var nome_				= $('input[name="entidade_nome"]').val();
				var apelido_			= $('input[name="entidade_fantasia"]').val();
				var endereco_			= $('input[name="entidade_endereco"]').val();
				var numero_				= $('input[name="entidade_numero"]').val();
				var bairro_				= $('input[name="entidade_bairro"]').val();
				var cep_				= $('input[name="entidade_cep"]').val();
				var cidade_				= $('select[name="entidade_cidade"]').val();
				var cpf_cnpj_			= $('input[name="cnpj_cpf"]').val();
				var ie_					= $('input[name="entidade_rg"]').val();
				var site_				= $('input[name="entidade_site"]').val();
				var categoria_			= $('select[name="entidade_categoria_codigo"]').val();
				var mae_				= $('input[name="entidade_mae"]').val();
				var pai_				= $('input[name="entidade_pai"]').val();
				var rg_					= $('input[name="entidade_rg"]').val();
				var email_				= $('input[name="entidade_email"]').val();
				var local_trabalho_		= $('input[name="entidade_local_trabalho"]').val();
				var endereco_trabalho_	= $('input[name="entidade_endereco_trabalho"]').val();
				var entidade_ativo_		= $('input[name="entidade_ativo"]').val();
				var profissao_			= $('input[name="entidade_profissao"]').val();
				var data_nascimento_	= $('input[name="entidade_nascimento"]').val();
				var tipo_pessoa_		= $('input[name="entidade_tipo_pessoa"]').val();
				var contato_			= $('input[name="entidade_contato"]').val();
				var endereco_cobranca_	= $('input[name="entidade_endereco_cobranca"]').val();
				var numero_cobranca_ 	= $('input[name="entidade_numero_cobranca"]').val();
				var bairro_cobranca_ 	= $('input[name="entidade_bairro_cobranca"]').val();
				var cep_cobranca_ 		= $('input[name="entidade_cep_cobranca"]').val();
				var cidade_cobranca_ 	= $('select[name="entidade_cidade_cobranca"]').val();
				//var texto_livre_ 		= $('input[name=""]').val();
				//var limite_credito_ 	= $('input[name=""]').val();
				//var data_consulta_credito_ = $('input[name=""]').val();
				//var gerente_ 				= $('input[name=""]').val();
				//var bloqueado_ 			= $('input[name=""]').val();
				//var prazo_ 				= $('input[name=""]').val();
				var estado_civil_ 			= $('select[name="entidade_estado_civil"]').val();
				var salario_ 				= $('input[name="entidade_salario"]').val();
				var tempo_trabalho_ 		= $('input[name="entidade_tempo_trabalho"]').val();
				var nome_conjuge_ 			= $('input[name="entidade_conjuge"]').val();
				var cpf_conjuge_ 			= $('input[name="entidade_cpf_conjuge"]').val();
				var rg_conjuge_ 			= $('input[name="entidade_rg_conjuge"]').val();
				var local_trabalho_conjuge_ = $('input[name="entidade_local_trabalho_conjuge"]').val();
				var tempo_trabalho_conjuge_ = $('input[name="entidade_tempo_local_trabalho_conjuge"]').val();
				var salario_conjuge_ 		= $('input[name="entidade_salario_conjuge"]').val();
				//var resposta_consulta_credito_ 	= $('input[name=""]').val();
				//var codigo_p_vendedores_ 			=  $('input[name=""]').val();
				//var praca_ 						= $('input[name=""]').val();
				//var endereco_complemento_ 		= $('input[name=""]').val();
				//var cfop_ 						= $('input[name=""]').val();
				//var percentual_					= $('input[name=""]').val();
				//var codigo_representante_ 		= $('input[name=""]').val();
				var entidade_fone_comercial 	= $('input[name="entidade_fone_comercial"]').val();;
				var entidade_fone_residencial 	= $('input[name="entidade_fone_residencial"]').val();;
				var entidade_fone_celular 		= $('input[name="entidade_fone_celular"]').val();;
				
				$.ajax({
					url: 'php/entidade/pessoa/add_nova_entidade_pessoa.php', 
					dataType: 'html',
					data: 
					{
						nome: nome_,
						apelido: apelido_,
						endereco: endereco_,
						numero: numero_,
						bairro: bairro_,
						cep: cep_,
						cidade: cidade_,
						cpf_cnpj: cpf_cnpj_,
						ie: ie_,
						site: site_,
						categoria: categoria_,
						mae: mae_,
						pai: pai_,
						rg: rg_,
						email: email_,
						local_trabalho: local_trabalho_,
						endereco_trabalho: endereco_trabalho_,
						entidade_ativo: entidade_ativo_,
						profissao: profissao_,
						data_nascimento: data_nascimento_,
						tipo_pessoa: tipo_pessoa_,
						//contato: contato_,
						endereco_cobranca: endereco_cobranca_,
						numero_cobranca: numero_cobranca_,
						bairro_cobranca: bairro_cobranca_,
						cep_cobranca: cep_cobranca_,
						cidade_cobranca: cidade_cobranca_,
						//texto_livre: texto_livre_,
						//limite_credito: limite_credito_,
						//data_consulta_credito: data_consulta_credito_,
						//gerente: gerente_,
						//bloqueado: bloqueado_,
						//prazo: prazo_,
						estado_civil: estado_civil_,
						salario: salario_,
						tempo_trabalho: tempo_trabalho_,
						nome_conjuge: nome_conjuge_,
						cpf_conjuge: cpf_conjuge_,
						rg_conjuge: rg_conjuge_,
						local_trabalho_conjuge: local_trabalho_conjuge_,
						salario_conjuge: salario_conjuge_,
						tempo_trabalho_conjuge: tempo_trabalho_conjuge_,
						
						//resposta_consulta_credito: resposta_consulta_credito_,
						//codigo_p_vendedores:codigo_p_vendedores_,
						//praca:praca_,
						//endereco_complemento:endereco_complemento_,
						//cfop:cfop_,
						//percentual:percentual_,
						//codigo_representante:codigo_representante_,
						"entidade_fone_comercial":entidade_fone_comercial,
						"entidade_fone_residencial":entidade_fone_residencial,
						"entidade_fone_celular":entidade_fone_celular
		
						
					},
					type: 'POST',
					success: function(data) {
								
								$('#resposta_entidade_pessoa').html(data);
								//setTimeout($('.entidade_bt_inferior').html(''),5000);
								 },
					error: function(xhr,er) {
								
								$('.entidade_bt_inferior').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
								
							 }		
				});	
			
			}else{
				alert('Preecha o campo CPF/CNPJ corretamente');
			}
		}
	});
	
	//Botão limpar
	$('a[name="bt_entidade_limpar"]').click(function(e){
		e.preventDefault();
		$('#cadastro_entidade_pessoa input').each( function(){
			$(this).val('');
		});
	});
	
	//Botão editar
	$('a[name="bt_entidade_editar"]').click(function(){
		var validacao = false;
			
		if($('input[name="cnpj_cpf"]').val().length == 11){
			validacao = validaCPF($('input[name="cnpj_cpf"]'));
		}
		
		if($('input[name="cnpj_cpf"]').val().length == 14){
			validacao = validaCNPJ($('input[name="cnpj_cpf"]'));
		}
		
		if(validacao){
	   
			var nome_= "";
			var apelido_= "";
			var endereco_= "";
			var numero_= "";
			var bairro_= "";
			var cep_= "";
			var cidade_= "";
			var cpf_cnpj_= "";
			var ie_= "";
			var data_cadastro_= "";
			var site_= "";
			var categoria_= "";
			var mae_= "";
			var pai_= "";
			var rg_= "";
			var email_= "";
			var local_trabalho_= "";
			var endereco_trabalho_= "";
			var entidade_ativo_= "";
			var profissao_= "";
			var data_nascimento_= "";
			var tipo_pessoa_= "";
			var contato_= "";
			var endereco_cobranca_= "";
			var numero_cobranca_ =  "";
			var bairro_cobranca_ =  "";
			var cep_cobranca_ =  "";
			var cidade_cobranca_ =  "";
			var texto_livre_ =  "";
			var limite_credito_ =  "";
			var data_consulta_credito_ =  "";
			var gerente_ =  "";
			var bloqueado_ =  "";
			var prazo_ =  "";
			var estado_civil_ =  "";
			var salario_ =  "";
			var tempo_trabalho_ =  "";
			var nome_conjuge_ =  "";
			var cpf_conjuge_ =  "";
			var rg_conjuge_ =  "";
			var local_trabalho_conjuge_ =  "";
			var tempo_trabalho_conjuge_ =  "";
			var salario_conjuge_ =  0;
			var resposta_consulta_credito_ =  "";
			var codigo_p_vendedores_ =  "";
			var praca_ = "";
			var endereco_complemento_ = "";
			var cfop_ = "";
			var percentual_ = "";
			var codigo_representante_ = "";
			var entidade_fone_comercial = "";
			var entidade_fone_residencial = "";
			var entidade_fone_celular = "";

			
			var codigo				= $('input[name="_entidade_codigo"]').val();
			var nome_				= $('input[name="entidade_nome"]').val();
			var apelido_			= $('input[name="entidade_fantasia"]').val();
			var endereco_			= $('input[name="entidade_endereco"]').val();
			var numero_				= $('input[name="entidade_numero"]').val();
			var bairro_				= $('input[name="entidade_bairro"]').val();
			var cep_				= $('input[name="entidade_cep"]').val();
			var cidade_				= $('select[name="entidade_cidade"]').val();
			var cpf_cnpj_			= $('input[name="cnpj_cpf"]').val();
			var ie_					= $('input[name="entidade_rg"]').val();
			var site_				= $('input[name="entidade_site"]').val();
			var categoria_			= $('select[name="entidade_categoria_codigo"]').val();
			var mae_				= $('input[name="entidade_mae"]').val();
			var pai_				= $('input[name="entidade_pai"]').val();
			var rg_					= $('input[name="entidade_rg"]').val();
			var email_				= $('input[name="entidade_email"]').val();
			var local_trabalho_		= $('input[name="entidade_local_trabalho"]').val();
			var endereco_trabalho_	= $('input[name="entidade_endereco_trabalho"]').val();
			var entidade_ativo_		= $('input[name="entidade_ativo"]').val();
			var profissao_			= $('input[name="entidade_profissao"]').val();
			var data_nascimento_	= $('input[name="entidade_nascimento"]').val();
			var tipo_pessoa_		= $('input[name="entidade_tipo_pessoa"]').val();
			var contato_			= $('input[name="entidade_contato"]').val();
			var endereco_cobranca_	= $('input[name="entidade_endereco_cobranca"]').val();
			var numero_cobranca_ 	= $('input[name="entidade_numero_cobranca"]').val();
			var bairro_cobranca_ 	= $('input[name="entidade_bairro_cobranca"]').val();
			var cep_cobranca_ 		= $('input[name="entidade_cep_cobranca"]').val();
			var cidade_cobranca_ 	= $('select[name="entidade_cidade_cobranca"]').val();
			//var texto_livre_ 		= $('input[name=""]').val();
			//var limite_credito_ 	= $('input[name=""]').val();
			//var data_consulta_credito_ = $('input[name=""]').val();
			//var gerente_ 				= $('input[name=""]').val();
			//var bloqueado_ 			= $('input[name=""]').val();
			//var prazo_ 				= $('input[name=""]').val();
			var estado_civil_ 			= $('select[name="entidade_estado_civil"]').val();
			var salario_ 				= $('input[name="entidade_salario"]').val();
			var tempo_trabalho_ 		= $('input[name="entidade_tempo_trabalho"]').val();
			var nome_conjuge_ 			= $('input[name="entidade_conjuge"]').val();
			var cpf_conjuge_ 			= $('input[name="entidade_cpf_conjuge"]').val();
			var rg_conjuge_ 			= $('input[name="entidade_rg_conjuge"]').val();
			var local_trabalho_conjuge_ = $('input[name="entidade_local_trabalho_conjuge"]').val();
			var tempo_trabalho_conjuge_ = $('input[name="entidade_tempo_local_trabalho_conjuge"]').val();
			var salario_conjuge_ 		= $('input[name="entidade_salario_conjuge"]').val();
			//var resposta_consulta_credito_ 	= $('input[name=""]').val();
			//var codigo_p_vendedores_ 			=  $('input[name=""]').val();
			//var praca_ 						= $('input[name=""]').val();
			//var endereco_complemento_ 		= $('input[name=""]').val();
			//var cfop_ 						= $('input[name=""]').val();
			//var percentual_					= $('input[name=""]').val();
			//var codigo_representante_ 		= $('input[name=""]').val();
			var entidade_fone_comercial 	= $('input[name="entidade_fone_comercial"]').val();;
			var entidade_fone_residencial 	= $('input[name="entidade_fone_residencial"]').val();;
			var entidade_fone_celular 		= $('input[name="entidade_fone_celular"]').val();;

			if(codigo != 0 && codigo != "" && codigo!==undefined){
				var decisao = window.confirm("Deseja realmente realizar as alterações?");
				if(decisao){
					$.ajax({
						url: 'php/entidade/pessoa/atualizar_entidade_pessoa.php', 
						dataType: 'html',
						data: 
						{	
							"codigo":codigo,
							nome: nome_,
							apelido: apelido_,
							endereco: endereco_,
							numero: numero_,
							bairro: bairro_,
							cep: cep_,
							cidade: cidade_,
							cpf_cnpj: cpf_cnpj_,
							ie: ie_,
							site: site_,
							categoria: categoria_,
							mae: mae_,
							pai: pai_,
							rg: rg_,
							email: email_,
							local_trabalho: local_trabalho_,
							endereco_trabalho: endereco_trabalho_,
							entidade_ativo: entidade_ativo_,
							profissao: profissao_,
							data_nascimento: data_nascimento_,
							tipo_pessoa: tipo_pessoa_,
							//contato: contato_,
							endereco_cobranca: endereco_cobranca_,
							numero_cobranca: numero_cobranca_,
							bairro_cobranca: bairro_cobranca_,
							cep_cobranca: cep_cobranca_,
							cidade_cobranca: cidade_cobranca_,
							//texto_livre: texto_livre_,
							//limite_credito: limite_credito_,
							//data_consulta_credito: data_consulta_credito_,
							//gerente: gerente_,
							//bloqueado: bloqueado_,
							//prazo: prazo_,
							estado_civil: estado_civil_,
							salario: salario_,
							tempo_trabalho: tempo_trabalho_,
							nome_conjuge: nome_conjuge_,
							cpf_conjuge: cpf_conjuge_,
							rg_conjuge: rg_conjuge_,
							local_trabalho_conjuge: local_trabalho_conjuge_,
							tempo_trabalho_conjuge: tempo_trabalho_conjuge_,
							salario_conjuge: salario_conjuge_,
							//resposta_consulta_credito: resposta_consulta_credito_,
							//codigo_p_vendedores:codigo_p_vendedores_,
							//praca:praca_,
							//endereco_complemento:endereco_complemento_,
							//cfop:cfop_,
							//percentual:percentual_,
							//codigo_representante:codigo_representante_,
							"entidade_fone_comercial":entidade_fone_comercial,
							"entidade_fone_residencial":entidade_fone_residencial,
							"entidade_fone_celular":entidade_fone_celular

						},
						type: 'POST',
						success: function(data) {
									$('.entidade_bt_inferior').after(data);
									
									 },
						error: function(xhr,er) {
									$('#form_pessoa').html(xhr+er);
									
								 }		
					});	
				}
			}else{
				alert('Selecione um cliente');
			}
		}
		//$('form[name="add"]').submit();
		
	});

	//Mascara campo CEP cobrança
	$('input[name="entidade_cep_cobranca"]').focus(function(){
		$(this).keydown(function() {
            var qtde_cep = $(this).val().length;
			
			if(qtde_cep == 5){
				$(this).val($(this).val() + '-');
			}
        });
	});
	
	//Função para verificar se é numero
	function verificaNumero(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	}
	
	//Campos que aceitam somente numeros.
	$('input[name="entidade_cep_cobranca"]').keypress(verificaNumero);
	$('input[name="entidade_cep"]').keypress(verificaNumero);
	$('input[name="entidade_nascimento"]').keypress(verificaNumero);
	$('input[name="entidade_salario"]').keypress(verificaNumero);
	$('input[name="cnpj_cpf"]').keypress(verificaNumero);
	$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);
	$('input[name="entidade_cpf_conjuge"]').keypress(verificaNumero);
	$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);
	
	//Popula as cidades de acordo com o estado
	$('select[name="entidade_estado"]').change(function(){
		if( $(this).val() ) {
			$('select[name="entidade_cidade"]').hide();
			//$('.carregando').show();
			$.getJSON('php/entidade/pessoa/cidades.ajax.php?search=',{entidade_estado: $(this).val(), ajax: 'true'}, function(j){
				var options = '';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
				}	
				$('select[name="entidade_cidade"]').html(options).show();
				//$('.carregando').hide();
			});
		} else {
			$('select[name="entidade_cidade"]').html('<option value="">-- Escolha um estado --</option>');
		}
	});
	
			//Auto Complete com o campo nome
		$('input[name="entidade_nome"]').autocomplete("php/entidade/pessoa/search.php", {
			width: 330,
			matchContains: true,
			selectFirst: false
		});
		
		//Efeito de passar campos com a TECLA ENTER
		$('input').keypress(function(e){
			/*
			 * verifica se o evento é Keycode (para IE e outros browsers)
			 * se não for pega o evento Which (Firefox)
			*/
		   var tecla = (e.keyCode?e.keyCode:e.which);
			
		   /* verifica se a tecla pressionada foi o ENTER */
		   if(tecla == 13){
			   /* guarda o seletor do campo que foi pressionado Enter */
			   campo =  $('input');
			   /* pega o indice do elemento*/
			   indice = campo.index(this);
			   /*soma mais um ao indice e verifica se não é null
				*se não for é porque existe outro elemento
			   */
			  if(campo[indice+1] != null){
				 /* adiciona mais 1 no valor do indice */
				 proximo = campo[indice + 1];
				 /* passa o foco para o proximo elemento */
				 proximo.focus();
			  }
			}
		});
	
		//CONSULTANDO DADOS PELO NOME COM A TECLA F2 QUANDO O FOCO AINDA ESTA NO NOME
		$('input[name="entidade_nome"]').focus(function(){
			$(this).keydown(function(e){
				//113 = F2
				if(e.which == 113){
					var nValor = $('input[name="entidade_nome"]').val();
					
					$.ajax({
						url: 'php/entidade/pessoa/form_pessoa_fisica.php', 
						dataType: 'html',
						data: { nome: nValor},
						type: 'POST',
						success: function(data) {
									$('#entidade').html(data);
									var ativo = $('input[name="_ativo"]').val();
									//ENTIDADE ATIVO
									if(ativo == 1){
										$('input[name="entidade_ativo"]:eq(0)').attr('checked',true);
									}else if(ativo == 2){
										$('input[name="entidade_ativo"]:eq(1)').attr('checked', true);
									}
									
									//ALIMENTA AS OUTRAS ABAS DA TELA 
									//ENDEREÇO DE COBRANÇA
									$('input[name="entidade_endereco_cobranca"]').val($('input[name="_entidade_endereco_cobranca"]').val());
									//NUMERO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_numero_cobranca"]').val($('input[name="_entidade_numero_cobranca"]').val());
									//BAIRRO DO ENDEREÇO DE COBRANÇA
									$('input[name="entidade_bairro_cobranca"]').val($('input[name="_entidade_bairro_cobranca"]').val());
									//CEP ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cep_cobranca"]').val($('input[name="_entidade_cep_cobranca"]').val());
									//CIDADE ENDEREÇO DE COBRANÇA
									$('input[name="entidade_cidade_cobranca"]').val($('input[name="_entidade_cidade_cobranca"]').val());
									//ENTIDADE MÃE
									$('input[name="entidade_mae"]').val($('input[name="_entidade_mae"]').val());
									//ENTIDADE PAI
									$('input[name="entidade_pai"]').val($('input[name="_entidade_pai"]').val());
									//ENTIDADE LOCAL TRABALHO
									$('input[name="entidade_local_trabalho"]').val($('input[name="_entidade_local_trabalho"]').val());
									//ENTIDADE TEMPO TRABALHO
									$('input[name="entidade_tempo_trabalho"]').val($('input[name="_entidade_tempo_trabalho"]').val());
									//ENTIDADE SALARIO
									$('input[name="entidade_salario"]').val($('input[name="_entidade_salario"]').val());
									//ENTIDADE ENDEREÇO TRABALHO
									$('input[name="entidade_endereco_trabalho"]').val($('input[name="_entidade_endereco_trabalho"]').val());
									//ENTIDADE PROFISSAO
									$('input[name="entidade_profissao"]').val($('input[name="_entidade_profissao"]').val());
									//ENTIDADE CATEGORIA
									$('select[name="entidade_categoria_codigo"]').val($('input[name="_entidade_categoria_codigo"]').val());
									//ENTIDADE ESTADO 
									$('select[name="entidade_estado"]').val($('input[name="_entidade_estado"]').val());
									//ENTIDADE CPF / CNPJ 
									$('input[name="cnpj_cpf"]').val($('input[name="_cnpj_cpf"]').val());
									
									
									
									$('select[name="entidade_cidade"]').hide();
									//$('.carregando').show();
									$.getJSON('php/entidade/pessoa/cidades.ajax.php?search=',{entidade_estado: $('select[name="entidade_estado"]').val(), ajax: 'true'}, function(j){
										var options = '';	
										for (var i = 0; i < j.length; i++) {
											options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
										}	
										$('select[name="entidade_cidade"]').html(options).show();
										$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
										//$('.carregando').hide();
									});
									
								 },
						error: function(xhr,er) {
									$('#entidade').html(xhr+er);
										
								 }		
					});		
				}
			});
		});
		
		//Mascara no campo CEP
		$('input[name="entidade_cep"]').keypress(function(e) {
			
			var entrada = $(this).val().length;
			
			if(entrada == 5){
				$(this).val($(this).val() + '-');
			}
		});
					
		//MASCARA NO CAMPO DATA DE NASCIMENTO
		$('input[name="entidade_nascimento"]').keypress(function(e) {
			
			var entradaNAS = $(this).val().length;

			if(entradaNAS == 2){
				$(this).val($(this).val() + '/');
			}
			if(entradaNAS == 5){
				$(this).val($(this).val() + '/');
			}
		});
					
		//MASCARA DE CPF CONJUGE			
		$('input[name="entidade_cpf_conjuge"]').keypress(function(){
			var entradaCPFCONJUGE = $(this).val().length;
			if(entradaCPFCONJUGE == 3){
				$(this).val($(this).val() + '.');
			}
			if(entradaCPFCONJUGE == 7){
				$(this).val($(this).val() + '.');
			}
			if(entradaCPFCONJUGE == 11){
				$(this).val($(this).val() + '-');
			}
		});
		
		//Somente numeros
		//Campos que aceitam somente numeros.
		$('input[name="entidade_cep_cobranca"]').keypress(verificaNumero);
		$('input[name="entidade_cep"]').keypress(verificaNumero);
		$('input[name="entidade_nascimento"]').keypress(verificaNumero);
		$('input[name="entidade_salario"]').keypress(verificaNumero);
		$('input[name="cnpj_cpf"]').keypress(verificaNumero);
		$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);
		$('input[name="entidade_cpf_conjuge"]').keypress(verificaNumero);
		$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);		
		
		//Validação CPF conjuge
		$('input[name="entidade_cpf_conjuge"]').focus(function(){
			$(this).keyup(function(){
				var valor_cpf_conjuge = $(this).val().length;
				if(valor_cpf_conjuge == 14){
					if(validaCPF($(this))){
						$(this).css({background:'#BCFEC8'});
					}else{
						$(this).css({background:'#FBCBCA'});
					};
				}else{
					$(this).css({background:'#FFFFFF'})
				}
			});
		});
		
		//Populando cidade por estado
		$('select[name="entidade_estado"]').change(function(){
			if( $(this).val() ) {
				$('select[name="entidade_cidade"]').hide();
				//$('.carregando').show();
				$.getJSON('php/entidade/pessoa/cidades.ajax.php?search=',{entidade_estado: $(this).val(), ajax: 'true'}, function(j){
					var options = '';	
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
					}	
					$('select[name="entidade_cidade"]').html(options).show();
					//$('.carregando').hide();
				});
			} else {
				$('select[name="entidade_cidade"]').html('<option value="">-- Escolha um estado --</option>');
			}
		});

		//Mascara TELEFONES
		$('input[name^="entidade_fone_"]')
			.focus(function(){
				$(this).keydown(function(e){
					
					var t = $(this).val().length;
					
					if(t == 0){
						$(this).val('('+$(this).val());
					}else if( t == 3 && e.which != 8){
							$(this).val($(this).val() + ')');
					}else if( t > 4){
						if($(this).val().substr(1,2) == '11'){
							$(this).attr('maxlength',13);
						}else{
							$(this).attr('maxlength',12);							
						}
						
					}
					
				});
			})
			.focusout(function(){
				var t = $(this).val().length;
				if(t < 11){
					$(this).val('');
				}
			});