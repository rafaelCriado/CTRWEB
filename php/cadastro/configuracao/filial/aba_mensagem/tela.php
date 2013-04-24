
<style>
	div#abas_configuracao_filial-2{ padding:0px; }
	#ccf_af{ height:100%; width:100%; padding:0px; margin:0px; background:none;}
	#ccf_af .left{ color:#444; font-family:Arial, Helvetica, sans-serif; text-align:right; float:left; padding:0 1% 0 0; height:280px; background:#E2F0F6; border-right:1px solid #94C0D2; width:30%;}
	#ccf_af .right{ float:left; padding:0px; width:68%; margin:0px; text-align:left; height:inherit; overflow:auto;}
</style>


<div id="ccf_af">
    
    <div class="left">
    	<form name="ccf_af">
        	<br />

        	<label for="ccf_af_empresa">Filial:</label><br />

        	<select name="ccf_af_empresa">
                <option value="">Escolha...</option>
                <option value="0">Todas</option>
                <?php
                    $sql_empresas = 'SELECT EMPCOD AS CODIGO, EMPNOM AS DESCRICAO, EMPNOMFAN AS FANTASIA FROM EMPRESA';
                    
                    $query_empresa = oci_parse($conecta,$sql_empresas);
                    
                    if(oci_execute($query_empresa)){
                        while($empresa = oci_fetch_object($query_empresa)){
                            
                            echo '<option value="'.$empresa->CODIGO.'" title="'.$empresa->DESCRICAO.'">'.textoFORMAT($empresa->DESCRICAO,17).'</option>';
                            
                        }
                    }
                ?>
            </select>
            <br />
			<br />

            
            <label for="ccf_af_tipo_mensagem">Tipo de Mensagem:</label>
            <select name="ccf_af_tipo_mensagem">
                <option value="">Escolha...</option>
                <option value="1">SEM ÁREA DE ATUAÇÃO</option>
            </select>
            
            
        </form>
    </div>
    
    <div class="right">
    	<?php include('texto.php') ?>
    </div>
    
    <div style="clear:both"></div>
</div>




















