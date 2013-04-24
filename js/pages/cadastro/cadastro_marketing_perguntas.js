//Mostra campos para cadastrar opções
	$('input[name="CMP_opcao"]').live('click',function(){
		var area	 =  $('div.CMP_opcao');
		if($('input[name="CMP_opcao"]').is(':checked')){
			area.html('<input type="text" name="CMP_checkbox" value=""><br>Digite as opções <br>separando-as por vírgula(,)');
		}else{
			area.html('');
		}
	})
	


	
	$('input[name="CMP_bt_inserir"]').click(function(e){
		e.preventDefault();
		var pergunta = $('input[name="CMP_pergunta"]');
		var checkbox = $('input[name="CMP_opcao"]');
		var opcao = '';
		
		if(pergunta.val() == ''){
			alert('Digite a pergunta!');
		}else{
			
			if(checkbox.is(':checked')){
				
				opcao = $('input[name="CMP_checkbox"]').val();
				
				if(opcao == ''){
					alert('Digite as opções da pergunta')
				}
				
			}
			
			//Inserir
			$.ajax({
					 url: "php/cadastro/marketing/perguntas/inserir_perguntas.php",
				dataType: "json",
					data: {'pergunta':pergunta.val(), 'opcao':opcao },
					type: 'POST',
			  beforeSend: function(){
				  				
				  			},
			  	 success: function(data){
					 			alert(data.texto);
								
								$.post('php/cadastro/marketing/perguntas/lista_perguntas.php',{}, function(data){$('div#CMP_right').html(data)});
								
								
					        },
				   error: function(xhr,err){ alert(xhr.status + ' - ' + err);}
			});
			
			
		}
		
	});
	




	
$('a[name="CMP_bt_excluir"]').live('click',function(e){
	e.preventDefault();
	
	var pergunta = $(this).attr('title');
	
	
	$.ajax({
			 url : 'php/cadastro/marketing/perguntas/excluir_perguntas.php',
		 dataType: "json",
			 data: {'pergunta': pergunta},
			 type: 'POST',
	   beforeSend: function(){},
		  success: function(data){ 
						alert(data.texto);
						$.post('php/cadastro/marketing/perguntas/lista_perguntas.php',{}, function(data){$('div#CMP_right').html(data)});
				   },
			error: function(xhr,err){alert(xhr.status + ' - ' + err)}
	});
	
	
});









$('a[name="CMP_bt_alterar"]').live('click',function(e){
	e.preventDefault();
	
	var pergunta = $(this).attr('title');
	
	
	$.ajax({
			 url : 'php/cadastro/marketing/perguntas/tela_alterar.php',
		 dataType: "html",
			 data: {'id': pergunta},
			 type: 'POST',
	   beforeSend: function(){},
		  success: function(data){ 
						$('div#CMP_left').html(data);
						
				   },
			error: function(xhr,err){alert(xhr.status + ' - ' + err)}
	});
	
	
});
	
