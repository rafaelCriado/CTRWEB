<?PHP
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../functions.php');
		
		//Inclui banco de dados
		include('../../../classes/bd_oracle.class.php');
	}
	if($_POST){

		
		$condicao = '';
		
		if(isset($_POST['financeira']) and $_POST['financeira'] != ''){
			$financeira = (int)$_POST['financeira'];
			
			if($financeira != 0){
				$condicao .= ' AND F.FINCOD = '.$_POST['financeira'];
			}else{
				$condicao .= ' AND F.FINCOD IS NULL';
			}
		}

		if(isset($_POST['parcelas']) and !empty($_POST['parcelas'])){
			$condicao .=  ' AND C.CONPAGQTDPAR = '.$_POST['parcelas'];
		}

		if(isset($_POST['carencia']) and !empty($_POST['carencia'])){
			$condicao .= ' AND C.CONPAGDIAPRIPAR = '.$_POST['carencia'];
		}
		
	
		$sql = 'SELECT C.CONPAGCOD       AS CODIGO,
					   C.CONPAGDEN       AS NOME,
					   C.CONPAGQTDPAR    AS "QUANTIDADE DE PARCELAS",
					   C.CONPAGDIAPRIPAR AS "PRIMEIRA PARCELA",
					   F.FINNOM          AS FINANCEIRA
				  FROM COND_PAG C, FINANCEIRAS F
				 WHERE C.EMPCOD = '.$sessao->getNode('empresa_acessada').' AND F.FINCOD(+) = C.FINCOD '.$condicao;
		//echo $sql;
		$campo[0] = 'CODIGO';
		$campo[1] = 'NOME';
		$campo[2] = 'QUANTIDADE DE PARCELAS';
		$campo[3] = 'PRIMEIRA PARCELA';		
		$campo[4] = 'FINANCEIRA';
		
		
		$query = oci_parse($conecta,$sql);
		
		if(oci_execute($query)){
			
			echo '<div id="pcp_table"><table cellpadding="1" cellspacing="1" width="100%" class="pesquisa_condicao_pagamento">';
			
			echo '<tr>';
			for($x = 0; $x < count($campo); $x++ ){
				
				echo '<td><strong>'.$campo[$x].'</strong></td>';
				
				
			}
			echo '</tr>';
			
			while($row = oci_fetch_object($query)){
				echo '<tr id="'.$row->$campo[0].'">';
				
					for($x = 0; $x < count($campo); $x++ ){
						echo '<td>'.str_replace('|','',$row->$campo[$x]).'</td>';
					}
				
				echo '</tr>';
			}
			
			echo '</table></div>';
			
		}
	}
?>