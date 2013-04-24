<?php
	//Incluir banco de dados
	include('../../classes/bd_oracle.class.php'); 
	
	if($_GET){
		if($_GET['opcao'] == 2){
			//por grupo
			?>
			Grupo:
			<select name="restricao_usuario_grupo">
				<option value="">Selecione..</option>
				<?php
                $query_grupo = oci_parse($conecta, 
                'SELECT USUGRUCOD AS CODIGO, USUGRUDESC AS NOME FROM USUARIO_GRUPO');
                oci_execute($query_grupo);	
                while ($row = oci_fetch_object($query_grupo)) {
                    echo '<option value="'.$row->CODIGO.'">'.$row->NOME.'</option>';
                }
            
				
			echo '</select>';
		}
		if($_GET['opcao'] == 1){
			//por usuario
			?>
            Usuário:
            <select name="restricao_usuario">
                <option value="">Selecione..</option>
                <?php
                    //Consulta Usuarios Cadastrados
                    $query_usuario = oci_parse($conecta, 
                        'SELECT U.USUCOD AS CODIGO, U.USUNOM AS NOME FROM USUARIO U');
                    oci_execute($query_usuario);
                    
                    while ($row = oci_fetch_object($query_usuario)) {
                        echo '<option value="'.$row->CODIGO.'">'.$row->NOME.'</option>';
                    }
                    
                
            echo '</select>';
		}
	}
	
?> 
