<?php 
	error_reporting(0);
	
	//Incluindo banco de dados
	include('../../classes/bd_oracle.class.php');  

	if(isset($_POST['codigo_usuario']) and !empty($_POST['codigo_usuario'])){
		$user = $_POST['codigo_usuario'];
		?>
        <table>
            <tr>
                <td class="k-header">
                	TELAS DE ACESSO 
                    <span style="float:right">
                    	<label for="all_permissao">Todos</label>
                        <input type="checkbox" name="all_permissao" />
                  	</span>
                </td>
                <td class="k-header">ACESSO</td>
                <td class="k-header">INCLUSÃO</td>
                <td class="k-header">ALTERAÇÃO</td>
                <td class="k-header">EXCLUSÃO</td>
            </tr>
			<?php
			
			//Consulta Estados Cadastrados
			$query = oci_parse($conecta, 
				'SELECT 
				  UR.USUCOD AS CODIGO_USUARIO,
				  UR.USUACECOD AS CODIGO_TELAS,
				  UA.USEACEDESC AS TELA,
				  UR.USURESACE AS PERMITE_ACESSO,
				  UR.USURESINC AS PERMITE_INSERTS,
				  UR.USURESALT AS PERMITE_ALTERACAO,
				  UR.USURESEXC AS PERMITE_EXCLUSAO
				 FROM 
				  USUARIO_RESTRICAO UR, USUARIO_ACESSO UA
				 WHERE
				  UR.USUACECOD = UA.USUACECOD AND
				  UR.USUCOD = '.$user.'
				 ORDER BY
				  TELA'
				);
				
			oci_execute($query);
	
			while ($row = oci_fetch_object($query)) {
				?>
				<tr>
					<td><?php echo utf8_encode($row->TELA); ?></td>
					
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="ACE" <?php if($row->PERMITE_ACESSO == 1){ ?> checked="checked" <?php }?>/> 						
                    
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="INC" <?php if($row->PERMITE_INSERTS == 1){ ?> checked="checked" <?php }?> /> 						
							
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="ALT" <?php if($row->PERMITE_ALTERACAO == 1){ ?> checked="checked" <?php }?> /> 						
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="EXC" <?php if($row->PERMITE_EXCLUSAO == 1){ ?> checked="checked" <?php }?>/> 						
                 	</td>
               	</tr>
				<?php
			}
			?>
            	</table>
<?php
	}else if(isset($_POST['grupo']) and !empty($_POST['grupo'])){
		//Lista de telas de acesso por grupo
		$grupo = $_POST['grupo'];
		?>
        <table>
            <tr>
                <td class="k-header">
                	TELAS DE ACESSO 
                    <span style="float:right">
                    	<label for="all_permissao">Todos</label>
                        <input type="checkbox" name="all_permissao" />
                  	</span>
                </td>
                <td class="k-header">ACESSO</td>
                <td class="k-header">INCLUSÃO</td>
                <td class="k-header">ALTERAÇÃO</td>
                <td class="k-header">EXCLUSÃO</td>
            </tr>
			<?php
			
			//Consulta
			$query = oci_parse($conecta, 
				'SELECT 
					  UR.USUGRUCOD AS CODIGO_GRUPO,
					  UR.USUACECOD AS CODIGO_TELAS,
					  UA.USEACEDESC AS TELA,
					  UR.USUGRURESACE AS PERMITE_ACESSO,
					  UR.USUGRURESINC AS PERMITE_INSERTS,
					  UR.USUGRURESALT AS PERMITE_ALTERACAO,
					  UR.USUGRURESEXC AS PERMITE_EXCLUSAO
					 FROM 
					  USUARIO_GRUPO_RESTRICAO UR, USUARIO_ACESSO UA
					 WHERE
					  UR.USUACECOD = UA.USUACECOD AND
					  UR.USUGRUCOD = '.$grupo.'
					 ORDER BY
					  TELA'
				);
				
			oci_execute($query);
	
			while ($row = oci_fetch_object($query)) {
				?>
				<tr>
					<td><?php echo utf8_encode($row->TELA); ?></td>
					
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="ACE" <?php if($row->PERMITE_ACESSO == 1){ ?> checked="checked" <?php }?>/> 						
                    
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="INC" <?php if($row->PERMITE_INSERTS == 1){ ?> checked="checked" <?php }?> /> 						
							
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="ALT" <?php if($row->PERMITE_ALTERACAO == 1){ ?> checked="checked" <?php }?> /> 						
                 	</td>
                    <td>
						<input type="checkbox" name="permissao_<?php echo $row->CODIGO_TELAS?>" value="EXC" <?php if($row->PERMITE_EXCLUSAO == 1){ ?> checked="checked" <?php }?>/> 						
                 	</td>
               	</tr>
				<?php
			}
			?>
            	</table>
<?php
		
		
		
	}else{
		echo '<h1>SELECIONE UM USUÁRIO</h1>';	
	}
    ?>
