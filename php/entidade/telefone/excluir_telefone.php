<?php 
	//EXCLUIR_ESTADO (Cadastros -> Localidade -> Estados)
	if(isset($_POST['id']) and !empty($_POST['id'])){
		include('../../classes/bd_oracle.class.php'); 
		$id = addslashes($_POST['id']);

		//Formata data
		$sql = "DELETE FROM UF WHERE UFCOD = ".$id;
		
		$result=oci_parse($conecta,$sql);
		if(oci_execute($result)){			
			echo '<span class="delivery_span_email">Estado excluído com sucesso</span>';
		}else{
			echo 'Falha ao Excluir';
		}
	}
	?>
