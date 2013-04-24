        <?php 
			header( 'Cache-Control: no-cache' );
			header( 'Content-type: application/xml; charset="utf-8"', true );
			
			include('../../classes/bd_oracle.class.php');
			
			$entidade_empresa = $_GET['entidade_empresa'];
			//$entidade_empresa = 4;
			
			$grupos = array();
			
			$sql = "SELECT
						   	PROGRUCOD AS CODIGO,
						   	PROGRUDEN AS DESCRICAO
					  FROM 
					  		PRODUTO_GRUPO
					 WHERE 	
					 		EMPCOD = ".$entidade_empresa;
			$res = oci_parse($conecta,$sql);
			oci_execute($res);
			while ( $row = oci_fetch_assoc( $res ) ) {
				$grupos[] = array(
					'entidade_grupo'	=> $row['CODIGO'],
					'nome'				=> $row['DESCRICAO'],
				);
			}
			//print_r($grupos);
			echo( json_encode( $grupos ) );
        ?>
