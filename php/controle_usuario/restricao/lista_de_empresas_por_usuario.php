<?php 
	error_reporting(0);
	
	//Inclui banco de dados
	include('../../classes/bd_oracle.class.php');  
	include('../../functions.php');  
	
	
	if(isset($_REQUEST['codigo_usuario']) and !empty($_REQUEST['codigo_usuario'])){
		$user = $_REQUEST['codigo_usuario'];
		?>
        <table>
        	<tr>
            	<td colspan="3" class="k-header"> Empresas Liberadas</td>
                
            </tr>
            <tr>
                <td>RAZÃO SOCIAL</td>
                <td>NOME FANTASIA</td>
                <td></td>
            </tr>
			<?php
			
			//Consulta Estados Cadastrados
			$query = oci_parse($conecta, 
				'SELECT E.EMPCOD CODIGO_EMPRESA, 
					   E.EMPNOM RAZAO, 
					   E.EMPNOMFAN FANTASIA 
				FROM 
					EMPRESA E, 
					USUARIO_EMPRESA UE  
				WHERE 
					UE.EMPCOD = E.EMPCOD 
					AND UE.USUCOD = '.$user
				);
				
			oci_execute($query);
	
			while ($row = oci_fetch_object($query)) {
				?>
				<tr>
					<td title="<?php echo $row->RAZAO;?>"><?php echo textoFORMAT($row->RAZAO,25); ?></td>
                    <td title="<?php echo $row->FANTASIA;?>"><?php echo textoFORMAT($row->FANTASIA,12); ?></td>
                    <td><a href="#" name="restricao_empresa_excluir" id="<?php echo $row->CODIGO_EMPRESA; ?>" title="Excluir <?php echo $row->FANTASIA;?>"><img src="img/excluir.gif"></a></td>
				</tr>
				<?php
			}
			?>
            	</table>
            <?php
	}else if(isset($_REQUEST['grupo']) and !empty($_REQUEST['grupo'])){
		//Lista de empresas por grupo
		$grupo = $_REQUEST['grupo'];
		?>
        <table>
        	<tr>
            	<td colspan="3" class="k-header"> Empresas Liberadas</td>
                
            </tr>
            <tr>
                <td>RAZÃO SOCIAL</td>
                <td>NOME FANTASIA</td>
                <td></td>
            </tr>
			<?php
			
			//Consulta Estados Cadastrados
			$query = oci_parse($conecta, 
				'SELECT E.EMPCOD AS CODIGO_EMPRESA, 
						E.EMPNOM AS RAZAO, 
						E.EMPNOMFAN AS FANTASIA 
				   FROM 
					  	EMPRESA E, 
					  	USUARIO_GRUPO_EMPRESA UG  
				  WHERE 
						UG.EMPCOD = E.EMPCOD 
						AND UG.USUGRUCOD = '.$grupo
				);
				
			oci_execute($query);
	
			while ($row = oci_fetch_object($query)) {
				?>
				<tr>
					<td title="<?php echo $row->RAZAO;?>"><?php echo textoFORMAT($row->RAZAO,25); ?></td>
                    <td title="<?php echo $row->FANTASIA;?>"><?php echo textoFORMAT($row->FANTASIA,12); ?></td>
                    <td><a href="#" name="restricao_empresa_grupo_excluir" id="<?php echo $row->CODIGO_EMPRESA; ?>" title="Excluir <?php echo $row->FANTASIA;?>"><img src="img/excluir.gif"></a></td>
				</tr>
				<?php
			}
			?>
            	</table>
            <?php
		
		
	}else{
		echo '<h1>SELECIONE NOVAMENTE</h1>';	
	}
    ?>
