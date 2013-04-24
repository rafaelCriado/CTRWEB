<?php
	/*===============================================================================================================
				Objetivo		:		Retorna os itens de uma determinada ficha tecnica.
				formato			:		HTML
				Autor			:		Rafael Marques Criado
				Criada em		:		28/01/2013
				modificações	:		
	================================================================================================================= */
?>
    <input type="image" name="insert_item_ficha" src="img/add.png" >
    <table width="100%" id="tb_itens_ficha">
        <tr>
            <td>Cód. Prod</td>
            <td>Quantidade</td>
            <td>Produto</td>
            <td>Usuário</td>
            <td></td>
        </tr>
        
        
        
    
<?php
	error_reporting(0);

	//Inclui banco da dados e funções
	include('../../../php/classes/bd_oracle.class.php');
	
	if($_POST){
		$ficha = $_POST['ficha_tecnica'];
		
		
		$sql = 'SELECT 	FT.EMPCOD 			AS EMPRESA, 
						FT.FICTECCOD 		AS CODIGO_FICHA_TECNICA, 
						FT.PROCOD 			AS CODIGO_PRODUTO,
						P.PRODES			AS PRODUTO, 
						FT.FICTECITEQTD 	AS QUANTIDADE, 
						FT.USUCOD 			AS USUARIO
  				  FROM 
				  		FICHA_TECNICA_ITEM FT, PRODUTO P
				 WHERE	
				 		FT.PROCOD = P.PROCOD
				   AND	FT.FICTECCOD		= '.$ficha;
		
		$query = oci_parse($conecta, $sql);
		
		oci_execute($query);
			
			
		while($row = oci_fetch_object($query)){
			
			echo '<tr>';
			echo 	'<td>'.$row->CODIGO_PRODUTO.'</td>';
			echo 	'<td>'.$row->QUANTIDADE.'</td>';
			echo 	'<td>'.$row->PRODUTO.'</td>';
			echo 	'<td>'.$row->USUARIO.'</td>';
			echo 	'<td><a href="#" name="itens_ft_excluir" >Excluir</a> <a href="#" name="itens_ft_alterar" >Alterar</a></td>';
			echo '</tr>';
		}
			
		
	}
?>
    </table>	
        </form>	