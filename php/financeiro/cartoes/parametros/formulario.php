<?php
	//Informações da forma de pagamento selecionada
	
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../../php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../../php/functions.php');
		
		//Inclui banco de dados
		include('../../../../php/classes/bd_oracle.class.php');
	}
	
	if($_POST){
		
		$id = isset($_POST['id'])?$_POST['id']:'';
		
		if(!empty($id)){
			
			$sql_cartao_credito = ' SELECT EMPCOD          AS EMPRESA,
										   USUCOD          AS USUARIO,
										   CARCRECOD       AS CODIGO,
										   CARCRERED       AS REDE,
										   CARCREDES       AS NOME,
										   CARCRETIP       AS TIPO,
										   CARCREREP       AS REPASSE,
										   CARCREFEC       AS FECHAMENTO,
										   CARCRECC        AS CONTA,
										   FORNUMPAG       AS FORMA_PAGAMENTO,
										   CARCRENUMMAXPAR AS MAXIMO_PARCELAS,
										   CARCREPAR	   AS PARCELAMENTO
									  FROM CARTAO_CREDITO
									 WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').' AND CARCRECOD = '.$id;
			
			$query_cartao_credito = oci_parse($conecta,$sql_cartao_credito);
			
			if(oci_execute($query_cartao_credito)){
				
				//Recebe informações
				$cartao_credito = oci_fetch_object($query_cartao_credito);
				
			}
			
		}
	}
?>


<div id="campo_cc">
    <label for="cc_codigo_demo" >Código:</label><br />
    <input name="cc_codigo_demo" type="text" 	value="<?php echo isset($cartao_credito->CODIGO)?$cartao_credito->CODIGO:''; ?>" disabled="disabled" size="5"/>
    <input name="cc_codigo" 	 type="hidden" 	value="<?php echo isset($cartao_credito->CODIGO)?$cartao_credito->CODIGO:''; ?>" />
</div>

<div id="campo_cc">
    <label for="cc_rede">Rede:</label><br />
    <input name="cc_rede" type="text" value="<?php echo isset($cartao_credito->REDE)?$cartao_credito->REDE:''; ?>"  size="30" />
</div>

<div id="campo_cc">
    <label for="cc_transacao" title="Transação">Transação:</label><br />
    <select name="cc_transacao">
       <option value="D">Débito</option>
       <option value="C">Crédito</option>
       <option value="E">Estorno</option>
    </select>
    <script>
		$('select[name="cc_transacao"]').val('<?php echo isset($cartao_credito->TIPO)?$cartao_credito->TIPO:''; ?>');
    </script>
</div>




<div id="campo_cc">
    <label for="cc_descricao" title="Descrição">Descrição:</label><br />
    <input name="cc_descricao" type="text" value="<?php echo isset($cartao_credito->NOME)?$cartao_credito->NOME:''; ?>"  size="43" />
</div>

<div id="campo_cc">
    <label for="cc_parcela_maximo" title="Número máximo de parcelas">Máx. Parcelas:</label><br />
    <input name="cc_parcela_maximo" type="text" value="<?php echo isset($cartao_credito->MAXIMO_PARCELAS)?$cartao_credito->MAXIMO_PARCELAS:''; ?>"  size="9" />
</div>

<div id="campo_cc">
    <label for="cc_repasse" title="Prazo para pagamento do Repasse em dias">Repasse:</label><br />
    <input name="cc_repasse"  title="Prazo para pagamento do Repasse em dias" value="<?php echo isset($cartao_credito->REPASSE)?$cartao_credito->REPASSE:''; ?>" size="5"/>
</div>

<div id="campo_cc">
    <label for="cc_fechamento" title="Fechamento de Lote">Fec. Lote:</label><br />
    <select name="cc_fechamento" title="Fechamento de Lote">
       <option value="D">Diário</option>
       <option value="S">Semanal</option>
       <option value="Q">Quinzenal</option>
       <option value="M">Mensal</option>
       <option value="O">Outros</option>
    </select>
    <script>
		$('select[name="cc_fechamento"]').val('<?php echo isset($cartao_credito->FECHAMENTO)?$cartao_credito->FECHAMENTO:''; ?>');
    </script>
</div>



<div id="campo_cc">
    <label for="cc_forma_recebimento" title="Forma de Recebimento">Forma de Receber: &nbsp;</label><br />
    <select name="cc_forma_recebimento">
       <?php
	   		//Formas de Pagamento
			$sql_forma_pagamento = 'SELECT FORPAGNUM AS CODIGO, FORPAGDES AS NOME
									  FROM FORMAS_PAGAMENTO
									 WHERE FORPAGTIP = 1 AND EMPCOD = '.$sessao->getNode('empresa_acessada');
			$query_forma_pagamento = oci_parse($conecta,$sql_forma_pagamento);
			
			if(oci_execute($query_forma_pagamento)){
				while($fp = oci_fetch_object($query_forma_pagamento)){
					echo '<option value="'.$fp->CODIGO.'">'.$fp->NOME.'</option>';
				}
			}
	   ?>
    </select>
    <script>
		$('select[name="cc_forma_recebimento"]').val(<?php echo isset($cartao_credito->FORMA_PAGAMENTO)?$cartao_credito->FORMA_PAGAMENTO:''; ?>);
    </script>
</div>

<div id="campo_cc">
    <label for="cc_parcelamento" title="Parcelamento">Parcelamento:</label><br />
    <select name="cc_parcelamento">
       <option value="1">na Loja</option>
       <option value="2">na Administradora</option>
    </select>
    <script>
		$('select[name="cc_parcelamento"]').val(<?php echo isset($cartao_credito->PARCELAMENTO)?$cartao_credito->PARCELAMENTO:''; ?>);
    </script>
</div>



<br />



<div id="parcela_cc" style="clear:both">

	<fieldset>
		<legend>Taxas de descontos nas Parcelas (%)</legend>
        <div>
        <table cellpadding="0" cellspacing="0">
			<?php 
                //Pesquisa parcelas 
                $sql_parcelas = 'SELECT CARCREPARNUM AS NUMERO, CARCREPARTAX AS VALOR
								  FROM CARTAO_CREDITO_PARAMETROS
								 WHERE CARCRECOD = '.$id;

                
                $query_parcelas = oci_parse($conecta,$sql_parcelas);
                $array = '';
                if(oci_execute($query_parcelas)){
                    while($row = oci_fetch_object($query_parcelas)){
						$array[$row->NUMERO] = $row->VALOR;
                    }
					$colunas = ceil(count($array)/6);
					
					($colunas==0)?$colunas = 1:$colunas;
					
					
					
					$inicio = 1;
					$fim = 6;
					
					for($x = 1; $x <=  $colunas; $x++){
						
						echo '<tr>';
						
						
						
						for($y=$inicio; $y<=$fim; $y++){
							
							if(isset($array[$y])){
							
								echo '<td>';
								echo $y.'-';
								echo '</td>';
								echo '<td>';
								echo '<input type="text" name="cc_taxa_'.$y.'" value="'.$array[$y].'" size="3">';
								echo '</td>';
							}
							
						}
						$inicio += 6;
						$fim += 6;
						echo '</tr>';
						
					}
                }
            ?>
    	</table>
        </div>
	</fieldset>
</div>
