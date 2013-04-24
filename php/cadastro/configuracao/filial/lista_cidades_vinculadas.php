<ul>
<?php
	//Lista vinculados 
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
	include('../../../classes/bd_oracle.class.php');
	include('../../../functions.php');
	
	
	if($_REQUEST['id']){
		
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		
		if(!empty($id)){
			
			
			$sql = "SELECT EA.EMPCOD AS EMPRESA_CODIGO, EA.CIDCOD AS CODIGO, (UF.UFABREV||' - '||C.CIDNOM) AS CIDADE FROM EMPRESA_ATUACAO EA, CIDADE C, UF  WHERE EA.CIDCOD = C.CIDCOD AND C.CIDUFCOD = UF.UFCOD AND EMPCOD = ".$id;
			
			$query = oci_parse($conecta,$sql);
			
			if(oci_execute($query)){
				 
				 while($row = oci_fetch_object($query)){
					 
					 echo '<li id="'.$row->CODIGO.'" title="'.$row->CIDADE.'">'.textoFORMAT($row->CIDADE,20).' &nbsp;<a href="#" name="lcv_bt_excluir" title="'.$row->CODIGO.'">Excluir</a></li>';
					 
					 
				 }
				
				
			}
			
			
		}
		
		
		
	}
	
	
?>
</ul>
