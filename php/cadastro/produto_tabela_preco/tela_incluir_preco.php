<?php 
	//Inclui banco de dados
	include "../../classes/bd_oracle.class.php"; 
	
	//Inclui sessão
	include "../../classes/session.class.php"; 
	$sessao = new Session();
	
	//Inclui as funções principais
	include '../../functions.php';
	
?>



<div id="incluir_preco_tabela" class="k-header">

	<h3>Incluir Preços</h3>
	<form name="form_incluir_preco">
		
        Tabela de Preços
		<select name="incluir_preco_tabelas">
        	<option value="0">Escola uma Tabela</option>
        	<?php
				//Consulta as tabelas cadastradas ==========================================================
				$sql_tabelas_preco = 'select tabprecod AS CODIGO, tabpreden AS DESCRICAO from tabela_preco';
				
				//Prepara query
				$query_tabela_preco = oci_parse($conecta, $sql_tabelas_preco);
				
				//Execut query
				oci_execute($query_tabela_preco);
				
				//Mostra o resultado
				while($tabela_preco = oci_fetch_object($query_tabela_preco)){
					
					//Cria os options do select
					echo '<option value="'.$tabela_preco->CODIGO.'" title="'.$tabela_preco->DESCRICAO.'">';
					echo textoFORMAT($tabela_preco->DESCRICAO,13).'</option>';
					
				}
				//Fim da Consulta ==========================================================================
			?>
        </select>    	
        <br>

		
        <input type="button" value="Produtos" name="incluir_preco_bt_escolha_prod" class="k-button">
        
        <fieldset>
        	<legend>Produto:</legend>
            <input type="text" disabled name="incluir_preco_produto" value="">
            <input type="hidden" name="incluir_preco_codigo_produto" value="">
        </fieldset>
        
        <br>

		<input type="button" name="incluir_preco_bt_gravar" class="k-button" value="Gravar">

    </form>
</div>	