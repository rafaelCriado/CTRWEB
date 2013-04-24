<script>
	    $("#datepicker").kendoDatePicker({
			culture: "pt-BR",
			value: new Date()
		});
</script>
<?php 
	
	error_reporting(0);
	include('../../../../../php/classes/bd_oracle.class.php');
	include('../../../../../php/classes/session.class.php');
	
	$sessao = new Session();

	//Informações do cliente
	$sql_cliente = 'SELECT E.ENTCOD    AS CODIGO,
       E.ENTNOM    AS NOME,
       E.ENTNOMFAN AS FANTASIA,
       E.ENTEND    AS ENDERECO,
       ENTNUM      AS NUMERO,
       ENTBAI      AS BAIRRO,
       ENTCEP      AS CEP,
       C.CIDNOM    AS CIDADE,
       U.UFABREV   AS ESTADO,
	   TRUNC(SYSDATE) AS DATA
  FROM ENTIDADE E, CIDADE C, UF U
 WHERE E.CIDCOD = C.CIDCOD
   AND C.CIDUFCOD = U.UFCOD AND E.ENTCOD = '. $_POST['cliente'];
	
	//Prepara
	$query_cliente = oci_parse($conecta, $sql_cliente);
	
	//Executa
	oci_execute($query_cliente);
	
	$cliente = oci_fetch_object($query_cliente);
	
	//Categoria e Sub Categoria
	$sql_categoria = 'SELECT PG.PROGRUCOD    AS C_GRUPO,
       PG.PROGRUDEN    AS CATEGORIA,
       PS.PROSUBGRUCOD AS S_CODIGO,
       PS.PROSUBGRUDEN AS MODELO
  FROM PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS
 WHERE PS.PROGRUCOD = PG.PROGRUCOD AND PG.PROGRUCOD = '.$_POST['categoria'].' AND PS.PROSUBGRUCOD = '.$_POST['modelo'];
	
	$query_categoria = oci_parse($conecta,$sql_categoria);
	
	oci_execute($query_categoria);
	
	$caracteristica = oci_fetch_object($query_categoria);
	
	//var_dump($_SESSION);
	
	//Finalizar orçamento
	
	
