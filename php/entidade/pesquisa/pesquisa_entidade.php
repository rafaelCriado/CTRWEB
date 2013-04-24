<?php 
	error_reporting(0);

	//Sessão
	include('../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../classes/bd_oracle.class.php');
	include '../../functions.php';
	
	//Inicia Sessão
	$sessao = new Session();
	
	//Recebe informações
	if($_POST){
		
		//Recebe variaveis
		$texto 			= strtoupper($_POST['texto']);
		$tipo_pesquisa	= $_POST['tipo_pesquisa'];
		$valor = '';
		//Tipo de Pesquisa
		if($tipo_pesquisa == 'Nome'){
			$valor .= "AND E.ENTNOM LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'N. Fantasia'){
			$valor .= "AND E.ENTNOMFAN LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'Endereco'){
			$valor .= "AND E.ENTEND LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'Cidade'){
			$valor .= "AND C.CIDNOM LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'Codigo'){
			$valor .= "AND E.ENTCOD = $texto";
		}
		if($tipo_pesquisa == 'Telefone'){
			$valor .= "AND E.ENTCOD = $texto";
		}
		if($tipo_pesquisa == 'CPF'){
			$valor .= "AND E.ENTCNPJCPF LIKE '%$texto'";
		}
		
		$sql = "SELECT E.ENTCOD AS CODIGO,
					   E.ENTNOM AS NOME,
					    (E.ENTEND || ' - ' || E.ENTNUM || ' - ' || E.ENTBAI ||' - '|| C.CIDNOM) AS ENDERECO,
					   E.ENTCNPJCPF AS CPF
				  FROM ENTIDADE E, CIDADE C
				 WHERE E.CIDCOD = C.CIDCOD AND E.EMPCOD = ".$sessao->getNode('empresa_acessada')." ".$valor;
				
		//Prepara a consulta
		$query = oci_parse($conecta,$sql);
		
		if(oci_execute($query)){
			echo '    <table id="entidade_pesquisa_aba_dois_table">
						<tr class="k-header">
							<td>Código</td>
							<td>Nome</td>
							<td>Documento</td>
							<td>Endereço</td>
							<td></td>
						</tr>';

			//Recebe informações
			while($prod = oci_fetch_object($query)){
				?>
				<tr id="<?php echo $prod->CODIGO;	?>" class="tr_table_pesquisa_entidade">
					<td><?php echo $prod->CODIGO;	?></td>
                    <td><?php echo $prod->NOME;	?></td>
					<td><?php echo $prod->CPF; 	?></td>
                    <td title="<?php echo $prod->ENDERECO;?>"><?php echo $prod->ENDERECO;?></td>
					<td>
						<a href="#" id="<?php echo $prod->CODIGO;?>" name="pes_ent_bt_vis">Visualizar</a> 
					</td>
				</tr>
				<?php
			}
						
			
		}
		
	}
?>
