
<?php 

	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../functions.php');
		
		//Inclui banco de dados
		include('../../classes/bd_oracle.class.php');
	}

?>

<table width="100%">
    <tr>
        <td colspan="4" class="k-header title">
           Categorias Cadastradas
        </td>
    </tr>
    <tr>
        <td><strong>Código</strong></td>
        <td><strong>Descrição</strong></td>
        <td><strong>Categoria</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Tipos de Entidade Cadastrados
		$query = oci_parse($conecta, 
			"SELECT CATENTCODESTR AS CODIGO,
				   	CATENTDESC AS DESCRICAO,
				   	USUCOD AS USUARIO,
			   CASE 
				   	WHEN CATENTCLA = 'REP' THEN 'REPRESENTANTES'
				   	WHEN CATENTCLA = 'OUT' THEN 'OUTROS'
				   	WHEN CATENTCLA = 'CLI' THEN 'CLIENTES'
				   	WHEN CATENTCLA = 'TRA' THEN 'TRANSPORTADORAS'
				   	WHEN CATENTCLA = 'FOR' THEN 'FORNECEDORES'
			   END AS CATEGORIA     
			  FROM 	CATEG_ENTIDADE
			 WHERE EMPCOD = ".$sessao->getNode('empresa_acessada'));
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
                <td title="<?php echo $row->CODIGO; ?>"><?php echo substr($row->CODIGO,0,5); ?></td>
                <td title="<?php echo $row->DESCRICAO; ?>"><?php echo substr($row->DESCRICAO,0,22); ?></td>
                <td><?php echo utf8_encode($row->CATEGORIA)?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="novo_tipo_entidade_bt_alterar" title="<?php echo $row->CODIGO_CIDADE;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="novo_tipo_entidade_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>