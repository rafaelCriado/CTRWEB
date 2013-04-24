
$(document).ready(function(){
 
	
	$('input[name="usuario"]').focus();
	
	// EVENTO DO BOTÃO LOGAR =================================================================================
	$('input[name="bt_logar"]').live("click",function(e){
		e.preventDefault();
		
		var user = $('input[name="usuario"]').val();
		var pass = $('input[name="senha"]').val();
		
		if(user == '' || pass == ''){
			
			$('div#resultado').html('<strong>Existem campos vazios!</strong>');
			$('input:eq(0)').focus();
		}else{
			
			$.ajax({
				url: 'php/singin_up.php', 
				dataType: 'json',
				data: { usuario: user, senha:pass},

				type: 'POST',
				success: function(data) {
							
							if(data.retorno == 0){
								$('#resultado').html(data.msg);
							}else{
								$('#resultado').html('')
								$('#result span').html(data.msg);
								
								$('select').focus();
							}
						 },
				error: function(xhr,er) {
							$('#result').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});	
								
		}
	});
	// ========================================================================================================
	
	// EVENTO DO BOTÃO ACESSAR ================================================================================
	$('input[name="acesso_empresa"]').live("click",function(e){
		e.preventDefault();
		
		$.ajax({
				url: 'php/acesso.php', 
				dataType: 'html',
				data: { "empresa":$('select[name="empresa_acesso"]').val()},

				type: 'GET',
				success: function(data, textStatus) {
							document.location.href="index.php";
							
						 },
				error: function(xhr,er) {
							$('#empresas').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
	});
	// ========================================================================================================

	//Coloca todos os inputs em caixa alta.====================================================================
	$("input[type!='submit']").live("keyup",function(){
		$(this).val($(this).val().toUpperCase());
	});
	//=========================================================================================================

	// EFEITO ENTER ================================
	$('input[type!="submit"],select').live("keypress", function(e){
		
		/*
		 * verifica se o evento é Keycode (para IE e outros browsers)
		 * se não for pega o evento Which (Firefox)
		*/
	   var tecla = (e.keyCode?e.keyCode:e.which);
		
	   /* verifica se a tecla pressionada foi o ENTER */
	   if(tecla == 13){
		   e.preventDefault();
		   if($(this).attr('name') == 'empresa_acesso'){
			   $('input[type="submit"]').focus();
		   }else{
			   if($(this).attr('name') == 'senha'){
			   		$('input[name="bt_logar"]').click();
			   }
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
   		}
	});
	// =============================================




}); 