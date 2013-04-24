<style>
	#excluir{ text-decoration:none;}
</style>

<?php 
	error_reporting(0);
	include('../../classes/bd_oracle.class.php'); 
	include('../../functions.php'); 
?>

<table cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="4" class="k-header title">
           Tabelas de Preço
        </td>
    </tr>
    <tr>
        
        <td><strong>Cód.</strong></td>
        <td><strong>Desc.</strong></td>
        <td><strong>Índ. de venda</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Tabelas de Preço Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
				  EMPCOD AS EMPRESA, 
				  TABPRECOD AS CODIGO, 
				  TABPREDEN AS NOME,
				  TABPREINDVEN AS INDICE
			 FROM 
			 	  TABELA_PRECO
		     WHERE
			 	  EMPCOD = '.$sessao->getNode('empresa_acessada'));
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr id="<?php echo $row->CODIGO; ?>">
                <td><?php echo utf8_encode($row->CODIGO); ?></td>
                <td title="<?php echo $row->NOME; ?>"><?php echo textoFORMAT($row->NOME,15); ?></td>
                <td><?php echo $row->INDICE; ?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO; ?>" name="new_tab_preco_bt_aplicar" title="Ao clicar você estará gerando os preços de todos os produtos para esta tabela de preço mediante ao indice cadastrado">
                        Aplicar Índice
                    </a>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO; ?>" name="new_tab_preco_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="excluir" name="new_tab_preco_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>