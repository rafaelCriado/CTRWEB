<fieldset>
	<legend>Vínculos: </legend>
    
    <span class="span_left" style="width:600px; border:0px solid red; text-align:center;">
    	Gerente de Atendimento: 
		<select name="entidade_pessoa_gerente_atendimento">
        	<option value="">(não cadastrado)</option>
        </select>
        <br>

    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Praça de Pagamento: 
		<select name="entidade_pessoa_praca_pagamento">
        	<option value="">(não cadastrado)</option>
        </select>	
        <br>
	</span>
    <span class="span_left">
    	<br>
		<br>

    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Representante: 
		<select name="entidade_pessoa_representante	">
        	<option value="">(não cadastrado)</option>
            <?php 
				//Pesquisa Representantes Cadastrados
				$sql_representante = "SELECT   E.ENTCOD        AS CODIGO,
											   E.ENTNOM        AS NOME,
											   E.CATENTCODESTR AS CODIGO_CATEGORIA,
											   C.CATENTDESC    AS CATEGORIA
										  FROM ENTIDADE E, CATEG_ENTIDADE C
										 WHERE E.CATENTCODESTR = C.CATENTCODESTR
										   AND C.CATENTCLA = 'REP' AND C.EMPCOD = ". $sessao->getNode('empresa_acessada');
										   
				$query_representante = oci_parse($conecta,$sql_representante);
				
				oci_execute($query_representante);
				
				while($row = oci_fetch_object($query_representante)){
					echo '<option value="'.$row->CODIGO.'">'.$row->NOME.'</option>';
				}
			?>
        </select>
   
    
    	% de Comissão: 
        <input type="text" name="entidade_pessoa_comissao" value="" size="5">
    </span>
</fieldset>