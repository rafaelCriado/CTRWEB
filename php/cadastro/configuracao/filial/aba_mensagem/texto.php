<style>
	textarea.ccf_af_texto{ width:98%; margin:2px; float:left; }
	input[name="ccf_af_bt_salvar"]{ float:left}
</style>
<?php
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../../classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../../functions.php');
		
		//Inclui banco de dados
		include('../../../../classes/bd_oracle.class.php');
	}

	if(!isset($_POST['empresa'])){
		?>
        
        	<textarea rows="15" name="ccf_af_texto" class="ccf_af_texto"></textarea>
        	<input type="button" value="Salvar" name="ccf_af_bt_salvar" class="k-button">
        
        
		<?php
		
	}else{
		$tipo = $_POST['tipo'];
		$empresa = $_POST['empresa'];
		
		
		
		switch($tipo){
			
			//SEM AREA DE ATUACAO
			case 1:
				if($empresa != 0)$sql = 'SELECT MSG1 AS TEXTO FROM EMPRESA WHERE EMPCOD = '.$empresa;
				if($empresa == 0)$sql = 'SELECT MSG1 AS TEXTO FROM EMPRESA WHERE EMPCOD = '.$empresa;
				break;
				
		}
		
		
		$query = oci_parse($conecta,$sql);
		if(oci_execute($query)){
			$row = oci_fetch_object($query);
		}
		?>
        	
        	<textarea rows="15" name="ccf_af_texto" class="ccf_af_texto"><?php echo isset($row->TEXTO)?trim($row->TEXTO):''; ?></textarea>
        	<input type="button" value="Salvar" name="ccf_af_bt_salvar" class="k-button"><span class="ccf_af_resposta"></span>
        
        
		<?php
		
	}
	
?>
<script type="text/javascript">

	var carrego_texto = function(tipo_texto,empresa){
		
		$.post(
			'php/cadastro/configuracao/filial/aba_mensagem/texto.php',
			{'empresa': empresa, 'tipo': tipo_texto},
			function(data){
				$('div#ccf_af .right').html(data)
			}
		);
		
	}


	var seleciona_tipo_mensagem = function(){
		
		var campo = $('select[name="ccf_af_tipo_mensagem"]');
		
		campo.change(function(e) {
            
			if(campo.val() != ''){
			
				var empresa_selecionada = $('select[name="ccf_af_empresa"]').val();
				
				if(empresa_selecionada != ''){
					
					carrego_texto(campo.val(),empresa_selecionada);
				
				}
			}
			
        });
		
	}
	seleciona_tipo_mensagem();
	
	
	var seleciona_empresa = function(){
		var empresa = $('select[name="ccf_af_empresa"]');
		
		empresa.change(function(){
			
			if(empresa.val() != ''){
				
				var tipo_texto = $('select[name="ccf_af_tipo_mensagem"]').val();
				
				if(tipo_texto != ''){
					
					carrego_texto(tipo_texto,empresa.val());
					
				}
				
			}
			
		})
	}
	seleciona_empresa();
	
	
	var bt_salvar = function(){
		var bt = $('input:button[name="ccf_af_bt_salvar"]');
		
		bt.click(function(e) {
            e.preventDefault();
			
			var empresa =  $('select[name="ccf_af_empresa"]').val();
			var tipo	=  $('select[name="ccf_af_tipo_mensagem"]').val();
			var texto	=  $('textarea[name="ccf_af_texto"]').val();
			
			var a=0;
			
			if(empresa == '')a= a+4;
			if(tipo == '')a= a+2;
			if(texto == '')a= a+1;
			
			
			switch(a){
				case 0:
					grava_texto(empresa,tipo,texto);
					break;
				case 1:
					alert('Escreva a mensagem!');
					break;		
				case 2:
					alert('Selecione o tipo de mensagem!');
					break;
				case 3:
					alert('Selecione o tipo de mensagem e escreva um texto!');
					break;		
				case 4:
					alert('Selecione a filial!');
					break;
				case 5:
					alert('Selecione a filial e escreva a mensagem!');
					break;
				case 6:
					alert('Selecione a filial e um tipo de texto');
					break;
				case 7:
					alert('Para gravar uma mensagem, você deve selecionar uma filial, um tipo de mensagem e escrever um texto!');
					break;
				default:
					break;
			}
			
        });
	}
	bt_salvar();
	
	var grava_texto= function(empresa,tipo,texto){
		$.ajax({
			   url: 'php/cadastro/configuracao/filial/aba_mensagem/grava_mensagem.php', 
		  dataType: 'json',
		  	  type: 'POST',
			  data: { 'empresa': empresa, 'tipo': tipo, 'texto':texto },
		beforeSend: function(){
						$('span.ccf_af_resposta').html('&nbsp;&nbsp;&nbsp;Aguarde...');
					},
		   success: function(data) {
			   			$('span.ccf_af_resposta').html(data.texto);
						if(data.codigo == 1){
							carrego_texto(tipo,empresa);
						}
					 },
			 error: function(xhr,er) {
						$('span.ccf_af_resposta').html(
								'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
								'<br />Tipo de erro: ' + er +'</p>')	
					}		
		});
	}
</script>