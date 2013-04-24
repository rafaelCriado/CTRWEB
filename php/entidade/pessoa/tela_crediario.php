<fieldset>
	<legend>Crédito: </legend>
    
    Situação: 
    <select name="entidade_pessoa_bloqueado">
    	<option value="2">LIBERADO</option>
    	<option value="1">BLOQUEADO</option>
    </select>
    
    &nbsp;&nbsp;&nbsp;
    
    Limite R$ <input name="entidade_pessoa_limite" type="text" value="">
    
    &nbsp;&nbsp;&nbsp;
    
    Compra à Prazo: 
    <select name="entidade_pessoa_prazo">
    	<option value="2">NÃO</option>
    	<option value="1">SIM</option>
    </select>


</fieldset>

<fieldset>
	<legend>Dados Profissionais: </legend>
	
    <label for="entidade_local_trabalho">Local Trabalho:</label>
    <input type="text" name="entidade_local_trabalho" 	value="" size="40" maxlength="150">
    
    <label for="entidade_profissao">Profissão:</label>
    <input type="text" name="entidade_profissao" 		value="" size="40" maxlength="150">
    <br>

    <label for="entidade_tempo_trabalho">Tempo de Trabalho:</label>
    <input type="text" name="entidade_tempo_trabalho" 	value="" size="40" maxlength="150">
    
    <label for="entidade_salario">Salário:</label>
    <input type="text" name="entidade_salario" 			value="0" size="40" maxlength="150">
    <br>
    
    <label for="entidade_endereco_trabalho">Endereço Trabalho:</label>
    <input type="text" name="entidade_endereco_trabalho" value="" size="104" maxlength="200">
    <br>
    
</fieldset>


<fieldset>
        <legend>Dados do Cônjuge</legend>
        
        <label for="entidade_conjuge">Cônjuge:</label>
        <input type="text" name="entidade_conjuge"	value="" size="68" maxlength="200">
		<br>
        
        <label for="entidade_cpf_conjuge">CPF:</label>
        <input type="text" name="entidade_cpf_conjuge" 	value="" size="32" maxlength="14">
        

        <label for="entidade_rg_conjuge">RG:</label>
        <input type="text" name="entidade_rg_conjuge" 	value="" size="13" maxlength="50">
		<br>
              
        <label for="entidade_local_trabalho_conjuge"> Local Trabalho:</label>
        <input type="text" name="entidade_local_trabalho_conjuge" value="" size="32" maxlength="150" placeholder="">
      	 
        <label for="entidade_tempo_local_trabalho_conjuge">Tempo Trabalho:</label>
        <input type="text" name="entidade_tempo_local_trabalho_conjuge" value="" size="13" maxlength="150">
        <br>
        
        <label for="entidade_salario_conjuge">Salário:</label>
        <input type="text" name="entidade_salario_conjuge" value="" size="15" maxlength="150">
        
</fieldset>
