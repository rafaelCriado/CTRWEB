<?php
	/*===============================================================================================================
				Objetivo		:		Mostrar as fichas tecnicas cadastradas
				Autor			:		Rafael Marques Criado
				Criada em		:		28/01/2013
				modificações	:		
	=================================================================================================================*/
	
	//Sessão
	include('../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../classes/bd_oracle.class.php');
	include('../../functions.php');
	
	//Inicia Sessão
	$sessao = new Session();
	?>
    	<style>
			.tr_selecionada{ background:#09C; color:#fff;} 
        </style>
        <table width="100%" cellpadding="0" cellspacing="0" class="table_ft">
        	<tr>
            	<td colspan="7" class="k-header title">FICHAS TECNICAS</td>
            </tr>
        	<tr>
            	<td>Código</td>
            	<td>Nome</td>
            	<td>Grupo</td>
            	<td>Sub Grupo</td>
            	<td>Empresa</td>
            	<td>Inclusão</td>
            	<td>Usuário</td>
            </tr>
    	<?PHP
			//Consulta as fichas tecnicas existentes
			$sql = 'SELECT FT.EMPCOD       AS CODIGO_EMPRESA,
						   E.EMPNOM        AS EMPRESA,
						   FT.FICTECCOD    AS CODIGO_FICHA_TECNICA,
						   FT.PROCOD       AS CODIGO_PRODUTO,
						   P.PRODES        AS PRODUTO,
						   PG.PROGRUDEN    AS GRUPO,
						   PS.PROSUBGRUDEN AS SUBGRUPO,
						   FT.FICTECDATCAD AS DATA_CADASTRO,
						   FT.FICTECOBS    AS OBSERVACAO_FICHA_TECNICA,
						   FT.USUCOD       AS CODIGO_USUARIO
					  FROM FICHA_TECNICA FT, EMPRESA E, PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS
					 WHERE FT.EMPCOD = E.EMPCOD
					   AND FT.PROCOD = P.PROCOD
					   AND P.PROGRUCOD = PG.PROGRUCOD(+)
					   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD(+)
					   AND FT.EMPCOD = '.$sessao->getNode('empresa_acessada');
			
			//Prepara query
			$query = oci_parse($conecta,$sql);
			
			//executa
			oci_execute($query);
			
			//mostra resultado
			while($ficha = oci_fetch_object($query)){
				?>
                
                <tr class="tr_table_fc_tecnicas" id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>">
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->CODIGO_FICHA_TECNICA; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->PRODUTO; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->GRUPO; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->SUBGRUPO; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->CODIGO_EMPRESA; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->DATA_CADASTRO; ?></td>
                	<td id="<?php echo $ficha->CODIGO_FICHA_TECNICA; ?>"><?php echo $ficha->CODIGO_USUARIO; ?></td>
                </tr>
                                
                
                <?php
			};
		?>
        </table>