?>
	<style>
		#po_aba_tres{ margin:0px; padding:0px; width:100%}
		#pedido_orcamento_aba_tres{ padding:0px; margin:0px; }
    </style>
	<div style="height:100%; display:block; overflow:auto;  width:100%; margin:0px -5px; padding:0px; color:#6A6A6A; line-height:25px;"; id="orcamento_tela_finalizar" >
    
    	<h3 style="margin:2px">Finalizar Orçamento</h3>
    	
        
        <input type="hidden" name="orc_cliente" 	value="<?php echo $cliente->CODIGO; 	?>" />
        <input type="hidden" name="orc_data" 		value="<?php echo $cliente->DATA; 		?>" />
        <input type="hidden" name="orc_usuario" 	value="<?php echo $sessao->getNode('usuario_citrino');?>" />
        <input type="hidden" name="orc_categoria" 	value="<?php echo $_POST['categoria']; 	?>" />
        <input type="hidden" name="orc_modelo" 		value="<?php echo $_POST['modelo']; 	?>" />
        <input type="hidden" name="orc_medida" 		value="<?php echo $_POST['medida']; 	?>" />
        <input type="hidden" name="orc_linha" 		value="<?php echo $_POST['linha']; 		?>" />
        <input type="hidden" name="orc_acabamento" 	value="<?php echo $_POST['acabamento']; ?>" />
        <input type="hidden" name="orc_cores" 		value="<?php echo $_POST['cores']; 		?>" />
        <input type="hidden" name="orc_posicao" 	value="<?php echo $_POST['posicao']; 	?>" />
        <input type="hidden" name="orc_voltagem" 	value="<?php echo $_POST['voltagem']; 	?>" />
        <input type="hidden" name="orc_fechamento" 	value="<?php echo $_POST['fechamento']; ?>" />
        
        <table width="100%">
        	<tr>
            	<td colspan="5" class="k-header" style="color:#6A6A6A"><strong>Informações Básicas</strong></td>
            </tr>
            <tr>
            	<td>Cliente: <br /><?php echo ' <strong>' . $cliente->CODIGO . ' - ' . $cliente->NOME .  '</strong>'; ?></td>
            	<td>Usuário: <br />
					<?php  //var_dump($_SESSION);
						//Pesquisa vendedores
						echo $sessao->getNode('usuario');
					?>
                </td>
                <td>
                	Previsão de Venda: 
                    <br />
                    
                    <select name="orc_prev_venda">
                    	<option value="">Escolha...</option>
                    	<option value="curto">Curto</option>
                    	<option value="medio">Médio</option>
                    	<option value="longo">Longo</option>
                    </select>
                </td>
            	<td>Data: <br /><?php echo ' <strong> ' . $cliente->DATA .  ' </strong>'; ?></td>
            	<td>Data Final: <br /><input id="datepicker" type="text" name="orc_data_final"   /></td>
            </tr>
            <tr>
            	<td>Endereço:</td>
                <td colspan="4"><?php echo ' <strong>' . $cliente->ENDERECO.  ', '. $cliente->NUMERO . ', ' . $cliente->BAIRRO . ' - ' .$cliente->CIDADE.  ' - ' .$cliente->ESTADO. '</strong>';?></td>
            </tr>
            <tr>
            	<td>
                	Prazo de Entrega (em dias)
                    <input type="text" name="orc_prazo_entrega" value="" size="2" />
				</td>
            	<td colspan="2">
                	Valor Frete
                    R$<input type="text" name="orc_valor_frete" value="0" size="5"/>
				</td>
                <td colspan="2">
                	Valor Adicional: R$<input type="text" name="orc_valor_adicional" value="0" size="5" />
                </td>
            </tr>
        </table>
        
		
        
        <?php 
			//Pesquisa produto
			$sql_produto = "SELECT P.PROCOD CODIGO,
									   P.PROCODALT CODIGO_ALTERNATIVO,
									   P.PRODES DESCRICAO,
									   TP.TABPRECOD TABELA_PRECO_CODIGO,
									   TP.TABPREDEN AS TABELA_PRECO,
									   TO_CHAR((TPI.TABPREITEVAL), '999999999999.99') AS PRECO_VENDA,
									   TO_CHAR((P.PROVALCUS * E.EMPINDVALMIN),'999999999999999.99') AS PRECO_MINIMO,
									   TO_CHAR(((TPI.TABPREITEVAL/100)-(P.PROVALCUS * E.EMPINDVALMIN)),'99999999999.99') AS LUCRO
								  FROM PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS, EMPRESA E,TABELA_PRECO TP, TABELA_PRECO_ITEM TPI
								 WHERE P.PROGRUCOD = PG.PROGRUCOD
								   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD
								   AND P.EMPCOD = E.EMPCOD
								   AND P.PROCOD = TPI.PROCOD
   								   AND TPI.TABPRECOD = TP.TABPRECOD
								   AND PG.PROGRUDEN = '".$caracteristica->CATEGORIA."'
								   AND PS.PROSUBGRUDEN = '".$caracteristica->MODELO."'
								   AND (P.PROCOM || 'x' || P.PROLAR || 'x' || P.PROALT) = '".$_POST['medida']."'
								   AND P.PROCAR1 = '".$_POST['linha']."'
								   AND P.PROMAT = '".$_POST['acabamento']."'
								   AND UPPER(P.PROCOR) = '".$_POST['cores']."'
								   AND P.PROCAR2 = '".$_POST['posicao']."'
								   AND P.PROCAR3 = '".$_POST['voltagem']."'
								   AND TP.TABPRECOD = 1";
								   
		   $query_produto = oci_parse($conecta,$sql_produto);
		   oci_execute($query_produto);
		   
		   $info_produto = oci_fetch_object($query_produto);
		   
		   $preco_venda = $info_produto->PRECO_VENDA;
		   
		   
		   //CONFIGURAÇÃO DE START
				
				$sql_start 		= 'SELECT  CE.CONPAGCOD AS CODICO_CONDICAO,
										   F.FINNOM,
										   CP.CONPAGDEN AS NOME,
										   FP.FINPARIND AS INDICE
									  FROM CONFIG_EMPRESA       CE,
										   COND_PAG             CP,
										   FINANCEIRAS          F,
										   FINANCEIRAS_PARCELAS FP
									 WHERE CE.CONPAGCOD = CP.CONPAGCOD
									   AND CP.FINCOD = F.FINCOD
									   AND F.FINCOD = FP.FINCOD
									   AND FP.FINPARCAR = CP.FINPARCAR
									   AND FP.FINPARNUM = CP.CONPAGQTDPAR AND CE.EMPCOD = '. $sessao->getNode('empresa_acessada');	
				$query_start	= oci_parse($conecta,$sql_start);
				
				if(oci_execute($query_start)){
					$start = oci_fetch_object($query_start);	
					
					$preco_venda += ($preco_venda*$start->INDICE)/100;
					
					
				}
				
				function calculo_juros($valor,$indice){
					if(isset($indice) and !empty($indice)){
						return $valor += ($valor*$indice)/100;
					}
					return $valor;
				}
				
				
		  //=====================================================
		   
		   
		   
		   
		   
		?>
        
        
        <table width="100%">
        	<tr>
            	<td colspan="8" class="k-header" style="color:#6A6A6A">
                	<strong>Características</strong>
               	</td>
         	</tr>
        	<tr>
            	<td>Descrição: </td>
                <td colspan="7"><?php echo $info_produto->DESCRICAO?></td>
            </tr>
            <tr>
            	<td>Categoria</td>
            	<td>Modelo</td>
            	<td>Medida</td>
            	<td>Linha</td>
            	<td>Acabamento</td>
            	<td>Cores</td>
            	<td>Posição</td>
                <td>Voltagem</td>
            </tr>
            <tr>
            	<td><?php echo ' <strong>'.$caracteristica->CATEGORIA.'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$caracteristica->MODELO.'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$_POST['medida'].'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$_POST['linha'].'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$_POST['acabamento'].'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$_POST['cores'].'</strong>'; ?></td>
            	<td><?php echo ' <strong>'.$_POST['posicao'].'</strong>'; ?></td>
                <td><?php echo ' <strong>'.$_POST['voltagem'].'</strong>'; ?></td>
            </tr>
            <tr style="font-size:13px;">
            	<td colspan="6"></td>
            	<td><strong>Valor:</strong></td>
            	<td>R$ <?php echo number_format($preco_venda,2,',','.');?></td>
                <input type="hidden" name="orc_preco_venda" value="<?php echo $preco_venda;?>" />
            </tr>
        </table>
        
        <table width="100%" height="100px" style="overflow:auto;"> 
        	<tr>
            	<td colspan="5" class="k-header" style="color:#6A6A6A">
                	<strong>Opcionais</strong>
             	</td>
            </tr>
            <tr>
            	<td>Item</td>
                <td>Codigo</td>
                <td>Descrição</td>
               
                <td>Valor</td>
            </tr>
            <?php 
				function valorPreco($valor){
					
					$tamanho =strlen($valor);
					$retorno = '';
					
					
					for($x = 0; $x<= $tamanho; $x++){
						$retorno .= $valor[$x];
						if(($tamanho - $x) == 6 ){
							$retorno .= '.';
						}
						if(($tamanho - $x) == 3 ){
							$retorno .= ',';
						}
					}
					
					return $retorno;
					
				}			
			
				//Pesquisa fechamentos
				if(isset($_POST['fechamento'])){
					
					$fechamento = explode(',',$_POST['fechamento']);
					
					$total_item = 0;
					
					for($x = 0; $x< count($fechamento); $x++){
						$y = $x + 1;
						$produto = explode('|',$fechamento[$x]);
						
						
						$sql_fechamentos = 'SELECT P.PROCOD         AS CODIGO,
												   P.PRODES         AS DESCRICAO,
												   TPI.TABPREITEVAL AS VALOR,
												   TP.TABPREDEN     AS TABELA
											  FROM PRODUTO P, TABELA_PRECO_ITEM TPI, TABELA_PRECO TP
											 WHERE P.PROCOD = TPI.PROCOD
											   AND TP.TABPRECOD 	= TPI.TABPRECOD
											   AND P.PROCOD 		= '.$produto[0].'
											   AND TPI.TABPRECOD 	= '.$produto[1];
						
						$query_fechamento = oci_parse($conecta,$sql_fechamentos);
						
						oci_execute($query_fechamento);
						
						$kit = oci_fetch_object($query_fechamento);
						
						$total_item += calculo_juros($kit->VALOR,$start->INDICE);
						
						?>
                        
                        <tr>
                            <td><?php echo $y; ?></td>
                            <td><?php echo $kit->CODIGO; ?></td>
                            <td><?php echo $kit->DESCRICAO; ?></td>
                           
                            <td><?php echo number_format(calculo_juros($kit->VALOR,$start->INDICE),2,',','.'); ?></td>
                        </tr>						
                        <?php
					}
					
					$total1 = $preco_venda + $total_item;
					
				}
			?>
            
       </table>
        
        <strong>TOTAL </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; R$ <span class="valorTotal"><?php echo number_format($total1,2,',','.'); ?>
