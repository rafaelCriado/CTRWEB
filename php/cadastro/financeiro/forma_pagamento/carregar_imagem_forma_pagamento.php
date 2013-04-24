<?php 
	

		function apaga_files($name)
		{
			$dir = '../../../../img/formas_pagamento/';
			if(is_dir($dir))
			{
				if($handle = opendir($dir))
				{
					while(($file = readdir($handle)) !== false)
					{
						if($file != '.' && $file != '..')
						{
							if( $file != $name)
							{
								unlink($dir.$file);
							}
						}
					}
				}
			}
			else
			{
				die("Erro ao abrir dir: $dir");
			}
				return 0;
		}
		
		
		function img_existe($img){
			$dir = '../../../../img/formas_pagamento/';
			
			$imagem = $dir.$img;
			
			$ext = array('.gif','.bmp','.png','.jpg','.jpeg');
			
			for($x = 0; $x < count($ext); $x++){
				if(is_file($imagem.$ext[$x])){
					return true;
				}
			}
			
			return false;
			
		}
		
		function mostra_img($img){
			$dir = '../../../../img/formas_pagamento/';
			
			$imagem = $dir.$img;
			
			$ext = array('.gif','.bmp','.png','.jpg','.jpeg');
			
			for($x = 0; $x < count($ext); $x++){
				if(is_file($imagem.$ext[$x])){
					return str_replace('../../../../','',$imagem.$ext[$x]);
				}
			}
		}


		if(isset($_GET['save'])){
			// Se o usuário clicou no botão cadastrar efetua as ações
				
				 
			// Recupera os dados dos campos
			$nome = $_GET['save'];
			$foto = $_FILES["foto"];
		 
			// Se a foto estiver sido selecionada
			if (!empty($foto["name"])) {
		 
				// Largura máxima em pixels
				$largura = 150;
				// Altura máxima em pixels
				$altura = 180;
				// Tamanho máximo do arquivo em bytes
				$tamanho = 100000;
		 		
				$error = array();
				// Verifica se o arquivo é uma imagem
				if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
				   $error[1] = "Isso não é uma imagem.";
				} 
		 
				// Pega as dimensões da imagem
				$dimensoes = getimagesize($foto["tmp_name"]);
		 
				// Verifica se a largura da imagem é maior que a largura permitida
				if($dimensoes[0] > $largura) {
					$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
				}
		 
				// Verifica se a altura da imagem é maior que a altura permitida
				if($dimensoes[1] > $altura) {
					$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
				}
		 
				// Verifica se o tamanho da imagem é maior que o tamanho permitido
				if($foto["size"] > $tamanho) {
					$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
				}
		 
				// Se não houver nenhum erro
				if (count($error) == 0) {
		 
					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
		 
					// Gera um nome único para a imagem
					$nome_imagem = $nome . "." . $ext[1];
		 
					// Caminho de onde ficará a imagem
					$caminho_imagem = "../../../../img/formas_pagamento/" . $nome_imagem;
		 
					// Faz o upload da imagem para seu respectivo caminho
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		 
					
		 
				}
		 
				// Se houver mensagens de erro, exibe-as
				if (count($error) != 0) {
					foreach ($error as $erro) {
						echo $erro . "<br />";
					}
				}
			}
				

		}else if(isset($_GET['remove'])){
			apaga_files($_GET['remove']);
			?>
            <script>
				
				var codigo = $('input[name="fp_codigo_demo"]').val();
				$.ajax({ 
						 url: 'php/cadastro/financeiro/forma_pagamento/carregar_imagem_forma_pagamento.php', 
					dataType: 'html',
						type:  "GET",
						data: { id : codigo},
				  beforeSend: function(){
									$('#salvar_imagem').html(
											'<img src="img/carregando.gif" alt="Aguarde">');
								},
					 success: function(data) {
									$('#salvar_imagem').html(data);
								 },
						error: function(xhr,er) {
									$('#salvar_imagem').html(
										'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
										'<br />Tipo de erro: ' + er +'</p>')	
									}
				});
				
			</script>
            <?php
		}else{
			
			if(isset($_GET['id'])){
			
				if(img_existe($_GET['id'])){
					
					?>
                    	
                        <img src="<?php echo mostra_img($_GET['id']) ?>" />
                        <a href="#" name="bt_excluir_img_fp" class="k-button">Excluir</a> 
                        <script>
							$('a[name="bt_excluir_img_fp"]').click(function(e){
								e.preventDefault();
								var codigo = $('input[name="fp_codigo_demo"]').val();
								$.ajax({ 
										 url: 'php/cadastro/financeiro/forma_pagamento/carregar_imagem_forma_pagamento.php', 
									dataType: 'html',
										type:  "GET",
										data: { remove: codigo},
								  beforeSend: function(){
													$('#salvar_imagem').html(
															'<img src="img/carregando.gif" alt="Aguarde">');
												},
									 success: function(data) {
													$('#salvar_imagem').html(data);
												 },
										error: function(xhr,er) {
													$('#salvar_imagem').html(
														'<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + 
														'<br />Tipo de erro: ' + er +'</p>')	
													}
								});
							})
                        </script>
                    <?php
					
				}else{
					?>   
					<style>
						#salvar_imagem{ height:100%; width:100%; margin:0px; padding:0px;}
					</style>
					
						<div style="height:100%; width:100%; margin:0px; padding:0px;" >
							<div class="demo-section">
								<input name="foto" id="files" type="file" />
							</div>
						</div>
						
						<script>
							$(document).ready(function() {
								var codigo = $('input[name="fp_codigo_demo"]').val();
								$("#files").kendoUpload({
									async: {
										upload: onUpload,
										saveUrl: "php/cadastro/financeiro/forma_pagamento/carregar_imagem_forma_pagamento.php?save="+codigo,
										removeUrl: "php/cadastro/financeiro/forma_pagamento/carregar_imagem_forma_pagamento.php?remove="+codigo,
										autoUpload: true,
										
									}
								});
								
								
								function onUpload(e) {
									// Array with information about the uploaded files
									var files = e.files;
								
									// Check the extension of each file and abort the upload if it is not .jpg
									$.each(files, function() {
										if (this.extension != ".jpg") {
											alert("Only .jpg files can be uploaded")
											e.preventDefault();
										}
									});
								}
								
							});
						</script>
	<?php }}}?>