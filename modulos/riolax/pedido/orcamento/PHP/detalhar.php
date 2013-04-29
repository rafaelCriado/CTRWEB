<?php 
	include('../../../../../php/classes/session.class.php');
	$sessao = new Session();
	//Inclui banco da dados e funções
	include("../../../../../php/classes/bd_oracle.class.php");
	include('../../../../../php/functions.php');

	if($_POST){
		
		
		
		$cliente 			= !empty($_POST['cliente'])				?$_POST['cliente']				:0;
		$prazo	 			= !empty($_POST['prazo_entrega'])		?$_POST['prazo_entrega']		:0;
		$previsao 			= !empty($_POST['previsao'])			?$_POST['previsao']				:0;
		$data_final			= !empty($_POST['data_final'])			?$_POST['data_final']			:0;
		$condicao_pagamento = !empty($_POST['condicao_pagamento'])	?$_POST['condicao_pagamento']	:0;
		$adicional 			= !empty($_POST['adicional'])			?$_POST['adicional']			:0;
		$desconto 			= !empty($_POST['desconto'])			?(float)$_POST['desconto']		:0;
		$frete	 			= !empty($_POST['frete'])				?$_POST['frete']				:0;
		$total	 			= !empty($_POST['total'])				?$_POST['total']				:0;
		$t = $total;
		$infos 				= '';
		
		$sql_condicao = 'SELECT CP.CONPAGCOD       AS CODIGO,
							   CP.CONPAGDEN       AS NOME,
							   CP.CONPAGQTDPAR    AS QUANTIDADE_PARCELA,
							   CP.CONPAGDIAPAR    AS DIFERENCA_PARCELAS,
							   CP.CONPAGDIAPRIPAR AS PRIMEIRA_PARCELA,
							   F.FINNOM           AS FINANCEIRA,
							   F.FINTAXABE        AS FINANCEIRA_TX_ABERTURA,
							   FP.FINPARIND       AS FINANCEIRA_INDICE,                   
							   CP.FINCOD,
							   CP.FINPARCAR		  AS CARENCIA,
							   CP.FINPARNUM,
							   CP.FORPAGNUM AS FORMA_PAGAMENTO
						  FROM COND_PAG CP, FINANCEIRAS F, FINANCEIRAS_PARCELAS FP
						 WHERE F.FINCOD(+) = CP.FINCOD
						 AND FP.FINCOD(+) = CP.FINCOD
						 AND CP.FINPARCAR = FP.FINPARCAR(+)
						 AND CP.CONPAGQTDPAR = FP.FINPARNUM(+)
						 AND CP.EMPCOD = '.$sessao->getNode('empresa_acessada').'
						 AND CP.CONPAGCOD = '.$condicao_pagamento;
		
		
		$query_condicao = oci_parse($conecta, $sql_condicao);
		
		if(oci_execute($query_condicao)){
			
			$condicao = oci_fetch_object($query_condicao);
			
			$financeira_carencia		= isset($condicao->CARENCIA)				?$condicao->CARENCIA				:'';
			$financeira_indice			= isset($condicao->FINANCEIRA_INDICE)		?$condicao->FINANCEIRA_INDICE		:0;
			$financeira_tx_abertura		= isset($condicao->FINANCEIRA_TX_ABERTURA)	?$condicao->FINANCEIRA_TX_ABERTURA	:'';
			$condicao_pagamento_nome	= isset($condicao->NOME)					?$condicao->NOME					:'';
			$carencia					= isset($condicao->PRIMEIRA_PARCELA)		?$condicao->PRIMEIRA_PARCELA		:0;
			$financeira_nome			= isset($condicao->FINANCEIRA)				?$condicao->FINANCEIRA				:'';
			$taxa_abertura 				= isset($condicao->FINANCEIRA_TX_ABERTURA)	?$condicao->FINANCEIRA_TX_ABERTURA	:0;
			$qtde_parcelas				= isset($condicao->QUANTIDADE_PARCELA)		?$condicao->QUANTIDADE_PARCELA		:1;
			$formaPagamento				= !empty($condicao->FORMA_PAGAMENTO)		?$condicao->FORMA_PAGAMENTO			:'';
			
			
			$adicional = str_replace('.','',$adicional);
			$adicional = str_replace(',','.',$adicional);

			$frete = str_replace('.','',$frete);
			$frete = str_replace(',','.',$frete);

			$taxa_abertura = str_replace('.','',$taxa_abertura);
			$taxa_abertura = str_replace(',','.',$taxa_abertura);

			$total = str_replace('.','',$total);
			$total = str_replace(',','.',$total);
			
			
			$total -= ($desconto*$total)/100;
			
			
			//Cria variavel de sessão com as variaveis do cabeçalho
			$header = $sessao->getNode('ORCAMENTO');

			$header['CLIENTE'] 	 	 = $cliente;
			$header['PREVISAO']	 	 = $previsao;
			$header['DATA_FINAL']	 = $data_final;
			$header['PRAZO']	 	 = $prazo;
			$header['FRETE']	 	 = $frete;
			$header['ADICIONAL'] 	 = $adicional;
			$header['DESCONTO']	 	 = $desconto;
			$header['CONDICAO_PGTO'] = $condicao_pagamento; 
			$header['TOTAL'] 		 = $t; 
			
			$sessao->addNode('ORCAMENTO',$header);
			
			// ====================================================
			
		}else{
			
		}
	
	}
	
	// Criar sessao da forma de pagamento
	$forma_pagamento[0]['CODIGO'] = 0;
	$forma_pagamento[0]['FORMA']  = "";
	$forma_pagamento[0]['VALOR']  = 0;
	$sessao->addNode('FORMA_PAGAMENTO', $forma_pagamento);
	// ====================================================
	