</span>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Desconto: % <input type="text" name="orc_desconto" value="0" maxlength="3" size="3"/>
        
        <input type="button" name="orc_bt_condicao" value="Condição Pgto." style="float:none" />
        <input type="text" name="orc_condicao" disabled="disabled" size="6" value="<?php 
				if(isset($start->INDICE) and !empty($start->INDICE)){
					echo $start->NOME;
				} 
			?>" />
        <input type="hidden" name="orc_condicao_codigo" value="<?php if(isset($start->INDICE) and !empty($start->INDICE)){ echo $start->CODICO_CONDICAO; }?>"/>
        
        <input type="hidden" name="orc_total" value="<?php echo $total1; ?>" />
        <input type="button" value="Finalizar" name="bt_parcelas_orcamento" class="k-button">
        <input type="button" value="Observação" name="bt_obs_orcamento" class="k-button">
                
                
    </div>
    
    
    <div id="orcamento_detalhar_parcelas">
    
    	
    </div>
    
    <div id="orcamento_filial_sem_atuacao">
    
    
    
    </div>
    
    
  <style>
  	#orcamento_detalhar_parcelas{  display:none; }
  	#orcamento_filial_sem_atuacao{ display:none; }
  .modal{ z-index:99999999999999; position:absolute; left:33%; top:33%; background:#FFF; height:240px; width:200px; border:1px solid #94C0D2}
.close{ float:right;}
  </style>  
    
    <div id="modal_obs_orc">
        <div style=" line-height:20px; height:20px; background:#daecf4; border:1px solid #cbe6ef;">
            &nbsp;Objervação
            <a name="fechar_modal_obs_orc" type="button" href="#" class="k-icon k-i-close close">X</a>
        </div>
        <div id="div_modal_obs_orc">
            <textarea rows="12" name="obs_orc"></textarea>
        </div>
    </div>
    
    
    
    <script>
		//Prazo minimo de entrega de 15 dias
		var prazo_minimo = function(numero){
			var input = $('input[name="orc_prazo_entrega"]');
			if(!isNaN(numero)){
				input.live('focusout',function(){
					var prazo = input.val();
					if(!isNaN(prazo)){
						if(prazo < numero){
							alert('Prazo mínimo de entrega é de ' + numero + ' dias!');
							input.val(numero);
							input.focus();
						}
					}else{
						alert('Prazo Invalido');
					}
				})				
			}
		}
		prazo_minimo(15);
		// Fim Prazo minimo
		
		
		function formatReal(int){  
			var tmp = int+'';  
			tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
			if( tmp.length > 6 )  
				tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");  
	  
			return tmp;  
		}  

    	//FUNÇÃO VERIFICA SE É NUMERO ========================================================================
		function verificaNumero(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		}
		// ===================================================================================================
		
		//CAMPOS QUE SÓ ACEITAM NUMEROS ======================================================================
		
		function moeda(valor, casas, separdor_decimal, separador_milhar){ 
		 
			var valor_total = parseInt(valor * (Math.pow(10,casas)));
			var inteiros 	= parseInt(parseInt(valor * (Math.pow(10,casas))) / parseFloat(Math.pow(10,casas)));
			var centavos 	= parseInt(parseInt(valor * (Math.pow(10,casas))) % parseFloat(Math.pow(10,casas)));
		
		
			if(centavos%10 == 0 && centavos+"".length<2 ){
				centavos = centavos+"0";
				
			}else if(centavos<10){
				centavos = "0"+centavos;
			}
			
			var milhares = parseInt(inteiros/1000);
			inteiros	 = inteiros % 1000; 
			
			var retorno  = "";
			
			if(milhares>0){
				retorno = milhares+""+separador_milhar+""+retorno
			
				if(inteiros == 0){
					inteiros = "000";
				}else if(inteiros < 10){
					inteiros = "00"+inteiros; 
				}else if(inteiros < 100){
					inteiros = "0"+inteiros; 
				}
			}
			retorno += inteiros+""+separdor_decimal+""+centavos;
			
			return retorno;	 
		}
		
		function fValor(valor){
			var retorno = valor.replace('.','');
			retorno = retorno.replace(',','.');
			return parseFloat(retorno);
		}
		
		
		//Altera valor se estiver vazio
		function valor(){
			var val = $(this).val();
			if(val == ''){ $(this).val('0'); }
		}
		$('input[name="orc_prazo_entrega"]').keypress(verificaNumero).focusout(valor);
		
		function foco(){
			var frete 		= fValor($('input[name="orc_valor_frete"]').val());
			var adicional 	= fValor($('input[name="orc_valor_adicional"]').val());
			var totalreal 	= fValor($('input[name="orc_total"]').val());
			var desconto 	= fValor($('input[name="orc_desconto"]').val());
			
			if(desconto!=0){
				desconto = (totalreal*desconto)/100;
			}
			
			var saldo = (adicional + frete) + (totalreal - desconto);
										
			if(!isNaN(saldo)){
				$('span.valorTotal').html('<strong>'+(moeda(saldo,2,',','.'))+'</strong>');
			}else{
				$('span.valorTotal').html('<strong>'+(moeda(totalreal,2,',','.'))+'</strong>');
			}
			
		}
		
		
		
		//Frete ==============================================================================================================================
		$('input[name="orc_valor_frete"]')
							.keypress(verificaNumero)
							.focus(foco)							
							.maskMoney({decimal:",",thousands:"."})
							.keyup(function(e){
										
										var frete 		= fValor($(this).val());
										var adicional 	= fValor($('input[name="orc_valor_adicional"]').val());
										var totalreal 	= fValor($('input[name="orc_total"]').val());
										var desconto 	= fValor($('input[name="orc_desconto"]').val());
			
										if(desconto > 100){
											$('input[name="orc_desconto"]').val(100);
										}
										
										if(desconto == '' || isNaN(desconto)){
											$('input[name="orc_desconto"]').val(0);
										}

										if(desconto!=0){
											desconto = (totalreal*desconto)/100;
										}
										
										
										var saldo = (adicional + frete) + (totalreal - desconto);
										
										if(!isNaN(saldo)){
											$('span.valorTotal').html('<strong>'+(moeda(saldo,2,',','.'))+'</strong>');
										}else{
											$('span.valorTotal').html('<strong>'+(moeda(totalreal,2,',','.'))+'</strong>');
										}
									});
		
		// Adicional ============================================================================================================================
		$('input[name="orc_valor_adicional"]')
							.keypress(verificaNumero)
							.focus(foco)
							.maskMoney({decimal:",",thousands:"."})
							.keyup(function(e){
										
										var adicional = fValor($(this).val());
										var totalreal = fValor($('input[name="orc_total"]').val());
										var desconto  = fValor($('input[name="orc_desconto"]').val());
										var frete 	  = fValor($('input[name="orc_valor_frete"]').val());
										
										if(frete == '' || isNaN(frete)){
											$('input[name="orc_valor_frete"]').val(0);
										}
										if(desconto == '' || isNaN(desconto)){
											$('input[name="orc_desconto"]').val(0);
										}
										
										if(desconto!=0){
											desconto = (totalreal*desconto)/100;
										}
										
										var saldo = (adicional + frete) + (totalreal - desconto);
																	
										if(!isNaN(saldo)){
											$('span.valorTotal').html('<strong>'+(moeda(saldo,2,',','.'))+'</strong>');
										}else{
											$('span.valorTotal').html('<strong>'+(moeda(totalreal,2,',','.'))+'</strong>');
										}
									});
						
		
		// Desconto ============================================================================================================================
		$('input[name="orc_desconto"]')
						.keypress(verificaNumero)
						.focus(foco)
						.keyup(function(e){
									var desconto  = fValor($(this).val()); 
									var adicional = fValor($('input[name="orc_valor_adicional"]').val());
									var totalreal = fValor($('input[name="orc_total"]').val());
									var frete     = fValor($('input[name="orc_valor_frete"]').val());
									
									if(desconto > 100){
										$('input[name="orc_desconto"]').val(100); 
									}
									
									if(desconto == ''|| isNaN(desconto)){
										$('input[name="orc_desconto"]').val();
									}
									
									if(adicional == '' || isNaN(adicional)){
										$('input[name="orc_valor_adicional"]').val('0'); 
									}
									
									
									if(desconto!=0){
										desconto = (totalreal*desconto)/100;
									}
									
									
									var saldo = adicional + frete + (totalreal - desconto);
									
																	
									if(!isNaN(saldo)){
										$('span.valorTotal').html('<strong>'+(moeda(saldo,2,',','.'))+'</strong>');
									}else{
										$('span.valorTotal').html('<strong>'+(moeda(totalreal,2,',','.'))+'</strong>');
									}
								});
		
		//Botão detalhar Financiamento =======================================
		$('input[name="bt_parcelas_orcamento"]').click(function(e){
			e.preventDefault();
			
			
			
			
			var frete				= $('input[name="orc_valor_frete"]').val();
			var desconto			= $('input[name="orc_desconto"]').val();
			var total				= $('input[name="orc_total"]').val();
			var adicional			= $('input[name="orc_valor_adicional"]').val();
			var condicao_pagamento	= $('input[name="orc_condicao_codigo"]').val();
			var cliente 			= $('input[name="orc_cliente"]').val();
     		var usuario 			= $('input[name="orc_usuario"]').val();;
			var data_final			= $('input[name="orc_data_final"]').val();
			var prazo_entrega		= $('input[name="orc_prazo_entrega"]').val();  	
			var previsao			= $('select[name="orc_prev_venda"]').val();

			 if(cliente == ''){ alert('escolha um cliente');}
			 else{
				 if(usuario == ''){ alert('Logue novamente no sistema!');}
				 else{
					 if(data_final == ''){ alert('Escolha uma data final');$('input[name="orc_data_final"]').select()}
					 else{
						 if(prazo_entrega == ''){ alert('Defina um prazo de entrega');$('input[name="orc_prazo_entrega"]').focus();}
						 else{
							 if(previsao == ''){ alert('Escolha a previsão de venda.');$('input[name="orc_prev_venda"]').focus();}
						     else{
								 $('#orcamento_tela_finalizar').css({display:'none'})
								 $('#orcamento_detalhar_parcelas').css({display:'block'})
								$.post(
									'modulos/riolax/pedido/orcamento/PHP/detalhar.php',
									{
										"condicao_pagamento": condicao_pagamento,
										"adicional"			: adicional,
										"desconto" 			: desconto,
										"frete" 			: frete,
										"total"				: total
									},
									function(data){
										$('#orcamento_detalhar_parcelas').html(data);
									}
								);
							 }
						 }
					 }
				 }
			 }
			
		});
		// ===================================================================
		
		
		
		
		
		
		$('input[name="orc_bt_condicao"]').click(function(e){
			e.preventDefault();
			
			
			$('a[name="pesquisa_condicao_pagamento"]').click();
			
			setTimeout(function(){$.post('pesquisa_condicao_pagamento.php',
					{'parametro': 1},
					function(data){
						$('#pesquisa_condicao_pagamento').html(data);
						setTimeout(function(){$('input[name="pesquisa_condicao_pagamento_tela_retorno"]').val('pedido_orcamento|NOME:orc_condicao,CODIGO:orc_condicao_codigo')},1000);;
						
			});},1000);
			
		});
		
		
		
</script>