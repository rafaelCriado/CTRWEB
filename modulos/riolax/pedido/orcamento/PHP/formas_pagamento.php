<?php 
	//Banco
	include '../../../../../php/classes/bd_oracle.class.php';
	include '../../../../../php/functions.php';
	
	//Sessão
	include '../../../../../php/classes/session.class.php';
	$sessao = new Session();
	
	
	
	//Recebe valor por get.
	$formaPagamento = isset($_GET['codigo'])?$_GET['codigo']:'';
	
	
	//Formata arrays
	$orcamento 			 = $sessao->getNode('ORCAMENTO');
	
	if($sessao->checkNode('FORMA_PAGAMENTO')){
		
		
		$formas_de_pagamento = $sessao->getNode('FORMA_PAGAMENTO');
		
		$contador = contArray($formas_de_pagamento);
		
		$v_pago = 0;
		
		for($x=0; $x<$contador; $x++){
			$v_pago += getValArray($formas_de_pagamento[$x],'VALOR');
		}	
	}else{
		$v_pago = 0;
	}
	
	
	
	$total 		=  getValArray($orcamento,'TOTAL');
	$frete 		=  getValArray($orcamento,'FRETE');
	$adicional 	=  getValArray($orcamento,'ADICIONAL');
	$desconto 	=  getValArray($orcamento,'DESCONTO');
	
	
	$total     -=  (($total*$desconto)/100)-$adicional-$frete + $v_pago;
	
	
?>


<style>
	.FormPagam{ height:310px; width:380px; border:0px solid #000; text-align:left; margin:10px; }
	.FormPagam_select{ margin-left:13px; width:200px;  }
	.FormPagam_valor{ margin-left:112px; width:200px;}
	.FormPagam_resto{ margin-left:92px;  width:200px;}
	table{ margin:auto;	}
	.k-button{ float:right;	}
</style>

<div class="FormPagam">
	
    Formas de Pagamento:
      
        <input type="hidden" name="fp_get" value="<?php echo $formaPagamento; ?>">
        <input type="hidden" name="fp_total" value="<?php echo $total; ?>">
   	 	<select name="FormPagam_select" class="FormPagam_select">
	
			<?php 
                
				//Consulta as formas de pagamento
                $select = "SELECT FP.FORPAGNUM AS CODIGO ,FP.FORPAGDES AS FORM_PAGAMENTO FROM FORMAS_PAGAMENTO FP	WHERE FP.EMPCOD = ".$sessao->getNode('empresa_acessada');
                
                $query = oci_parse($conecta,$select);
                
                oci_execute($query);
                
                //Exibi as formas de pagamento
                while($item = oci_fetch_array($query)){
                    
                    echo "<option value='" . $item['CODIGO'] . "' > " .  $item['FORM_PAGAMENTO'] . "</option>";			
                }
            ?>
    
    </select>
    
        
	<br> Valor: <input type="text" name="FormPagam_valor" class="FormPagam_valor"  value=""/>
    
    <br> Restante: <input type="text" disabled name="FormPagam_resto" class="FormPagam_resto" value="<?php echo formata_numero($total);?>"/>
    
    <br> 
    
    <div style="height:180px; overflow:auto;">
    <br />

    <?php
		//Carrega formas ja cadastradas
		if($sessao->checkNode('FORMA_PAGAMENTO')){
			echo '<table width="100%"><tr><td colspan="2"><strong>Formas de Pagamento incluídas</strong></td></tr>';
			
			$formas_de_pagamento = $sessao->getNode('FORMA_PAGAMENTO');
			$contador = contArray($formas_de_pagamento,'CODIGO');
			
			
			
			for($x=0; $x<$contador; $x++){
				
				$sql = 'SELECT FP.FORPAGDES AS DESCRICAO FROM FORMAS_PAGAMENTO FP WHERE FP.FORPAGNUM = '.getValArray($formas_de_pagamento[$x],'CODIGO');
				$query = oci_parse($conecta,$sql);
				oci_execute($query);
				$row = oci_fetch_object($query);
				echo '<tr>';
				echo '<td>'.$row->DESCRICAO. '</td>';
				echo '<td>'.formata_numero(getValArray($formas_de_pagamento[$x],'VALOR')).'</td>';
				echo '</tr>';
			}	
			
			
			
			echo '</table>';
		}
	?>
    </div>
    <br> <input type="button" name="FormPagam" value="Incluir" class="k-button" />   
    	
    
	
</div>

<script>
	$(document).ready(function(e) {
		
		//Seta forma de pagamento com parametro vindo por get.
		var setFormaPagamento = function(campo, valor){
			$(campo).val(valor);
		}
		setFormaPagamento('select[name="FormPagam_select"]',$('input[name="fp_get"]').val());
		
		
		var validaCampo = function(campo,texto){
			if(campo == ""){
				alert(texto);
				return false;
			}
			return true;
		}
		
		// Efeito enter ==========================================
		
		var	focusValor = function(){
			$('input[name="FormPagam_valor"]').focusin(function() {
				
				$(this).keypress(function(e){
					if(e.which == 13){
						if($(this).val() != ""){
							$('input[name="FormPagam"]').focus();
											
						}else{
							alert('Digite um valor!');
						}
					}
				});
            });
		}
		focusValor();
		
		
		// ======================================================
		
		
		//Incluir forma de pagamento
		var incluir_FormaPagamento = function(botao){
			
			bt = $(botao);
			
			bt.click(function(e){
				
				var valor 		= parseFloat($('input[name="FormPagam_valor"]').val());
				var formaPgto	= $('select[name="FormPagam_select"]').val();
				var total		= parseFloat($('input[name="fp_total"]').val());
				
				e.preventDefault();				
				if(validaCampo(valor,'Digite um valor!')){
					if(validaCampo(formaPgto,'Selecione a Forma de Pagamento')){
						
						if(total-valor < 0){
							alert('Valor digitado é maior do que o restante');
							$('input[name="FormPagam_valor"]').val('');
							$('input[name="FormPagam_valor"]').focus();
						}else{
							$.post(
								'modulos/riolax/pedido/orcamento/PHP/addFormaPagamento.php',
								{	'tipo' : '1'/* à vista*/, 'valor': valor, 'formaPgto': formaPgto},
								function(data){
									
									alert(data);
									
									//Recebe o codigo da forma de pagamento
									$.ajax({
										url			: 	'modulos/riolax/pedido/orcamento/PHP/formas_pagamento.php', 
										dataType	: 	'html',
										data		: 	{	"codigo"	: formaPgto	},
										type		: 	'GET',
										success		: 	function(data) {
															$('#div_modal_fpgto').html(data);
															$('select[name="FormPagam_select"]').focus();
															
														},
										error		: 	function() {
															alert('Erro de requisição');	
														}		
									});
									
									
								}
							);
						}
					}
				}
			
			})
		}
		
		incluir_FormaPagamento('input[name="FormPagam"]');
		
		
		
		
		
	});
</script>