?>
<div style="height:100%">
	<form>
    	<fieldset >
        	<legend><strong>Detalhes do Orçamento</strong></legend>
            <div>
            Condição de Pagamento : <input type="text" disabled="disabled" value="<?php echo $condicao_pagamento_nome;?>" />
            <?php
				//Informações de financeira
				if(!empty($financeira_nome)){
					echo '<span style="color:#777;">Financeira: <strong>'.$financeira_nome.'</strong> &nbsp;Tx. Abertura: <strong> R$ '.number_format($financeira_tx_abertura,2,',','.').'</strong> &nbsp;Índice: <strong>'.$financeira_indice.' %</strong> &nbsp;Carência:<strong>'.$financeira_carencia.'</strong> dias</span>';
					$infos .= '<strong title="Taxa de Abertura de Financiamento">+ Tx.Aber.Fin.: </strong><input title="Taxa de Abertura de Financiamento" type="text" disabled="disabled" value="R$ '.number_format($financeira_tx_abertura,2,',','.').'" size="8">';
					
				}
			?> 
            <input type="hidden" name="orc_detal_financeira_tx_abert" value="<?php echo !empty($taxa_abertura)?$taxa_abertura:0;?>" />
            <br />
			
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Carência : <input type="text" disabled="disabled" value="<?php echo $carencia.' dias';?>" />
			
            
            
            &nbsp;&nbsp;&nbsp;&nbsp;
            Desconto : <input type="text" disabled="disabled" value="<?php echo $desconto.'%';?>" />
            
            <br />

            &nbsp;&nbsp;&nbsp;
            Forma de Pagamento : 
            <select name="orc_forma_pagamento">
            	<option value="0"></option>
            	<?php
					//Forma de Pagamento
					$sql_forma_pagamento = 'SELECT FORPAGNUM AS CODIGO, FORPAGDES AS NOME FROM FORMAS_PAGAMENTO WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
					$query_fp = oci_parse($conecta,$sql_forma_pagamento);
					
					if(oci_execute($query_fp)){
						while($fp = oci_fetch_object($query_fp)){
							$formas_de_pagamento[$fp->NOME] = $fp->NOME;
							echo '<option value="'.$fp->CODIGO.'">'.$fp->NOME.'</option>';			
						}
					}
					
				?>
            </select>
            <input name="orc_forma_pagamento_teste" type="hidden" value=""/>
            <script>
				$('select[name="orc_forma_pagamento"]').val(<?php echo $formaPagamento; ?>);
				$('input[name="orc_forma_pagamento"]') .val(<?php echo $formaPagamento; ?>);
            </script>
            
            
            
			
            <br />
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Adicional : <input type="text" disabled="disabled" value="<?php echo 'R$ '.$adicional;?>" />
					<input type="checkbox" name="orc_adicional_incluir" /> Adicionar ao parcelamento

            <br />

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Frete : <input type="text" disabled="disabled" value="<?php echo 'R$ '.$frete;?>" />
					<input type="checkbox" name="orc_frete_incluir" /> Adicionar ao parcelamento
            </div>
            
            <div style="height:250px;" id="finalizar_detalhar_parcelas">
            	<fieldset>
                	<legend>Parcelas</legend>
                    <div style=" height:150px;display:block; overflow:auto" >
                    <table width="100%" cellpadding="0" cellspacing="0" style="max-height:300px; overflow:auto;" >
                    	<tr class="k-header" height="25px">
                        	<td><strong>Num. Parcela</strong></td>
                            <td><strong>Prazo</strong></td>
                            <td><strong>Valor</strong></td>
                            <td><strong>Forma de Pagamento</strong></td>
                        </tr>
						<?php
							//echo $total;
							//echo (($desconto*$total)/100);

							//Adiciona taxa de abertura
							//$total += $taxa_abertura;
							
							
							if(isset($_POST['adicionar_frete']) and $_POST['adicionar_frete'] == 1){
								$total += $frete;
								$frete = 0;
							}else{
								$infos .= '<strong>+ Frete: </strong><input type="text" disabled="disabled" value="R$ '.number_format($frete,2,',','.').'" size="8">';
							}

							if(isset($_POST['adicionar_adicional']) and $_POST['adicionar_adicional'] == 1){
								$total += $adicional;
								$adicional = 0;
							}else{
								$infos .= '<strong>+ Adicional: </strong><input type="text" disabled="disabled" value="R$ '.number_format($adicional,2,',','.').'"size="8">';
							}
							 
                            //Parcelas
							$sql_parcelas = 'SELECT CONPAGCOD AS CODIGO, CONPAGPARSEQ AS NUMERO, CONPAGPARDIA AS DIA
											  FROM COND_PAG_PARC
											 WHERE CONPAGCOD ='. $condicao_pagamento;
							$query_parcelas = oci_parse($conecta, $sql_parcelas);
							
							if(oci_execute($query_parcelas)){
								
								
								//Calculo financiamento total
								if(!empty($financeira_indice)){
									$total += ($financeira_indice*$total)/100;
								}
								//fim
								
								$valor_parcela = $total/$qtde_parcelas;
								$mod = $total - (round($valor_parcela,2)*$qtde_parcelas);
								$mod = round($mod,2);
								while($parcelas = oci_fetch_object($query_parcelas)){
									
									?>
									<tr>
                                    	<td><?php echo $parcelas->NUMERO; ?></td>
                                        <td><?php echo $parcelas->DIA; ?></td>
                                        <td>
											<?php
															
												echo 'R$ '.number_format(($valor_parcela+$mod),2,',','.'); 
												
												if($mod != ''){
													$mod = 0;
												}echo $sessao->getNode('empresa_acessada');
											?>
                                     	</td>
                                        <td>
                                        	<select name="formPgto<?php echo $parcelas->NUMERO; ?>">
                                        	<?php 
											
												//Consulta forma de pagamento
													
												foreach($formas_de_pagamento as $c=>$d){													
													?>
														<option value="<?php echo $d; ?>"><?php echo $c; ?></option>
													<?php
												}
											
											
											?>
                                            </select>
                                        </td>
                                    </tr>									
									<?php
								}
								
							}
							
                            
                        ?>
                    </table>
                    </div>
                </fieldset>
                <strong>Total Parcelas: </strong> <input type="text" disabled="disabled" value="<?php echo 'R$ '.number_format($total,2,',','.');?>" size="11"/>
                <?php echo $infos;?>
                <br />
				<br />
                <strong>Total = </strong> <input type="text" disabled="disabled" value="<?php echo 'R$ '.number_format($total+$frete+$adicional+$financeira_tx_abertura,2,',','.');?>" size="11"/>		
                <input type="hidden"  value="<?php echo $total;?>" name="detalhar_total"/>
                <input type="hidden" name="concluir_orcamento" value="0" />
            </div>
            
            
            
        </fieldset>
    </form>


	<input name="bt_finalizar_orcamento" type="button" value="Concluir Orçamento" class="k-button" />
    	<input name="orc_cp_bt_voltar" type="button" value="Voltar" class="k-button" />

