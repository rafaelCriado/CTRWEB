	<script>
		//Auto Complete com o campo nome
		$('input[name="entidade_nome"]').autocomplete("php/entidade/pessoa/search_juridica.php", {
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
				//119 = F8
				if(e.which == 113){
					var nValor = $('input[name="entidade_nome"]').val();
					
					$.ajax({
						url: 'php/entidade/pessoa/form_pessoa_juridica.php', 
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
									//ENTIDADE CIDADE 
									$('select[name="entidade_cidade"]').val($('input[name="_entidade_cidade"]').val());
									//ENTIDADE ESTADO 
									$('select[name="entidade_estado"]').val($('input[name="_entidade_estado"]').val());
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
					
		
		//MASCARA NO CAMPO DATA DE FUNDAÇÃO
		$('input[name="entidade_nascimento"]').keypress(function(e) {
			
			var entradaNAS = $(this).val().length;

			if(entradaNAS == 2){
				$(this).val($(this).val() + '/');
			}
			if(entradaNAS == 5){
				$(this).val($(this).val() + '/');
			}
		});
					
		//MASCARA DE CPF RESPONSAVEL			
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
		
		//Campos que aceitam somente numeros.
		$('input[name="entidade_cep_cobranca"]').keypress(verificaNumero);
		$('input[name="entidade_cep"]').keypress(verificaNumero);
		$('input[name="entidade_nascimento"]').keypress(verificaNumero);
		$('input[name="entidade_salario"]').keypress(verificaNumero);
		$('input[name="cnpj_cpf"]').keypress(verificaNumero);
		$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);
		$('input[name="entidade_cpf_conjuge"]').keypress(verificaNumero);
		$('input[name="entidade_salario_conjuge"]').keypress(verificaNumero);		

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
        
        //Verifica se recebeu cnpj por post
        if(isset($_POST['cnpj']) and !empty($_POST['cnpj'])){
            $valor = "ENTCNPJCPF = '".addslashes($_POST['cnpj'])."'";
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
												 E.ENTCODREP
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
	
    <label for="entidade_nome">Razão Social:</label>
	<input type="text" name="entidade_nome" 				value="<?php if(isset($entidade->NOME) and !empty($entidade->NOME)){echo $entidade->NOME;} ?>" size="50" maxlength="150">

    <label for="entidade_fantasia">Nome Fantasia:</label>
    <input type="text" name="entidade_fantasia" 			value="<?php if(isset($entidade->APELIDO) and !empty($entidade->APELIDO)){echo $entidade->APELIDO;} ?>" size="38" maxlength="150">
    <br>

    <label for="entidade_endereco">Endereço:</label>
    <input type="text" name="entidade_endereco" 			value="<?php if(isset($entidade->ENDERECO) and !empty($entidade->ENDERECO)){echo $entidade->ENDERECO;} ?>" size="30" maxlength="200">

	<label for="entidade_numero">Nº:</label>
	<input type="text" name="entidade_numero" 				value="<?php if(isset($entidade->NUMERO) and !empty($entidade->NUMERO)){echo $entidade->NUMERO;} ?>" size="5" maxlength="10">

    <label for="entidade_bairro">Bairro:</label>
    <input type="text" name="entidade_bairro" 				value="<?php if(isset($entidade->BAIRRO) and !empty($entidade->BAIRRO)){echo $entidade->BAIRRO;} ?>" size="31" maxlength="50">
    <br>

    <label for="entidade_cep">CEP:</label>
    <input type="text" name="entidade_cep" 					value="<?php if(isset($entidade->CEP) and !empty($entidade->CEP)){echo $entidade->CEP;} ?>" size="23" maxlength="9" placeholder="XXXXX-XXX">

    <label for="entidade_estado">Estado: </label>
    <select name="entidade_estado">
        <?php 
            //Consulta Estado
            $query_uf = oci_parse($conecta,"SELECT UFCOD AS CODIGO_ESTADO ,UFABREV AS UF FROM UF");
            oci_execute($query_uf);
            
            while($estado = oci_fetch_object($query_uf)){
                echo '<option value="'.$estado->CODIGO_ESTADO.'">'.$estado->UF.'</option>';										
            }
        ?>
    </select>
	
    <label for="entidade_cidade">Cidade: </label>
    <select name="entidade_cidade">
        <?php 
            //Consulta Cidades
            $query_cidade = oci_parse($conecta,"SELECT CIDCOD AS CODIGO_CIDADE ,CIDNOM AS CIDADE FROM CIDADE");
            oci_execute($query_cidade);
    
            while($cidade = oci_fetch_object($query_cidade)){
                echo '<option value="'.$cidade->CODIGO_CIDADE.'">'.$cidade->CIDADE.'</option>';										
            }
        ?>
    </select>
	<br>

    <label for="entidade_email">Email:</label>
    <input type="text" name="entidade_email" 	value="<?php if(isset($entidade->ENTIDADE_EMAIL) and !empty($entidade->ENTIDADE_EMAIL)){echo $entidade->ENTIDADE_EMAIL;} ?>" size="44" maxlength="150">
    
    <label for="entidade_site">Site:</label>
    <input type="text" name="entidade_site" 	value="<?php if(isset($entidade->SITE) and !empty($entidade->SITE)){echo $entidade->SITE;} ?>" size="44" maxlength="150">
    <br>
    
    <label for="entidade_nascimento">Data de Fundação:</label>
    <input type="text" name="entidade_nascimento" value="<?php if(isset($entidade->DATA_NASCIMENTO) and !empty($entidade->DATA_NASCIMENTO)){echo $entidade->DATA_NASCIMENTO;} ?>" size="20" maxlength="10" placeholder="XX/XX/XXXX">
    
    <label for="entidade_rg">Inscrição Estadual:</label>
    <input type="text" name="entidade_rg" 		value="<?php if(isset($entidade->ENTIDADE_RG) and !empty($entidade->ENTIDADE_RG)){echo $entidade->ENTIDADE_RG;} ?>" size="20" maxlength="150">
    
    <label for="entidade_estado_civil">Estado Civil: </label>
    <select name="entidade_estado_civil" disabled="disabled">
        <option value="SOLTEIRO">SOLTEIRO</option>
        <option value="CASADO">CASADO</option>
        <option value="SEPARADO">SEPARADO</option>
        <option value="DIVORCIADO">DIVORCIADO</option>
        <option value="VIUVO">VIUVO</option>
    </select>
    <br />
    
    <label for="entidade_contato">Contato:</label>
    <input type="text" name="entidade_contato" 		value="<?php if(isset($entidade->ENTIDADE_CONTATO) and !empty($entidade->ENTIDADE_CONTATO)){echo $entidade->ENTIDADE_CONTATO;} ?>" size="100" maxlength="150">
	<fieldset>
    	<legend>Telefones</legend>
        <label for="entidade_fone_comercial">Comercial:</label>
        <input type="text" name="entidade_fone_comercial" 	value="<?php if(isset($entidade->ENTIDADE_FONE_COMERCIAL) and !empty($entidade->ENTIDADE_FONE_COMERCIAL)){echo $entidade->ENTIDADE_FONE_COMERCIAL;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
        <label for="entidade_fone_celular">Celular:</label>
        <input type="text" name="entidade_fone_celular" 	value="<?php if(isset($entidade->ENTIDADE_FONE_CELULAR) and !empty($entidade->ENTIDADE_FONE_CELULAR)){echo $entidade->ENTIDADE_FONE_CELULAR;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
        <label for="entidade_fone_residencial">Residencial:</label>
        <input type="text" name="entidade_fone_residencial" value="<?php if(isset($entidade->ENTIDADE_FONE_RESIDENCIAL) and !empty($entidade->ENTIDADE_FONE_RESIDENCIAL)){echo $entidade->ENTIDADE_FONE_RESIDENCIAL;} ?>" size="20" maxlength="12" placeholder="(99)9999999">
    </fieldset>

	<!-- Dados do Responsavel -->
 	<fieldset>
        <legend>Dados do Responsavel pela Empresa</legend>
        
        <label for="entidade_conjuge">Responsavel:</label>
        <input type="text" name="entidade_conjuge"		value="<?php if(isset($entidade->CONJUGE) and !empty($entidade->CONJUGE)){echo $entidade->CONJUGE;} ?>" size="50" maxlength="200">


        <label for="entidade_cpf_conjuge">CPF:</label>
        <input type="text" name="entidade_cpf_conjuge" 	value="<?php if(isset($entidade->CPF_CONJUGE) and !empty($entidade->CPF_CONJUGE)){echo $entidade->CPF_CONJUGE;} ?>" size="31" maxlength="14">
        <br>


    
        <label for="entidade_rg_conjuge">RG:</label>
        <input type="text" name="entidade_rg_conjuge" 	value="<?php if(isset($entidade->RG_CONJUGE) and !empty($entidade->RG_CONJUGE)){echo $entidade->RG_CONJUGE;} ?>" size="15" maxlength="50">
      

        <label for="entidade_local_trabalho_conjuge"> Cargo:</label>
        <input type="text" name="entidade_local_trabalho_conjuge" value="<?php if(isset($entidade->LOCAL_TRABALHO_CONJUGE) and !empty($entidade->LOCAL_TRABALHO_CONJUGE)){echo $entidade->LOCAL_TRABALHO_CONJUGE;} ?>" size="32" maxlength="150">
      	 
        <label for="entidade_tempo_local_trabalho_conjuge">Tempo na Empresa:</label>
        <input type="text" name="entidade_tempo_local_trabalho_conjuge" value="<?php if(isset($entidade->TEMPO_TRABALHO_CONJUGE) and !empty($entidade->TEMPO_TRABALHO_CONJUGE)){echo $entidade->TEMPO_TRABALHO_CONJUGE;} ?>" size="12" maxlength="150">
        <br>
        
       <!--<label for="entidade_local_trabalho_conjuge">Salário:</label>-->
        <input type="hidden" name="entidade_local_trabalho_conjuge" value="0" size="15" maxlength="150">
        
        <br>
    </fieldset>
	<!-- Fim dos Dados do Conjuge -->