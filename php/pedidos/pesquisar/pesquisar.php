<?php
if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../functions.php');
		
		//Inclui banco de dados
		include('../../classes/bd_oracle.class.php');
	}
	//include("php/classes/bd_oracle.class.php");
	//include("php/classes/session.class.php");
	$sessao = new Session();
?>
<html>
	<head>
    	<meta charset="utf-8" />
        
        <style>
			.tr_selecionada{ background:#09C; color:#fff;} 

			#pedido_orcamento_pesquisar{ margin:0px; padding:0px;}
			div#pedOrc_principal{ height:100%; width: 100%; margin:0px; padding:0px; background:#E4E4E4}
			div#pedOrc_principal div.line1{ width:100%; height:50px; display:block;}
			div#pedOrc_principal div.line1 div.emissao{ width:200px; border:0px solid red; float:left; height:inherit}
			div#pedOrc_principal div.line1 div.emissao fieldset{ padding:2px;} 
			div#pedOrc_principal div.line1 div.emissao legend{ font-size:11px; font-weight:bold; padding:0px; margin:0px; } 
			div#pedOrc_principal div.line1 div.emissao input{ width:70px;}
			
			
			div#pedOrc_principal div.line1 div.exibir{ width:320px; border:0px solid red; float:left; height:60px}
			div#pedOrc_principal div.line1 div.exibir fieldset{ padding:5px;} 
			div#pedOrc_principal div.line1 div.exibir legend{ font-size:11px; font-weight:bold; padding:0px; margin:0px; } 
			div#pedOrc_principal div.line1 div.exibir input{ width:auto;}
			
			
			
			div#pedOrc_principal div.line2{ width:856px; height:180px; display:block; border:1px solid #A0A0A0; margin:2px; overflow:auto; padding:0; }
			div#pedOrc_principal div.line2 table{ width:100%; margin:0px; padding:0px; text-align:left }

			div#pedOrc_principal div.line3{ width:856px; height:180px; display:block; border:1px solid #A0A0A0; margin:10px 2px; overflow:auto; padding:0; }
			div#pedOrc_principal div.line3 table{ width:100%; margin:0px; padding:0px; text-align:left }
			
        </style>
        
        <script type="text/javascript">
			$(document).ready(function(e) {
				//MASCARA NO CAMPO DATA DE EMISSAO
				$('input[name="pedOrc_emissao_ini"],input[name="pedOrc_emissao_fim"]').keypress(function(e) {
					
					var entradaNAS = $(this).val().length;
		
					if(entradaNAS == 2){
						$(this).val($(this).val() + '/');
					}
					if(entradaNAS == 5){
						$(this).val($(this).val() + '/');
					}
				});
				
				
				var carrega_emissao = function(inicio,fim){
					if(inicio != '' && fim != ''){
						$.post(
							'php/pedidos/pesquisar/pesquisar.php',
							
							{ filtro: '4|'+ inicio + '|' + fim},
							
							function(data){
								$('div#pedido_orcamento_pesquisar').html(data);		
							}
						);
					}else{
						alert('Variaveis vazias');
					}
}
				
				
				$('input[name="pedOrc_emissao_fim"]').keydown(function(e){
					var entrada = $(this).val().length;
					setTimeout(function(){
						if(entrada == 9){
							var fim = $('input[name="pedOrc_emissao_fim"]').val();
							var ini = $('input[name="pedOrc_emissao_ini"]').val();
							
							if(ini.length != 10){
								alert('Preencha o campo data inicio!');
							}else{
								carrega_emissao(ini,fim);
							}
						}
					},200);
				});
				
				$('input[name="pedOrc_emissao_ini"]').keydown(function(e){
					var entrada = $(this).val().length;
					setTimeout(function(){
						if(entrada == 9){
							var fim = $('input[name="pedOrc_emissao_fim"]').val();
							var ini = $('input[name="pedOrc_emissao_ini"]').val();
							
							if(fim.length == 10){
								carrega_emissao(ini,fim);
							}
						}
					},200);
				});
				
				
				var seleciona_linha = function(tabela){
					$(tabela).live('click',function(e){
							var id = $(this).attr('id');
							$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
							$('tr[id="'+id+'"], tr[id="'+id+'"] td').addClass('tr_selecionada');
					});
				}
				
				
				
				var itens_orcamento = function(tabela){
					$(tabela).live('click',function(e){
							var id = $(this).attr('id');
							
							if(!isNaN(id)){
								
								$.ajax({
									url: 'php/pedidos/pesquisar/itens_orcamento.php', 
									dataType: 'html',
									data: { numero: id },
									type: 'POST',
									success: function(data) {
												$('div#pedOrc_itens').html(data);
											 },
									error: function(xhr,er) {
												alert('Falha de requisição, Tente Novamente!');
											 }		
								});	
								
							}
					});
				}
				
				var seleciona_orcamento = function(){
					$('.line2 table tr').live('dblclick',function(){
							
							var id = $(this).attr('id');
							var tela_retorno = $('input[name="orcamento_pesquisa_tela_retorno"]').val();
						
						if(id != ''){

							
							
							$.ajax({
								url: 'php/requisitions/orcamento.ajax.php', 
								dataType: 'json',
								data: { "codigo": id},
								type: 'POST',
								success: function(data) {
											
											// ============================= FECHA TELA ==========================================
											$('#pedido_orcamento_pesquisar').parent().closest('div').css({display:'none'});
											// ===================================================================================
											
											
											var numero = data.NUMERO;
											var img	   = '<img src="img/aguarde.gif">';
											
											
											
											if($('div#tabstrip_pedido_orcamento').is(':visible')){
												$('#tabstrip_pedido_orcamento ul li:eq(3)').click();  
											}else{
												$('a[name="pedido_orcamento"]').click();
												
												setTimeout(function(){$('#tabstrip_pedido_orcamento ul li:eq(3)').click()},2000); 
											}
											
											if($('div#tabstrip_pedido_orcamento').length){
													$('#tabstrip_pedido_orcamento ul li:eq(3)').click();  
                                            
											}else{
												
												$('a[name="pedido_orcamento"]').click();
												
												setTimeout(function(){$('#tabstrip_pedido_orcamento ul li:eq(3)').click()},2000);  
                                                
											}
											
											
											$.ajax({
												url: 'modulos/riolax/pedido/orcamento/PHP/tela_pesquisa.php', 
												dataType: 'html',
												data: { 'orcamento': numero },
												type: 'POST',
												beforeSend: function(){
													$('div#po_aba_quatro').html(img);
												},
												success: function(data){
																
																$('div#po_aba_quatro').html(data);
															}
											})
											
											$('input[name="tipo_pesquisa_produto_tela_retorno"]').val('0');
											
										 },
										 
								error: function(xhr,er) {
											$('#entidade').html(xhr+er);
												
										 }
							});



						}
					});
				}
				
				
				
				var bt_radio = function(){
					var radio = $('input[name="pedOrc_exibir_tipo"]');
					
					
					
					radio.click(function(){
						
						var valor = '';	
						$('input[name="pedOrc_exibir_tipo"]').each(function(){
							if($(this).is(':checked')){
								valor = parseInt($(this).val());		
							}
						});
						
						
						
						
						switch(valor){
							case 0:
								$.post(
									'php/pedidos/pesquisar/pesquisar.php',
									{ filtro: '0|ALL'},
									function(data){
										$('div#pedido_orcamento_pesquisar').html(data);		
									}
								);
								break;
							
							
							//Pesquisa por cliente
							case 3: 
								$('a[name="cadastro_entidade_pesquisa_pessoa"]').click();
								setTimeout(function(){
									$('input[name="tipo_pesquisa_tela_retorno"]').val('pedido_orcamento_pesquisar|CODIGO:pop_codigo_cliente')}
									,2000);
									
									
									setInterval(function(){
										var cliente = $('input[name="pop_codigo_cliente"]').val();
										if(cliente != ''){
											$.post(
												'php/pedidos/pesquisar/pesquisar.php',
												{ filtro: '1|'+ cliente},
												function(data){
													$('div#pedido_orcamento_pesquisar').html(data);	
													
												}
											)
										}
									},500);
									
									
								break;
							
							
						}
					});
				}
				
				
				
				//Eventos
				seleciona_orcamento();
				itens_orcamento('.line2 table tr');
				seleciona_linha('.line2 table tr');
				bt_radio();
				
				
			});
		</script>

    </head>
    
    <body>
    	<div id="pedOrc_principal">
        
        	<div class="line1">
                
                <div class="emissao">
                    <fieldset>
                        <legend>Emissão: </legend>
                        <input type="text" name="pedOrc_emissao_ini" />
                        &nbsp;&nbsp; a &nbsp;&nbsp;
                        <input type="text" name="pedOrc_emissao_fim" />
                    </fieldset>
                </div>
                
                <div class="exibir">
                	<fieldset>
                    	<legend>Exibir</legend>
                        <input type="radio" name="pedOrc_exibir_tipo" value="0" />Todos 
                        <input type="radio" name="pedOrc_exibir_tipo" value="1" />Orçamentos
                        <!--<input type="radio" name="pedOrc_exibir_tipo" value="2" />Pedidos-->
                        <input type="radio" name="pedOrc_exibir_tipo" value="3" />Clientes
                        <input type="hidden" name="pop_codigo_cliente" value="">
                    </fieldset>
                </div>
                
                
                
            </div>
            
            
            <div class="line2">
                <table cellpadding="0" cellspacing="0">
                	<tr class="k-header">	
                    	<td width="30px">P/O</td>
                    	<td width="60px">Número</td>
                    	<td>Cliente</td>
                    	<td width="60px">Vend.</td>
                    	<td width="70px">Emissão</td>
                    	<td width="70px">Entrega</td>
                    	<td width="70px">Total</td>
                    	<td width="45px">Obs.</td>
                    	<td width="70px">Usuário</td>
                    </tr>
                    
 <?php
 						
 						$filtro = '';	
 						if(isset($_POST['filtro'])){
							
							$ft = explode('|',$_POST['filtro']);
							
							switch($ft[0]){
								//Filtra todos
								case 0:
									$filtro = '';
									?>
										<script>
                                            $('input[name="pedOrc_exibir_tipo"]:eq(0)').attr('checked','checked');
                                        </script>
									<?php
									break;
								
								
								//FILTRO CLIENTE
								case 1: 
									if(isset($ft[1]) and !empty($ft[1]) and $ft[1] != 'undefined'){
										$filtro = '';
										$filtro = ' AND O.ENTCOD = '.$ft[1];
										?>
                                        	<script>
												$('input[name="pedOrc_exibir_tipo"]:eq(2)').attr('checked','checked');
                                            </script>
										<?php
									}else{
										$filtro = '';
									}
								
								case 4:
									if($ft[0] == 4){
										$inicio = dataNascimento($ft[1]);
										$fim 	= dataNascimento($ft[2]);
										$filtro = '';
										$filtro = " AND O.ORCDAT BETWEEN '".$inicio."' AND '". $fim."'";
										
										?>
                                        	<script>
												$('input[name="pedOrc_emissao_ini"]').val('<?php echo $ft[1];?>');
												$('input[name="pedOrc_emissao_fim"]').val('<?php echo $ft[2];?>');
                                            </script>
										<?php
									}
									break;	
								
							}
						}else{
							$filtro = '';
						}
 							
 						
						//Verifica pedidos existentes
						$sql_orcamentos = 'SELECT O.ORCCOD AS NUMERO,
												   O.ORCDATCAD AS EMISSAO,
												   O.ORCDAT AS DATA_ORCAMENTO,
												   O.ENTCOD AS CLIENTE_CODIGO,
												   E.ENTNOM AS CLIENTE_NOME,
												   O.ORCDATVAL AS DATA_FINAL,
												   O.ORCPRAENT AS PRAZO_ENTREGA,
												   O.CONPAGCOD AS CONDICAO_PAGAMENTO,
												   O.ORCPERDES1 AS DESCONTO,
												   O.ORCVALFRE AS FRETE,
												   O.ORCVALTOT AS TOTAL,
												   O.USUCOD AS USUARIO,
												   O.ORCOBS AS OBSERVACAO,
												   O.ORCSTA AS STATUS
											  FROM ORCAMENTO O, ENTIDADE E
											 WHERE O.ENTCOD = E.ENTCOD
											   AND O.EMPCOD = '.$sessao->getNode('empresa_acessada'). $filtro;
										
											   
						//echo $sql_orcamentos;
						//Prepara
						$query_orcamentos = oci_parse($conecta,$sql_orcamentos);
						
						//Executa
						if(oci_execute($query_orcamentos)){
							$cont = 0;
							while($orcamento = oci_fetch_object($query_orcamentos)){
								?>
                                    <tr id="<?php echo $orcamento->NUMERO?>">	
                                    	<td><?php echo 'O';?></td>
                                    	<td><?php echo $orcamento->NUMERO; ?></td>
                                    	<td><?php echo $orcamento->CLIENTE_NOME; ?></td>
                                    	<td><?php echo $orcamento->USUARIO; ?></td>
                                    	<td><?php echo $orcamento->EMISSAO; ?></td>
                                    	<td><?php echo $orcamento->PRAZO_ENTREGA; ?></td>
                                    	<td><?php echo $orcamento->TOTAL; ?></td>
                                    	<td><?php echo $orcamento->OBSERVACAO; ?></td>
                                    	<td><?php echo $orcamento->USUARIO; ?></td>
                                    </tr>
								<?php
								$cont++;
							}
							
							if($cont < 10){
								$diferenca = 10-$cont ;
								for($x =0; $x<$diferenca; $x++){
									?>
									<tr style="background:#fff">	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>						
									<?php
								}
							}
							
							
						}
						
					?>                    
                    
                    
                </table>
            </div>
            
            <div class="line3">
                <div id="pedOrc_itens">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="k-header">	
                            <td width="60px">Produto</td>
                            <td>Descricao</td>
                            <td width="60px">Qtde.</td>
                            <td width="70px">Pc. Unitário</td>
                            <td width="70px">Pc. Total</td>
                        </tr>
                        <?php
						for($x =0; $x<10; $x++){
							?>
							<tr style="background:#fff">	
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>						
							<?php
						}
						?>
                        
                    </table>           		 
                </div>
            </div>
            
            
        </div>
        
        
        <!-- Variavel de consultas-->
        <input type="hidden" name="orcamento_pesquisa_tela_retorno" value="0">
        
    </body>
</html>