</div>
<script>
	//MODAL =======================================
		//Oculta formulário de formas de pagamento
		$('#modal_fpgto').hide();
		
		//Evento para fechar janela modal
		var fechaModal = function(){
			
			$('a[name="fechar_modal_fpgto"]').click(function(e){
				e.preventDefault();
				$("#modal_fpgto").hide();
			});
			
		}
		
		//Cria janela modal =================
		var criaBox = function(div){
			fechaModal();
			request_conteudo(1);
			
			$(div).addClass('modal_fp');
			$(div).show();
			
		}
	// ============================================


	var bt_voltar_cp_orc = function(){
		$('input[name="orc_cp_bt_voltar"]').click(function(){
			$('#orcamento_tela_finalizar').css({display:'block'})
			$('#orcamento_detalhar_parcelas').css({display:'none'})
		});
	}
	bt_voltar_cp_orc();
	
	
	//Evento selecionar forma de pagamento.
	var formasPagamento = function(){
		var forma = $('select[name="orc_forma_pagamento"]');
		
		forma.change(function(){
			//Cria modal
			criaBox('#modal_fpgto');
		});
		stop();
	}
	formasPagamento();


	//Preenche modal
	var request_conteudo = function(formaPagamento){
		
		//Recebe o codigo da forma de pagamento
		$.ajax({
			url			: 	'modulos/riolax/pedido/orcamento/PHP/formas_pagamento.php', 
			dataType	: 	'html',
			data		: 	{	"codigo"	: formaPagamento	},
			type		: 	'GET',
			success		: 	function(data) {
								$('#div_modal_fpgto').html(data);
							},
			error		: 	function() {
								alert('Erro de requisição');	
							}		
		});
		
	}
	
	
	
	
	
	
	//Ao selecionar orc_adicional_incluir =====================
		$('input[name="orc_adicional_incluir"]').click(function(){
			
			
			
			
			var infos;

			var frete				= $('input[name="orc_valor_frete"]').val();
			var desconto			= $('input[name="orc_desconto"]').val();
			var total				= $('input[name="orc_total"]').val();
			var adicional			= $('input[name="orc_valor_adicional"]').val();
			var condicao_pagamento	= $('input[name="orc_condicao_codigo"]').val();			
			
			
			
			var adicionar_adicional = $('input[name="orc_adicional_incluir"]');
			var addAdicional = 0;
			if(adicionar_adicional.is(':checked')){
				addAdicional = 1;
			}
			
			
			
			var adicionar_frete = $('input[name="orc_frete_incluir"]');
			var addFrete = 0;
			if(adicionar_frete.is(':checked')){
				addFrete = 1;
			}
			
			
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/detalhar_parcelas.php',
				{ 'adicionar_adicional' : addAdicional,
				  'adicionar_frete' : addFrete,
				  'frete' : frete,
				  'desconto': desconto,
				  'total': total,
				  'adicional': adicional,
				  'condicao_pagamento':condicao_pagamento	 },
				function(data){
					$('div#finalizar_detalhar_parcelas').html(data);
				}
			);
			
			
			
		});
	// ========================================================
	
		//Ao selecionar orc_adicional_incluir =====================
		$('input[name="orc_frete_incluir"]').click(function(){
			
			
			
			
			var infos;

			var frete				= $('input[name="orc_valor_frete"]').val();
			var desconto			= $('input[name="orc_desconto"]').val();
			var total				= $('input[name="orc_total"]').val();
			var adicional			= $('input[name="orc_valor_adicional"]').val();
			var condicao_pagamento	= $('input[name="orc_condicao_codigo"]').val();			
			
			
			
			var adicionar_adicional = $('input[name="orc_adicional_incluir"]');
			var addAdicional = 0;
			if(adicionar_adicional.is(':checked')){
				addAdicional = 1;
			}
			
			
			
			var adicionar_frete = $('input[name="orc_frete_incluir"]');
			var addFrete = 0;
			if(adicionar_frete.is(':checked')){
				addFrete = 1;
			}
			
			
			
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/detalhar_parcelas.php',
				{ 'adicionar_adicional' : addAdicional,
				  'adicionar_frete' : addFrete,
				  'frete' : frete,
				  'desconto': desconto,
				  'total': total,
				  'adicional': adicional,
				  'condicao_pagamento':condicao_pagamento	 },
				function(data){
					$('div#finalizar_detalhar_parcelas').html(data);
				}
			);
			
			
			
		});
	// ========================================================
	
	var mensagem_atuacao = function(codigo){
		$.ajax({
			url			: 	'modulos/riolax/pedido/orcamento/PHP/mensagem_atuacao.php', 
			dataType	: 	'html',
			data		: 	{	"codigo"	: codigo	},
			type		: 	'GET',
			success		: 	function(data) {
								if(codigo == 3){
								 	alert(data);
									var confirma = confirm("Deseja continuar?");
									
									if(confirma){gravar_orcamento();}
								}
							},
			error		: 	function() {
								alert('Erro de requisição');	
							}		
		});	
	}
	
	var verifica_area = function(cliente){
		
		$.ajax({
			url			: 	'php/cadastro/configuracao/filial/verifica_atuacao.php', 
			dataType	: 	'json',
			data		: 	{	"cliente"	: cliente	},
			type		: 	'GET',
			success		: 	function(data) {
								
								if(data == 3){
									//Fora de atuação
									mensagem_atuacao(3);
								};
								
								if(data == 1){
									//Normal
									gravar_orcamento();
								}
								
								if(data == 2){
									//Atuação de outra filial
									outra_filial();
								}
								
							},
			error		: 	function() {
								alert('Erro de requisição');	
							}		
		});	
		
		
	}
	
	var gravar_orcamento = function(){
			alert('GRAVA');
		 	var cliente 				= $('input[name="orc_cliente"]').val();
			 var usuario 				= $('input[name="orc_usuario"]').val();;
			 var data					= $('input[name="orc_data"]').val();
			 var data_final				= $('input[name="orc_data_final"]').val();
			 var prazo_entrega			= $('input[name="orc_prazo_entrega"]').val();  	
			 var frete					= $('input[name="orc_valor_frete"]').val();
			 var desconto				= $('input[name="orc_desconto"]').val();
			 var total					= $('input[name="orc_total"]').val();
			 var observacao				= $('textarea[name="obs_orc"]').val();
			 var categoria				= $('input[name="orc_categoria"]').val();
			 var modelo					= $('input[name="orc_modelo"]').val();
			 var medida					= $('input[name="orc_medida"]').val();
			 var linha					= $('input[name="orc_linha"]').val();
			 var acabamento				= $('input[name="orc_acabamento"]').val();
			 var cores					= $('input[name="orc_cores"]').val();
			 var posicao				= $('input[name="orc_posicao"]').val();
			 var voltagem				= $('input[name="orc_voltagem"]').val();
			 var fechamento				= $('input[name="orc_fechamento"]').val();
			 var adicional				= $('input[name="orc_valor_adicional"]').val();
			 var previsao_venda			= $('select[name="orc_prev_venda"]').val();
			 var condicao_pagamento		= $('input[name="orc_condicao_codigo"]').val();
			 var valor_tx_abertura  	= $('input[name="orc_detal_financeira_tx_abert"]').val();
			 var addFreteFinanc     	= 0;
			 var addAdicionalFinanc 	= 0;
			 var forma_pagamento  		= $('select[name="orc_forma_pagamento"]').val();
			 var forma_pagamento_teste 	= $('input[name="orc_forma_pagamento_teste"]').val();
			 
			 if(forma_pagamento_teste != ''){
				 forma_pagamento = forma_pagamento_teste;
			 }
			 
			 if($('input[name="orc_adicional_incluir"]').is(':checked')){
				 addAdicionalFinanc = 1;
			 }

			 if($('input[name="orc_frete_incluir"]').is(':checked')){
				 addFreteFinanc = 1;
			 }
			 

			$.ajax({
				url: 'modulos/riolax/pedido/orcamento/PHP/grava_orcamento.php', 
				dataType: 'json',
				data: {
						"cliente" 		: cliente,
						"usuario" 		: usuario,
						"data" 			: data,
						"data_final"	: data_final,
						"prazo_entrega"	: prazo_entrega,
						"frete" 		: frete,
						"desconto" 		: desconto,
						"observacao" 	: observacao,									
						"categoria"		: categoria,
						"modelo"		: modelo,
						"medida"		: medida,
						"linha"			: linha,
						"acabamento"	: acabamento,
						"cores"			: cores,
						"posicao"		: posicao,
						"voltagem"		: voltagem,
						"fechamento"	: fechamento,
						"adicional"		: adicional,
						"previsao_venda": previsao_venda,
						"condicao_pagamento"	: condicao_pagamento,
						"adicionar_frete"		: addFreteFinanc,									  
						"adicionar_adicional"	: addAdicionalFinanc,	
						"taxa_abertura"			: valor_tx_abertura,
						"forma_pagamento"		: forma_pagamento								  
					},

				type: 'POST',
				success: function(data) {
							if(data[0].codigo_retorno == 0){
								alert(data[0].texto);
							}else{
								$('#tabstrip_pedido_orcamento ul li:eq(3)').click()
								alert(data[0].texto + data[0].codigo_retorno);
								$.post(
									'modulos/riolax/pedido/orcamento/PHP/tela_pesquisa.php',
									{
										"orcamento" : data[0].codigo_retorno,
										"status"	: 1
									},
									function(data){
										$('div#po_aba_quatro').html(data);
									}
								);
								
							}
							
						 },
				error: function(xhr,er) {
							alert('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	;
						 }		
			});
			 
	}
	
	
	//BOTÃO FINALIZAR ORÇAMENTO ================================================================
		$('input[name="bt_finalizar_orcamento"]').click(function(e){
			 var cliente 				= $('input[name="orc_cliente"]').val();
			 var usuario 				= $('input[name="orc_usuario"]').val();;
			 var data_final				= $('input[name="orc_data_final"]').val();
			 var prazo_entrega			= $('input[name="orc_prazo_entrega"]').val();  	

			 var addFreteFinanc     	= 0;
			 var addAdicionalFinanc 	= 0;
			 var forma_pagamento  		= $('select[name="orc_forma_pagamento"]').val();
			 var forma_pagamento_teste 	= $('input[name="orc_forma_pagamento_teste"]').val();
			 
			 if(forma_pagamento_teste != ''){
				 forma_pagamento = forma_pagamento_teste;
			 }
			 
			 if($('input[name="orc_adicional_incluir"]').is(':checked')){
				 addAdicionalFinanc = 1;
			 }

			 if($('input[name="orc_frete_incluir"]').is(':checked')){
				 addFreteFinanc = 1;
			 }
			 
			 
			 
			 if(cliente == ''){ alert('escolha um cliente');}
			 else{
				 if(usuario == ''){ alert('Logue novamente no sistema!');}
				 else{
					 if(data_final == ''){ alert('Escolha uma data final');}
					 else{
						 if(prazo_entrega == ''){ alert('Defina um prazo de entrega');}
						 else{
							
							verifica_area(cliente);							 
							
						 }
					 }
				 }
			 }
			 
			 
		});
		// =========================================================================================
		
		var outra_filial = function(){

			$('#orcamento_detalhar_parcelas').css({display:'none'})
			$('#orcamento_filial_sem_atuacao').css({display:'block'})
			$.post(
				'modulos/riolax/pedido/orcamento/PHP/outra_filial.php',
				{},
				function(data){
					$('#orcamento_filial_sem_atuacao').html(data);
				}
			);


			
		}
		
		
</script>

<style>
	.modal_fp{position:fixed; top:50px; left:100px; background:#eee; z-index:9999999999999999999; height:350px; width:400px; border:1px solid #94C0D2; }
</style>
<div id="modal_fpgto">
    <div style=" line-height:20px; height:20px; background:#daecf4; border:1px solid #cbe6ef;">
        &nbsp;Forma de Pagamento
        <a name="fechar_modal_fpgto" type="button" href="#" class="k-icon k-i-close close">X</a>
    </div>
    <div id="div_modal_fpgto">
        
    </div>
</div>