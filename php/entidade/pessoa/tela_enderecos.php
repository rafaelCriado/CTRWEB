<fieldset>
    <legend>Endereço de Cobrança: </legend>
    
    <span class="span_left">
        Endereço:<br>
        <input type="text" name="entidade_endereco_cobranca" value="" size="45" maxlength="200">
    </span>
    
    <span class="span_left">
        Número:<br>
        <input type="text" name="entidade_numero_cobranca" value="" size="5" maxlength="10">
    </span>

	<span class="span_left" style="width:400px; border:0px solid red; height:45px"></span>
	
    <span class="span_left">
        Bairro: <br>
        <input type="text" name="entidade_bairro_cobranca" value="" size="31" maxlength="50">
    </span>
    
    <span class="span_left">
        CEP: <br>
        <input type="text" name="entidade_cep_cobranca" value="" size="23" maxlength="9" placeholder="XXXXX-XXX">
    </span>
	<span class="span_left" style="width:350px; border:0px solid red; height:45px"></span>
    
    
    <span class="span_left">
        Estado:<br>
        <select name="entidade_estado_cobranca">
            <?php 
                //Consulta Estado
                $query_uf = oci_parse($conecta,"SELECT UFCOD AS CODIGO_ESTADO ,UFABREV AS UF FROM UF");
                oci_execute($query_uf);
                
                while($estado = oci_fetch_object($query_uf)){
                    echo '<option value="'.$estado->CODIGO_ESTADO.'">'.$estado->UF.'</option>';										
                }
            ?>
        </select>

    </span>                        
    
    <span class="span_left">
        Cidade: <br>
    
        <select name="entidade_cidade_cobranca">
            <option value="">-- Escolha um estado --</option>
        </select>
    </span>
    

   

</fieldset>

<fieldset>
    <legend>Endereço Adicional: </legend>
    
    <span class="span_left">
        Endereço:<br>
        <input type="text" name="entidade_endereco_adicional" value="" size="45" maxlength="200">
    </span>
    
    <span class="span_left">
        Número:<br>
        <input type="text" name="entidade_numero_adicional" value="" size="5" maxlength="10">
    </span>
	<span class="span_left" style="width:400px; border:0px solid red; height:45px"></span>
    <span class="span_left">
        Bairro: <br>
        <input type="text" name="entidade_bairro_adicional" value="" size="31" maxlength="50">
    </span>
    
    <span class="span_left">
        CEP: <br>
        <input type="text" name="entidade_cep_adicional" value="" size="23" maxlength="9" placeholder="XXXXX-XXX">
    </span>
	<span class="span_left" style="width:350px; border:0px solid red; height:45px"></span>
    
    
    <span class="span_left">
        Estado:<br>
        <select name="entidade_estado_adicional">
            <?php 
                //Consulta Estado
                $query_uf = oci_parse($conecta,"SELECT UFCOD AS CODIGO_ESTADO ,UFABREV AS UF FROM UF");
                oci_execute($query_uf);
                
                while($estado = oci_fetch_object($query_uf)){
                    echo '<option value="'.$estado->CODIGO_ESTADO.'">'.$estado->UF.'</option>';										
                }
            ?>
        </select>

    </span>                        
    
    <span class="span_left">
        Cidade: <br>
    
        <select name="entidade_cidade_adicional">
            <option value="">-- Escolha um estado --</option>
        </select>
    </span>
    

</fieldset>