        <?php 
			header( 'Cache-Control: no-cache' );
			header( 'Content-type: application/xml; charset="utf-8"', true );
			
			include('../../../../../php/classes/bd_oracle.class.php');
			include('../../../../../php/classes/session.class.php');
			$sessao = new Session();
			
			$grupo = $_GET['grupo'];
			$subgrupo = $_GET['subgrupo'];
			$medidas = explode('x',$_GET['medidas']);
			$linhas = $_GET['linhas'];
			$acabamentos = $_GET['acabamentos'];
			$cor = $_GET['cor'];
			//$posicao = $_GET['posicao'];
			
			//$condicoes = "AND PROCAR2 = '" . $posicao . "' AND PROCOR = '" . $cor . "' AND PROCAR1 = '" . $linhas . "' AND PROMAT = '" . $acabamentos . "'";
			$condicoes = '';
			if(isset($medidas[0]) and !empty($medidas[0])){
					$condicoes 	.= "AND PROCOM = " . trim($medidas[0]). " ";
			}
			if(isset($medidas[1]) and !empty($medidas[1])){
					$condicoes 	.= "AND PROLAR = " . trim($medidas[1]). " ";
			}
			if(isset($medidas[2]) and !empty($medidas[2])){
					$condicoes 	.= "AND PROALT = " . trim($medidas[2]). " ";
			}
			$condicoes = '';
			
			
			$kits = array();
			
			$sql = "SELECT PROCOD CODIGO, PRODES DESCRICAO
					  FROM PRODUTO WHERE PROTIP <> 'A'";
					 
			$res = oci_parse($conecta,$sql);
			oci_execute($res);
			while ( $row = oci_fetch_assoc( $res ) ) {
				
				
				//preço 
				$sql_preco = 'SELECT T.TABPRECOD   AS CODIGO_TABELA,
									TP.TABPREDEN   AS TABELA_PRECO,
									T.PROCOD       AS CODIGO,
									T.TABPREITEVAL AS VALOR
							 
							   FROM TABELA_PRECO_ITEM T, TABELA_PRECO TP, CONFIG_EMPRESA CE
							  WHERE TP.TABPRECOD = T.TABPRECOD
								AND TP.TABPRECOD = CE.ORC_TABPRE
								AND CE.EMPCOD = '. $sessao->getNode('empresa_acessada') .'
								AND T.PROCOD = '.$row['CODIGO'];
				
				$query_preco = oci_parse($conecta,$sql_preco);
				
				oci_execute($query_preco);
				
				
				//CONFIGURAÇÃO DE START
				
				$sql_start 		= 'SELECT  CE.CONPAGCOD AS CODICO_CONDICAO,
										   F.FINNOM,
										   FP.FINPARIND AS INDICE
									  FROM CONFIG_EMPRESA       CE,
										   COND_PAG             CP,
										   FINANCEIRAS          F,
										   FINANCEIRAS_PARCELAS FP
									 WHERE CE.CONPAGCOD = CP.CONPAGCOD
									   AND CP.FINCOD = F.FINCOD
									   AND F.FINCOD = FP.FINCOD
									   AND FP.FINPARCAR = CP.FINPARCAR
									   AND FP.FINPARNUM = CP.CONPAGQTDPAR AND CE.EMPCOD = '. $sessao->getNode('empresa_acessada');	
				$query_start	= oci_parse($conecta,$sql_start);
				$start_exe = oci_execute($query_start);
					
					
				$p = '';	
				
				while($tabela = oci_fetch_object($query_preco)){
					
					$val = $tabela->VALOR;
					
					if($start_exe){
						$start = oci_fetch_object($query_start);
					
						if(isset($val)){
							
							if(isset($start->INDICE) and !empty($start->INDICE)){
								
							
								$val += ($val*$start->INDICE)/100;
							
							}
						}
					}
					
					
					
					$p .= $tabela->CODIGO_TABELA. '*'. $tabela->TABELA_PRECO. '*' .number_format($val,2,',','.'). '|';
					
				}
				
				
				
				
				
				
				
				// ====================
				
				
				
				
				$kits[] = array(
					'CODIGO'	=> $row['CODIGO'],
					'DESCRICAO'	=> $row['DESCRICAO'],
					'IMAGEM'	=> '',
					'PRECO'		=> $p
					
				);
				
			}
			
			echo( json_encode( $kits ) );
        ?>