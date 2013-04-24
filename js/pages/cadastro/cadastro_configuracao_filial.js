
$("#abas_configuracao_filial").kendoTabStrip({
	animation:	{
		open: {
			effects: "fadeIn"
		}
	}

});


var seleciona_filial = function(){
	var seletor = $('select[name="faa_empresa"]');
	
	seletor.change(function(){
		if(seletor.val() != ''){
			$.post(
				'php/cadastro/configuracao/filial/lista_cidades_vinculadas.php',
				{ id : seletor.val() },
				function(data){
					$('div#recebe_vinculados').html(data);
				}
			);
		}
	});
}
seleciona_filial();













	//Popula as cidades de acordo com o estado
	$('select[name="fav_estado"]').live("change", function(){
		if( $(this).val() ) {
			$('select[name="fav_cidade"]').hide();
			//$('.carregando').show();
			$.getJSON('php/requisitions/cidades.ajax.php?search=',{entidade_estado: $(this).val(), ajax: 'true'}, function(j){
				var options = '';	
				for (var i = 0; i < j.length; i++) {
					options += '<option title="'+j[i].titulo +'" value="' + j[i].entidade_cidade + '">' + j[i].nome + '</option>';
				}	
				$('select[name="fav_cidade"]').html(options).show();
				//$('.carregando').hide();
			});
		} else {
			$('select[name="fav_cidade"]').html('<option value="">Escolha um estado</option>');
		}
	});






var estado_insert = function(){
	
	var  filial = $('select[name="faa_empresa"]').val();
	$.post('php/cadastro/configuracao/filial/lista_cidades_vinculadas.php',{'id':filial},function(data){$('div#recebe_vinculados').html(data)});
	
}




var bt_salvar = function(){
	var bt = $('input[name="fav_button"]');
	
	bt.click(function(e){
		e.preventDefault();
	
		var filial = $('select[name="faa_empresa"]').val();
		var cidade = $('select[name="fav_cidade"]').val();
		
		
		if(filial == ''){
			alert('Escolha uma filial inicialmente!');
		}else{
			
			if(cidade == ''){
				alert('Escolha a cidade que deseja vincular');
			}else{
				$.post(
					'php/cadastro/configuracao/filial/vincula_area_atuacao.php',
					{ 
						'cidade' : cidade, 
						'filial' : filial 
					},
					
					function(data){
						alert(data[0].mensagem);
						estado_insert();
					}
				);
				
			}
			
		}
		
	})
	
}

bt_salvar();



$('a[name="lcv_bt_excluir"]').live('click',function(e) {
		
        e.preventDefault();
		
		var cidade = $('a[name="lcv_bt_excluir"]').attr('title');
		var filial = $('select[name="faa_empresa"]').val();
		
		if(cidade != '' && filial != ''){
			
			$.post(
					'php/cadastro/configuracao/filial/desvincula_area_atuacao.php',
					{ 
						'cidade' : cidade, 
						'filial' : filial 
					},
					
					function(data){
						alert(data[0].mensagem);
						estado_insert();
					}
				);
			
			
		}
		
    });