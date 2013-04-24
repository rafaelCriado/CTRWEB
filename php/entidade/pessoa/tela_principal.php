<form action="php/entidade/pessoa/add_nova_entidade_pessoa.php" name="add_entidade" method="post">
    
    <span class="entidade_ativo">
        <input type="checkbox" name="entidade_ativo" value="1" checked> Ativo
    </span>

    <span class="entidade_categoria_codigo">
        <label for="entidade_categoria_codigo">Tipo: </label>
        <select name="entidade_categoria_codigo">
            <?php
                //Consulta Categorias dos Clientes
                $query_categorias = oci_parse($conecta,"SELECT CATENTCODESTR AS CODIGO, CATENTDESC AS DESCRICAO, CATENTCLA AS CLASSIFICACAO FROM CATEG_ENTIDADE WHERE EMPCOD = ".$sessao->getNode('empresa_acessada'));
                oci_execute($query_categorias);

                //Lista as categorias 
                while($tipo = oci_fetch_object($query_categorias)){
                    echo '<option value="'.$tipo->CODIGO.'">'.$tipo->DESCRICAO.'</option>';										
                }
            ?>
        </select>
        
    </span>
    
    
    <fieldset>
        <legend>Dados Principais: </legend>
        
        <span class="span_left">
            Código:<br>
            <input type="text" name="entidade_codigo_pessoa" size="10" disabled>
            <input type="hidden" name="entidade_codigo_pessoa_usado" size="10">
        </span>
        
        <span class="span_left">
            Nome/Razão Social:<br>
            <input type="text" name="entidade_nome" value="" size="60" maxlength="150">
        </span>
        
        <span class="span_left">
            Apelido/Nome Fantasia:<br>
            <input type="text" name="entidade_fantasia" value="" size="40" maxlength="150">
        </span>
        
    </fieldset> 
    
    
    
    <fieldset>
        <legend>Contato: </legend>
        
        <span class="span_left">
            Telefone Comercial:<br>
            <input type="text" name="entidade_fone_comercial" value="" size="20" maxlength="12" placeholder="(99)9999999">
        </span>
        
        <span class="span_left">
            Celular:<br>
            <input type="text" name="entidade_fone_celular" value="" size="20" maxlength="12" placeholder="(99)9999999">
        </span>
        
        <span class="span_left">
            Residencial:<br>
            <input type="text" name="entidade_fone_residencial" value="" size="20" maxlength="12" placeholder="(99)9999999">
        </span>
        
        <span class="span_left">
            Pessoa para Contato: <br>
            <input type="text" name="entidade_contato" value="" size="44" maxlength="150">
        </span>
    </fieldset>
    
    
    
    <fieldset>
        <legend>Endereço: </legend>
        
        <span class="span_left">
            Endereço:<br>
            <input type="text" name="entidade_endereco" value="" size="45" maxlength="200">
        </span>
        
        <span class="span_left">
            Número:<br>
            <input type="text" name="entidade_numero" value="" size="5" maxlength="10">
        </span>
    
        <span class="span_left">
            Bairro: <br>
            <input type="text" name="entidade_bairro" value="" size="31" maxlength="50">
        </span>
        
        <span class="span_left" >
            CEP: <br>
            <input type="text" name="entidade_cep" value="" size="23" maxlength="9" placeholder="XXXXX-XXX">
        </span>
        
        <br>

        
        <span class="span_left">
            Estado:<br>
            <select name="entidade_estado">
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
        
            <select name="entidade_cidade">
                <option value="">-- Escolha um estado --</option>
            </select>
        </span>
        
        <span class="span_left" style="width:400px; border:0px solid red; height:40px"></span>
       
        <span class="span_left">
            E-mail:<br>
            <input type="text" name="entidade_email" value="" size="58" maxlength="150">
        </span>
        
        <span class="span_left">
            Site:<br>
            <input type="text" name="entidade_site"  value="" size="58" maxlength="150">
        </span>

    </fieldset>
    
    
    
    <fieldset style="margin-top:5px;">
        <span class="span_left">
            Pessoa:<br>
            <select name="entidade_tipo_pessoa">
                <option value="FISICA">FÍSICA</option>
                <option value="JURIDICA">JURÍDICA</option>
            </select>
        </span>
        
        
        <span class="span_left">
            <span id="entidade_rg">RG nº:</span> <br>
            <input type="text" name="entidade_rg" value="" size="20" maxlength="150">
        </span>
        
        <span class="span_left">
            <span id="cnpj_cpf">CPF: </span><br>
            <input type="text" name="cnpj_cpf" value="" size="16" maxlength="14">                        	
        </span>
        
        <span class="span_left">
            <span id="entidade_nascimento">Data de Nascimento:</span><br>
            <input type="text" name="entidade_nascimento" value="" size="20" maxlength="10" placeholder="XX/XX/XXXX">
        </span>
        
    </fieldset>  

    
    <input type="hidden" name="entidade_tipo_pessoa" value="FISICA">
    <br>
    
    
    <!-- Inicio DIV entidade -->
    <div id="entidade">
        <?php //include('php/entidade/pessoa/form_pessoa_fisica.php'); ?>
    </div>
    <!-- Fim DIV entidade --> 

