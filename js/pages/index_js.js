$(document).ready(function(){
	$('input[name="bt_logar"]').click(function(e){
		$('div#resultado').html('');
		e.preventDefault();
		var user = $('input[name="usuario"]').val();
		var pass = $('input[name="senha"]').val();
		
		if(user == '' || pass == ''){
			$('div#resultado').html('<strong>Existem campos vazios!</strong>');
		}else{
			
			$.ajax({
				url: 'php/singin_up.php', 
				dataType: 'html',
				data: { usuario: user, senha:pass},

				type: 'POST',
				success: function(data, textStatus) {
							$('#result').html(data);
						 },
				error: function(xhr,er) {
							$('#empresas').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});	
								
		}
	});
	
	$('a[name="acesso_empresa"]').live("click",function(e){
		e.preventDefault();
		alert('oi');
		
		$.ajax({
				url: 'php/acesso.php', 
				dataType: 'html',
				data: { "empresa":$('select[name="empresa_acesso"]').val()},

				type: 'POST',
				success: function(data, textStatus) {
							alert($('select[name="empresa_acesso"]').val());
							document.location.href="index.php";
						 },
				error: function(xhr,er) {
							$('#empresas').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
	});
});    
