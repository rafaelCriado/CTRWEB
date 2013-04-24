	<script>
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
		
		$('input[name="cnpj_cpf"]').val(<?php if(isset($entidade->CPF) and !empty($entidade->CPF)){echo $entidade->CPF;} ?>);
				
	</script>
	<?php
        error_reporting(0);
        
        //Inclui o banco de dados
        include("../../../php/classes/bd_oracle.class.php"); 
        
        //Verifica se recebeu CPF por post
        if(isset($_POST['cpf']) and !empty($_POST['cpf'])){
            $valor = "ENTCNPJCPF = '".addslashes($_POST['cpf'])."'";
        }
        
        //Verifica se recebeu Nome por post
        if(isset($_POST['nome']) and !empty($_POST['nome'])){
            $valor = "ENTNOM = '".addslashes($_POST['nome'])."'";
        }
        
        
        if(isset($valor) or !empty($valor)){
            
            //Pesquisa informações da entidade.
            $query_entidade = oci_parse($conecta, 
                                            "SELECT 
												 E.ENTCOD AS CODIGO,
												 E.ENTCNPJCPF AS CPF,
												 E.ENTNOM AS NOME,
												 E.ENTNOMFAN AS APELIDO,
												 E.ENTEND AS ENDERECO,
												 E.ENTNUM AS NUMERO,
												 E.ENTBAI AS BAIRRO,
												 E.ENTCEP AS CEP,
												 E.CIDCOD AS CODIGO_CIDADE,
												 U.UFCOD AS CODIGO_ESTADO,
												 E.ENTINSEST,
												 TO_CHAR(E.ENTDATCAD, 'DD/MM/YYYY') AS DATA_CADASTRO,
												 E.ENTHOMPAG AS SITE,
												 E.USUCOD AS CODIGO_USUARIO,
												 E.CATENTCODESTR AS ENTIDADE_CATEGORIA,
												 E.ENTNOMMAE AS ENTIDADE_MAE,
												 E.ENTNOMPAI AS ENTIDADE_PAI,
												 E.ENTRG AS ENTIDADE_RG,
												 E.ENTEMA AS ENTIDADE_EMAIL,
												 E.ENTLOCTRA AS ENTIDADE_LOCAL_TRABALHO,
												 E.ENTENDTRA AS ENTIDADE_ENDERECO_TRABALHO,
												 E.ENTATI AS ATIVO,
												 E.ENTPRO AS ENTIDADE_PROFISSAO,
												 TO_CHAR(E.ENTDATNAS, 'DD/MM/YYYY') AS DATA_NASCIMENTO,
												 E.ENTTIPPES,
												 E.ENTCON AS ENTIDADE_CONTATO,
												 E.ENTENDCOB AS ENTIDADE_ENDERECO_COBRANCA,
												 E.ENTNUMCOB AS ENTIDADE_NUMERO_COBRANCA,
												 E.ENTBAICOB AS ENTIDADE_BAIRRO_COBRANCA,
												 E.ENTCEPCOB AS ENTIDADE_CEP_COBRANCA,
												 E.CIDCODCOB AS ENTIDADE_CIDADE_COBRANCA,
												 E.ENTTEXLIV,
												 E.ENTLIMCRE,
												 TO_CHAR(E.ENTDATCONCRE, 'DD/MM/YYYY') AS ENTDATCONCRE,
												 E.ENTGER,
												 E.ENTBLO,
												 E.ENTCOMPRA,
												 E.ENTESTCIV,
												 E.ENTSALTRA AS ENTIDADE_SALARIO,
												 E.ENTTEMTRA AS ENTIDADE_TEMPO_TRABALHO,
												 E.ENTNOMCON AS CONJUGE,
												 E.ENTCPFCON AS CPF_CONJUGE,
												 E.ENTRGCON AS RG_CONJUGE,
												 E.ENTLOCTRACON AS LOCAL_TRABALHO_CONJUGE,
												 E.ENTTEMTRACON AS TEMPO_TRABALHO_CONJUGE,
												 E.ENTSALCON AS SALARIO_CONJUGE,
												 E.ENTRESCONCRE,
												 E.ENTCODVEN,
												 E.ENTPRCPAG,
												 E.ENTENDCOM,
												 E.CFOCOD,
												 E.ENTREPCOM,
												 E.ENTCODREP,
												 (SELECT F.ENTFONNUM FROM ENT_FONE F WHERE F.ENTFONDESC = 'CELULAR' AND F.ENTCOD = E.ENTCOD) AS ENTIDADE_FONE_CELULAR, 
												 (SELECT F.ENTFONNUM FROM ENT_FONE F WHERE F.ENTFONDESC = 'COMERCIAL' AND F.ENTCOD = E.ENTCOD) AS ENTIDADE_FONE_COMERCIAL, 
												 (SELECT F.ENTFONNUM FROM ENT_FONE F WHERE F.ENTFONDESC = 'RESIDENCIAL' AND F.ENTCOD = E.ENTCOD) AS ENTIDADE_FONE_RESIDENCIAL
											  FROM 
												  ENTIDADE E, CIDADE C, UF U
											  WHERE 
												  E.CIDCOD = C.CIDCOD AND 
												  C.CIDUFCOD = U.UFCOD AND $valor");
                
            //Executa pesquisa
            oci_execute($query_entidade);
            
            //Recebe valores da pesquisa
            $entidade = oci_fetch_object($query_entidade);
        }
    ?>
	<input type="hidden" name="_cnpj_cpf"					value="<?php if(isset($entidade->CPF) and !empty($entidade->CPF)){echo $entidade->CPF;} ?>">
	<input type="hidden" name="_entidade_codigo"			value="<?php if(isset($entidade->CODIGO) and !empty($entidade->CODIGO)){echo $entidade->CODIGO;} ?>">
	<input type="hidden" name="_ativo" 						value="<?php if(isset($entidade->ATIVO) and !empty($entidade->ATIVO)){echo $entidade->ATIVO;} ?>">
	<input type="hidden" name="_entidade_categoria_codigo" 	value="<?php if(isset($entidade->ENTIDADE_CATEGORIA) and !empty($entidade->ENTIDADE_CATEGORIA)){echo $entidade->ENTIDADE_CATEGORIA;} ?>">
	<input type="hidden" name="_entidade_endereco_cobranca" value="<?php if(isset($entidade->ENTIDADE_ENDERECO_COBRANCA) and !empty($entidade->ENTIDADE_ENDERECO_COBRANCA)){echo $entidade->ENTIDADE_ENDERECO_COBRANCA;} ?>">
	<input type="hidden" name="_entidade_numero_cobranca" 	value="<?php if(isset($entidade->ENTIDADE_NUMERO_COBRANCA) and !empty($entidade->ENTIDADE_NUMERO_COBRANCA)){echo $entidade->ENTIDADE_NUMERO_COBRANCA;} ?>">
	<input type="hidden" name="_entidade_bairro_cobranca" 	value="<?php if(isset($entidade->ENTIDADE_BAIRRO_COBRANCA) and !empty($entidade->ENTIDADE_BAIRRO_COBRANCA)){echo $entidade->ENTIDADE_BAIRRO_COBRANCA;} ?>">
	<input type="hidden" name="_entidade_cep_cobranca" 		value="<?php if(isset($entidade->ENTIDADE_CEP_COBRANCA) and !empty($entidade->ENTIDADE_CEP_COBRANCA)){echo $entidade->ENTIDADE_CEP_COBRANCA;} ?>">
	<input type="hidden" name="_entidade_cidade_cobranca" 	value="<?php if(isset($entidade->ENTIDADE_CIDADE_COBRANCA) and !empty($entidade->ENTIDADE_CIDADE_COBRANCA)){echo $entidade->ENTIDADE_CIDADE_COBRANCA;} ?>">
	<input type="hidden" name="_entidade_tempo_trabalho"	value="<?php if(isset($entidade->ENTIDADE_TEMPO_TRABALHO) and !empty($entidade->ENTIDADE_TEMPO_TRABALHO)){echo $entidade->ENTIDADE_TEMPO_TRABALHO;} ?>">
	<input type="hidden" name="_entidade_local_trabalho" 	value="<?php if(isset($entidade->ENTIDADE_LOCAL_TRABALHO) and !empty($entidade->ENTIDADE_LOCAL_TRABALHO)){echo $entidade->ENTIDADE_LOCAL_TRABALHO;} ?>">
	<input type="hidden" name="_entidade_salario" 			value="<?php if(isset($entidade->ENTIDADE_SALARIO) and !empty($entidade->ENTIDADE_SALARIO)){echo number_format($entidade->ENTIDADE_SALARIO,2,',','');} ?>">
	<input type="hidden" name="_entidade_endereco_trabalho" value="<?php if(isset($entidade->ENTIDADE_ENDERECO_TRABALHO) and !empty($entidade->ENTIDADE_ENDERECO_TRABALHO)){echo $entidade->ENTIDADE_ENDERECO_TRABALHO;} ?>">
	<input type="hidden" name="_entidade_mae" 				value="<?php if(isset($entidade->ENTIDADE_MAE) and !empty($entidade->ENTIDADE_MAE)){echo $entidade->ENTIDADE_MAE;} ?>">
	<input type="hidden" name="_entidade_pai" 				value="<?php if(isset($entidade->ENTIDADE_PAI) and !empty($entidade->ENTIDADE_PAI)){echo $entidade->ENTIDADE_PAI;} ?>">
	<input type="hidden" name="_entidade_estado" 			value="<?php if(isset($entidade->CODIGO_ESTADO) and !empty($entidade->CODIGO_ESTADO)){echo $entidade->CODIGO_ESTADO;} ?>">
	<input type="hidden" name="_entidade_cidade" 			value="<?php if(isset($entidade->CODIGO_CIDADE) and !empty($entidade->CODIGO_CIDADE)){echo $entidade->CODIGO_CIDADE;} ?>">
	<input type="hidden" name="_entidade_local_trabalho" 	value="<?php if(isset($entidade->ENTIDADE_LOCAL_TRABALHO) and !empty($entidade->ENTIDADE_LOCAL_TRABALHO)){echo $entidade->ENTIDADE_LOCAL_TRABALHO;} ?>">
	<input type="hidden" name="_entidade_profissao" 		value="<?php if(isset($entidade->ENTIDADE_PROFISSAO) and !empty($entidade->ENTIDADE_PROFISSAO)){echo $entidade->ENTIDADE_PROFISSAO;} ?>">
	
    <label for="entidade_nome">Nome:</label>
	<input type="text" name="entidade_nome" 				value="<?php if(isset($entidade->NOME) and !empty($entidade->NOME)){echo $entidade->NOME;} ?>" size="50" maxlength="150">

    <label for="entidade_fantasia">Apelido:</label>
    <input type="text" name="entidade_fantasia" 			value="<?php if(isset($entidade->APELIDO) and !empty($entidade->APELIDO)){echo $entidade->APELIDO;} ?>" size="38" maxlength="150">
    <br>

    
    
    
    <label for="entidade_estado_civil">Estado Civil: </label>
    <select name="entidade_estado_civil">
        <option value="SOLTEIRO">SOLTEIRO</option>
        <option value="CASADO">CASADO</option>
        <option value="SEPARADO">SEPARADO</option>
        <option value="DIVORCIADO">DIVORCIADO</option>
        <option value="VIUVO">VIUVO</option>
    </select>
    <br />
    
    <label for="entidade_contato">Contato:</label>
    <input type="text" name="entidade_contato" 		value="<?php if(isset($entidade->ENTIDADE_CONTATO) and !empty($entidade->ENTIDADE_CONTATO)){echo $entidade->ENTIDADE_CONTATO;} ?>" size="100" maxlength="150">	<fieldset>
    	<legend>Telefones</legend>
        <label for="entidade_fone_comercial">Comercial:</label>
        <input type="text" name="entidade_fone_comercial" 	value="<?php if(isset($entidade->ENTIDADE_FONE_COMERCIAL) and !empty($entidade->ENTIDADE_FONE_COMERCIAL)){echo $entidade->ENTIDADE_FONE_COMERCIAL;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
        <label for="entidade_fone_celular">Celular:</label>
        <input type="text" name="entidade_fone_celular" 	value="<?php if(isset($entidade->ENTIDADE_FONE_CELULAR) and !empty($entidade->ENTIDADE_FONE_CELULAR)){echo $entidade->ENTIDADE_FONE_CELULAR;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
        <label for="entidade_fone_residencial">Residencial:</label>
        <input type="text" name="entidade_fone_residencial" value="<?php if(isset($entidade->ENTIDADE_FONE_RESIDENCIAL) and !empty($entidade->ENTIDADE_FONE_RESIDENCIAL)){echo $entidade->ENTIDADE_FONE_RESIDENCIAL;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
    </fieldset>


	<!-- Dados do Conjuge -->
	<!-- Fim dos Dados do Conjuge -->