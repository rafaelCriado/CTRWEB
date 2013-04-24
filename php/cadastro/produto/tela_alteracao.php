      	<?php 
			include('../../classes/bd_oracle.class.php');  
			$query = oci_parse($conecta, 
                    'select empcod as codigo,
					   empnom as razao,
					   empnomfan fantasia,
					   empsig sigla,
					   empcnp cnpj,
					   empie ie,
					   empend endereco,
					   empbai bairro,
					   empendcom complemento,
					   empendnum numero,
					   empcep cep,
					   emptel telefone,
					   cidcod cidade,
					   empema email,
					   emphom site
					from empresa  WHERE empcod  = '.$_GET['id']
                    );
			
			oci_execute($query);
			
			$row = oci_fetch_object($query)
			?>		
		
            <h3>Atualizar Empresa</h3>
            <form name="nova_empresa">
            	<input type="hidden" value="<?php echo $row->CODIGO;?>" name="nova_empresa_codigo">
                Razão Social: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_razao" placeholder="ADM Citrino LDTDA" class="k-input" value="<?php echo $row->RAZAO;?>" style="width:100%" maxlength="100">
                    </span>
                    <br>
               	
                Nome Fantasia: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_fantasia" placeholder="ADM Citrino" class="k-input" value="<?php echo $row->FANTASIA;?>" style="width:100%" maxlength="100">
                    </span>
                    <br>
                
                Sigla: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_sigla" placeholder="ADMCit" class="k-input" value="<?php echo $row->SIGLA;?>" style="width:100%"   maxlength="20">
                    </span>
                    <br>            

                CNPJ: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_cnpj" placeholder="00.696.700/1111-35" class="k-input" value="<?php echo $row->CNPJ;?>"  style="width:100%" maxlength="14">
                    </span>
                    <br>            
                
                Insc. Estadual: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_ie" placeholder="95965465782314" class="k-input" value="<?php echo $row->IE;?>"  style="width:100%" maxlength="14">
                    </span>
                    <br>  
                
                Endereço: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_endereco" placeholder="Rua Libero Badaró" class="k-input" value="<?php echo $row->ENDERECO;?>"  style="width:100%" maxlength="150">
                    </span>
                    <br>
                    
                Bairro: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_bairro" placeholder="Centro" class="k-input" style="width:100%" value="<?php echo $row->BAIRRO;?>"  maxlength="30">
                    </span>
                    <br>            
                Complemento: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_complemento" placeholder="Casa" class="k-input" style="width:100%" value="<?php echo $row->COMPLEMENTO;?>"  maxlength="50">
                    </span>
                    <br>            
              
                Número: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_numero" placeholder="105" class="k-input" style="width:100%" value="<?php echo $row->NUMERO;?>"  maxlength="10">
                    </span>
                    <br>            

                CEP: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_cep" placeholder="15190000" class="k-input" style="width:100%" value="<?php echo $row->CEP;?>"  maxlength="8">
                    </span>
                    <br>            
                    
                Telefone: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_telefone" placeholder="30300" class="k-input" style="width:100%" value="<?php echo $row->TELEFONE;?>"  maxlength="40">
                    </span>
                    <br>            
					<?PHP //Consulta de Cidades Cadastrados
                    $query_cidade = oci_parse($conecta, 
                        'SELECT 
                            CIDCOD AS CODIGO,
                            CIDNOM AS CIDADE 
                         FROM 
                            CIDADE'
                        );
                        
                    oci_execute($query_cidade);
                    ?>
                    Cidade:	<select name="nova_empresa_cidade">
                                <?php
                                    while ($row_cidade = oci_fetch_object($query_cidade)) {
                                        echo '<option value="'.$row_cidade->CODIGO.'">'.$row_cidade->CIDADE.'</option>';
                                    }
                                ?>
                            </select><br />    
				 
                Email: 	
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_email" placeholder="rafael@citrino.com.br" class="k-input" value="<?php echo $row->EMAIL;?>"  style="width:100%" maxlength="100">
                    </span>
                    <br>
                Site: 			
                    <span style="" class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="nova_empresa_site" placeholder="www.admcitrino.com.br" class="k-input"  value="<?php echo $row->SITE;?>"  style="width:100%" maxlength="100">
                    </span>
                    <br>
                    <br><br />
                    <input type="button" value="CANCELAR" name="nova_empresa_bt_cancelar" class="k-button">
                    <input type="button" value="SALVAR" name="nova_empresa_bt_salvar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_nova_empresa"></span>
        	<script>
			
			$('select[name="nova_empresa_cidade"]').val(<?php echo $row->CIDADE;?>);
		//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
	$('input[name="nova_empresa_bt_salvar"]').click( function(){
		
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
							upsigla:		sigla.val(),
							cnpj_:			cnpj.val(), 
							ie_:			ie.val(), 
							endereco_:		endereco.val(), 
							bairro_:		bairro.val(), 
							complemento_:	complemento.val(), 
							numero_:		numero.val(), 
							cep_:			cep.val(), 
							telefone_:		telefone.val(), 
							cidade_:		cidade.val(), 
							cidade_:		cidade.val(), 
							email_:			email.val(), 
							upsite:			site.val()
						},
					type: 'POST',
					success: function(data, textStatus) {
								$('.resultado_nova_empresa').html('<p>' + data + '</p>');
								
								limparTodos('form[name="nova_empresa"] input[type="text"]');
								razao.focus();
								setTimeout(function(){$('.resultado_nova_empresa').html('');},5000);
								$('#cadastro_empresa').load('cadastro_empresa.php');
							 },
					error: function(xhr,er) {
								$('.resultado_nova_empresa').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
								
							 }		
							 
				});						
			}
		}
	});
	
	$('input[name="nova_empresa_bt_cancelar"]').click( function(){
		$('#cadastro_empresa').load('cadastro_empresa.php');
	})
			</script>