<?php 
	//Inclui banco de dados
	error_reporting(0);
	include('php/classes/bd_oracle.class.php');
	include "../../../functions.php";
?>

    <div id="tabstrip_FC_parametrofinanceiro">
        
        <!-- Abas -->
        <ul>
            <li class="k-state-active">
                Novo
            </li>
            <li>
                Condições Cadastradas
            </li>
        </ul>
        <!-- Fim Abas -->

        <!-- Primeira Aba (NOVO)-->
        <div id="FC_parametrofinanceiro_aba_um">
            <div id="FC_parametrofinanceiro_superior">
                <?php 
				
                    if(isset($_REQUEST['codigo_parametro_financeira']) and !empty($_REQUEST['codigo_parametro_financeira'])){
						
						
						$variaveis = explode('|',$_REQUEST['codigo_parametro_financeira']);
						
                        //Pesquisa dados
                        $sql = '  SELECT FINCOD       AS CODIGO,
										 FINPARNUM    AS PARCELA,
										 FINPARCAR    AS CARENCIA,
										 FINPARIND    AS INDICE,
										 USUCOD       AS USUARIO,
										 EMPCOD       AS EMPRESA,
										 FINPARTOTPAR AS TOTAL_PARCELAS
									FROM FINANCEIRAS_PARCELAS
								   WHERE FINCOD = '.$variaveis[2].'
									 AND FINPARCAR = '.$variaveis[1].'
									 AND FINPARTOTPAR = '.$variaveis[0];
                                  
                        $query_condicao = oci_parse($conecta,$sql);
                        
                        oci_execute($query_condicao);
                        
                        $condicao = oci_fetch_object($query_condicao);
                        
                        
						
                    }
                ?>
            
                <form name="FC_parametrofinanceiro">
                <fieldset>
                
                    
                    <input type="hidden" name="codigo_parametro_financeira" 
                        value="<?php echo (isset($condicao->CODIGO))? $condicao->CODIGO:'';?>">
                
                    <legend>Financeira: </legend>
                    <label for="FC_parametrofinanceiro_descricao">Descrição: </label>
                    <select name="FC_parametrofinanceiro_descricao">
                    	<option value="">Escolha...</option>
                        <?php 
							//Financeiras
							$sql_financeira = 'SELECT FINCOD AS CODIGO, FINNOM AS NOME FROM FINANCEIRAS WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
							$query_financeira = oci_parse($conecta,$sql_financeira);
							if(oci_execute($query_financeira)){
								while($financeira = oci_fetch_object($query_financeira)){
									echo '<option value="'.$financeira->CODIGO.'">'.$financeira->NOME.'</option>';
								}
							}
						?>
                    </select>
                    
                    
                    <label for="FC_parametrofinanceiro_qtde_parcelas">&nbsp;&nbsp;Max. Parcelas: </label>
                    <input type="text" name="FC_parametrofinanceiro_qtde_parcelas" 
                        value="<?php echo (isset($condicao->TOTAL_PARCELAS))? $condicao->TOTAL_PARCELAS:'';?>" maxlength="3" size="5">
                    
                    
                    <label for="FC_parametrofinanceiro_carencia">&nbsp;&nbsp;Carência (dias): </label>
                    <input type="text" name="FC_parametrofinanceiro_carencia"  maxlength="3"
                        value="<?php echo (isset($condicao->CARENCIA))? $condicao->CARENCIA:'';?>" size="5" >
                    
                </fieldset>
                
            </div>
            <div id="FC_parametrofinanceiro_inferior" >
                <fieldset>
                    <legend>Parcelas</legend>
                    <table id="FC_parametrofinanceiro_table_parcelas" style="overflow:auto; max-height:200px;">
                        <tr class="k-header">
                            <td>Qte. Parcelas </td>
                            <td>Índice (%)</td>
                            <td></td>
                        </tr>
                        <?php
                            if(isset($_REQUEST['codigo_parametro_financeira']) and !empty($_REQUEST['codigo_parametro_financeira'])){
								
								?>
                                <script>
									$('select[name="FC_parametrofinanceiro_descricao"]').val(<?php echo $variaveis[2];?>);
                                </script>
                                <?php
								
                                //Consulta parcelas
                                $sql = 'SELECT FINCOD       AS CODIGO,
										 FINPARNUM    AS PARCELA,
										 FINPARCAR    AS CARENCIA,
										 FINPARIND    AS INDICE,
										 USUCOD       AS USUARIO,
										 EMPCOD       AS EMPRESA,
										 FINPARTOTPAR AS TOTAL_PARCELAS
									FROM FINANCEIRAS_PARCELAS
								   WHERE FINCOD = '.$variaveis[2].'
									 AND FINPARCAR = '.$variaveis[1].'
									 AND FINPARTOTPAR = '.$variaveis[0];
                                //Prepara query
                                $query_parcelas = oci_parse($conecta,$sql);
                                
                                //Executa
                                oci_execute($query_parcelas);
                                $total = 0;
                                //Recebe valores
                                while($parcela = oci_fetch_object($query_parcelas)){
                                    echo '<tr>';
                                    echo 	'<td title="'.$parcela->CODIGO.'">'.$parcela->PARCELA.'</td>';
                                    echo 	'<td id="idP_'.$parcela->PARCELA.'_'.str_replace('|','_',$_REQUEST['codigo_parametro_financeira']).'">'.$parcela->INDICE.'</td>';
                                    echo 	'<td><a href="#" id="'.$parcela->PARCELA.'|'.$_REQUEST['codigo_parametro_financeira'].'" name="FC_parametrofinanceiro_bt_editar">Editar</a></td>';
                                    echo '</tr>';
									$total += $parcela->INDICE;
                                }
                                echo $total;
                            }
                        ?>
                        
                    </table>
                </fieldset>
            </div>
            <div id="FC_botoes">
                <input type="button" name="FC_parametrofinanceiro_bt_incluir" value="Salvar" class="k-button">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="FC_parametrofinanceiro_bt_novo" value="Novo" class="k-button">
                <span class="retorno_FC_parametrofinanceiro"></span>

            </form>
            </div>                   
            
            <div style="clear:both"></div>
        </div>
        <!-- Fim Primeira aba-->
        
        
        <!-- Segunda Aba (CONDIÇÕES CADASTRADAS)-->
        <div id="FC_parametrofinanceiro_aba_dois">
            <fieldset>
            <legend>Condições de Pagamento</legend>
            <table id="FC_parametrofinanceiro_aba_dois_table" height="200px" cellpadding="0" cellspacing="0">
                <tr class="k-header">
                    
                    <td><strong>Nome</strong></td>
                    <td><strong>Taxa</strong></td>
                    <td><strong>Carência</strong></td>
                    <td><strong>Parcelas</strong></td>
                    <td></td>
                </tr>
                
                <?php 
                    //Pesquisa de condições de pagamento
                    $sql = "select f.fincod        AS CODIGO,
								   F.FINNOM        AS NOME,
								   F.FINTAXABE     AS TAXA,
								   FP.FINPARCAR    AS CARENCIA,								   
								   fp.finpartotpar as parcela
							  from financeiras f, financeiras_parcelas fp
							 where f.fincod = fp.fincod
							 GROUP BY F.FINCOD,
									  F.FINNOM,
									  F.FINTAXABE,
									  FP.FINPARCAR,
									  fp.finpartotpar";
                    
                    $query_pagamento = oci_parse($conecta,$sql);
                    
                    oci_execute($query_pagamento);
                    
                    while($parametro_financeira = oci_fetch_object($query_pagamento)){
                    
                        ?>
                        <tr id="<?php echo $parametro_financeira->CODIGO;?>">
                            
                            <td title="<?php echo $parametro_financeira->NOME;?>"><?php echo textoFORMAT($parametro_financeira->NOME,22);	?></td>
                            <td><?php echo 'R$ '.number_format($parametro_financeira->TAXA,2,',','.');?></td>
                            <td><?php echo ($parametro_financeira->CARENCIA==0)?0:$parametro_financeira->CARENCIA.' dias';			?></td>
                            <td><?php echo $parametro_financeira->PARCELA;	?></td>
                            <td><a href="#" id="<?php echo $parametro_financeira->PARCELA."|".$parametro_financeira->CARENCIA."|".$parametro_financeira->CODIGO;?>" name="FC_parametrofinanceiro_bt_editar_forma">Editar</a> &nbsp;&nbsp;<a href="#" id="<?php echo $parametro_financeira->PARCELA."|".$parametro_financeira->CARENCIA."|".$parametro_financeira->CODIGO;?>" name="FC_parametrofinanceiro_bt_excluir_forma">Excluir</a></td>
                        </tr>
                        <?php
                    }
                    ?>
            </table>
            
            </fieldset>
        </div>
        <!-- Fim Segunda aba-->
    
        
    </div>
