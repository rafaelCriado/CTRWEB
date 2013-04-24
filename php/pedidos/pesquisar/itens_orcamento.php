<table cellpadding="0" cellspacing="0">
    <tr class="k-header">	
        <td width="60px">Produto</td>
        <td>Descricao</td>
        <td width="60px">Qtde.</td>
        <td width="70px">Pc. Unitário</td>
        <td width="70px">Pc. Total</td>
    </tr>
	<?php
    
        if($_POST){
            
            $orcamento = isset($_POST['numero'])?$_POST['numero']:'';
            
            if(!empty($orcamento)){
                
                
                //Carrego banco de dados
                include('../../classes/bd_oracle.class.php');
                
                
                //Verifica pedidos existentes
                $sql_itens ='SELECT OI.ORCCOD AS NUMERO,
                                         OI.PROCOD AS PRODUTO,
                                         OI.ORCITEPRODES AS DESCRICAO,
                                         OI.ORCITEPROQUA AS QUANTIDADE,
                                         OI.ORCITEPROVALUNI AS VALOR_UNITARIO,
                                         OI.ORCITEDES AS DESCONTO,
                                         OI.ORCITEVALTOT AS TOTAL
                                    FROM ORCAMENTO_ITEM OI
								   WHERE OI.ORCCOD = '.$orcamento;
                                       
                
                //Prepara
                $query_itens = oci_parse($conecta,$sql_itens);
                
                //Executa
                if(oci_execute($query_itens)){
                    $cont = 0;
                    while($itens = oci_fetch_object($query_itens)){
                        ?>
                            <tr>	
                                <td><?php echo $itens->PRODUTO; ?></td>
                                <td><?php echo $itens->DESCRICAO; ?></td>
                                <td><?php echo $itens->QUANTIDADE; ?></td>
                                <td><?php echo $itens->VALOR_UNITARIO; ?></td>
                                <td><?php echo $itens->TOTAL; ?></td>                                        
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
                            </tr>						
							<?php
						}
					}
                    
                }
            }
        }
    ?> 
</table>