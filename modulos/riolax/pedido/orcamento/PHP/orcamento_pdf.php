<?PHP 
	//Classe PDF
	include('../../../../../php/classes/bd_oracle.class.php');
	include('../../../../../php/classes/session.class.php');
	include('../../../../../php/classes/fpdf/fpdf.php');
	
	if($_GET){
		
		$sessao = new  Session();
		
		$orcamentos = isset($_GET['n'])?$_GET['n']:'';
		
		if(!empty($orcamentos)){
				
			//Pesquisa orçamento
			$sql_select_orcamento = "SELECT   O.ORCCOD     AS NUMERO,
											  O.ORCDATCAD  AS DATA_CADASTRO,
											  O.ORCDAT     AS DATA,
											  O.ENTCOD     AS CLIENTE_CODIGO,
											  E.ENTNOM     AS CLIENTE,
											  (E.ENTEND|| ', ' || E.ENTNUM || ' - '|| E.ENTBAI || ', CEP '||E.ENTCEP || ', '||C.CIDNOM|| ' - '||UF.UFNOM) AS ENDERECO,
											  E.ENTEMA	   AS EMAIL, 	
											  O.ORCDATVAL  AS DATA_VENCIMENTO,
											  O.ORCPRAENT  AS PRAZO_ENTREGA,
											  O.CONPAGCOD  AS CONDICAO_PAGAMENTO,
											  O.ORCPERDES1 AS DESCONTO,
											  TO_CHAR(O.ORCVALFRE, '99999999.99')  AS FRETE,
											  O.ORCVALTOT  AS TOTAL,
											  O.USUCOD     AS USUARIO_CODIGO,
											  U.USUNOM     AS USUARIO,
											  O.EMPCOD   AS EMPRESA
											 FROM ORCAMENTO O, ENTIDADE E, USUARIO U, CIDADE C, UF 
											WHERE O.ENTCOD = E.ENTCOD
											AND O.USUCOD = U.USUCOD
											AND E.CIDCOD = C.CIDCOD
											AND C.CIDUFCOD = UF.UFCOD
											AND O.ORCCOD =".$orcamentos;
			
			$sql_orcamento = oci_parse($conecta,$sql_select_orcamento);
			
			if(oci_execute($sql_orcamento)){
				
				$orcamento = oci_fetch_object($sql_orcamento);
				
				//Pesquisa item principal
				$sql_item_principal = "SELECT OI.ORCCOD AS ORCAMENTO,
											   OI.PROCOD AS PRODUTO_CODIGO,
											   PG.PROGRUDEN AS CATEGORIA,
											   PS.PROSUBGRUDEN AS MODELO,
											   (P.PROCOM || 'x' || P.PROLAR || 'x' || P.PROALT) AS MEDIDA,
											   P.PROCAR1 AS LINHA,
											   P.PROMAT AS ACABAMENTO,
											   UPPER(P.PROCOR) AS CORES,
											   P.PROCAR2 AS POSICAO,
											   P.PROCAR3 AS VOLTAGEM,
											   OI.ORCITEPRODES AS PRODUTO_DESCRICAO,
											   OI.ORCITEPROQUA AS QUANTIDADE,
											   OI.ORCITEPROVALUNI AS VALOR,
											   OI.ORCITEDES AS DESCONTO,
											   OI.ORCITEVALTOT AS TOTAL,
											   OI.USUCOD AS USUARIO,
											   OI.EMPCOD AS EMPRESA
										  FROM ORCAMENTO_ITEM OI, PRODUTO P, PRODUTO_GRUPO PG, PRODUTO_SUBGRUPO PS
										 WHERE OI.PROCOD = P.PROCOD
										   AND P.PROGRUCOD = PG.PROGRUCOD
										   AND P.PROSUBGRUCOD = PS.PROSUBGRUCOD
										   AND (P.PROCOR <> '' OR (P.PROCOR IS not  null))
										   AND (P.PROMAT <> '' OR (P.PROMAT IS not  null))
										   AND (P.PROCAR2 <> '' OR (P.PROCAR2 IS not  null))
										   AND (P.PROCAR1 <> '' OR (P.PROCAR1 IS not  null))
										   AND (P.PROCAR3 <> '' OR (P.PROCAR3 IS not  null))
										   AND OI.ORCCOD = ".$orcamentos;
				
				 $item_principal = oci_parse($conecta,$sql_item_principal);
				
				 oci_execute($item_principal);
				 
				 $item_principal = oci_fetch_object($item_principal);
				
	
				//PESQUISA ITENS
				$query_itens_pedido = " SELECT OI.PROCOD AS CODIGO,
											   OI.ORCITEPRODES AS DESCRICAO,
											   OI.ORCITEPROQUA AS QUANTIDADE,
											   OI.ORCITEPROVALUNI AS PRECO,
											   OI.ORCITEVALTOT AS SUBTOTAL
										  FROM ORCAMENTO_ITEM OI
										  WHERE OI.ORCCOD = ".$orcamentos;
										  
				$itens_pedido = oci_parse($conecta,$query_itens_pedido);
				oci_execute($itens_pedido);
					
			}
			$empresa = isset($orcamento->EMPRESA)?$orcamento->EMPRESA:'';
			
			//Verifica se é da mesma empresa e se existe orçamento com esse numero
			if($sessao->getNode('empresa_acessada') == $empresa or !empty($empresa)){
		
				$numero = isset($orcamento->NUMERO)?$orcamento->NUMERO:'';
				$nome = isset($orcamento->CLIENTE)?$orcamento->CLIENTE:'';;
				$email = isset($orcamento->EMAIL)?$orcamento->EMAIL:'';;
				$endereco = isset($orcamento->ENDERECO)?$orcamento->ENDERECO:'';;
				$cep = isset($orcamento->CEP)?$orcamento->CEP:'';;
				$cidade = isset($orcamento->EMPRESA)?$orcamento->EMPRESA:'';;
				$data = isset($orcamento->DATA)?$orcamento->DATA:'';;
				$vencimento = isset($orcamento->DATA_VENCIMENTO)?$orcamento->DATA_VENCIMENTO:'';;
				$estado = isset($orcamento->EMPRESA)?$orcamento->EMPRESA:'';;
				$telefone= isset($orcamento->EMPRESA)?$orcamento->EMPRESA:'';;
				$vendedor = isset($orcamento->USUARIO)?$orcamento->USUARIO:'';;
				$observacoes = '';//isset($orcamento->EMPRESA)?$orcamento->EMPRESA:'';;
		 		$frete =  isset($orcamento->FRETE)?$orcamento->FRETE:'';
				$desconto =  isset($orcamento->DESCONTO)?$orcamento->DESCONTO:'';
		 
				$pdf= new FPDF("P","pt","A4");
				 
				 
				$pdf->AddPage();
				$pdf->Image('../../../../../img/logo_riolax.jpg',-10,-40,-150);
				$pdf->Ln(25); 
				$pdf->SetFont('arial','B',18);
				$pdf->Cell(0,5,"Orcamento",0,1,'C');
				$pdf->Cell(0,5,"","B",1,'C');
				$pdf->Ln(8);
				 
				 
				//ORÇAMENTO
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Numero:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(0,20,$numero,0,1,'L');
				
				//data
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Data:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(310,20,$data,0,0,'L');

				$pdf->SetFont('arial','B',12);
				$pdf->Cell(100,20,"Vencimento:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(0,20,$vencimento,0,1,'L');
				
				
				//nome
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Nome:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(0,20,$nome,0,1,'L');
				
				//Endereço
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Endereco:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$endereco,0,1,'L');
				
				//Vendedor
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Vendedor:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$vendedor,0,1,'L');

				//FRETE
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Frete:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,'R$ '.trim(number_format($frete,2,',','.')),0,1,'L');

				//DESCONTO
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Desconto:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$desconto.'%',0,1,'L');
				$pdf->Cell(0,5,"","B",1,'C');
				
				//Caracteristicas
				$pdf->Ln(26);
				$pdf->SetFont('arial','B',14);
				$pdf->Cell(0,5,"Caracteristicas",0,1,'L');
				$pdf->Cell(0,5,"","B",1,'C');
				$pdf->ln(10);
				
				
				//Descrição
				$pdf->SetFont('arial','B',11);
				$pdf->Cell(80,20,'Descricao:',0,0,"R");
				 
				//linhas da tabela
				$pdf->SetFont('arial','',11);
				$pdf->Cell(445,20,$item_principal->PRODUTO_DESCRICAO,0,1,"L");

				
				//cabeçalho da tabela 
				$pdf->SetFont('arial','B',11);
				$pdf->Cell(80,20,'Categoria',1,0,"L");
				$pdf->Cell(80,20,'Modelo',1,0,"L");
				$pdf->Cell(60,20,'Medida',1,0,"L");
				$pdf->Cell(60,20,'Linha',1,0,"L");
				$pdf->Cell(80,20,'Acabamento',1,0,"L");
				$pdf->Cell(60,20,'Cores',1,0,"L");
				$pdf->Cell(50,20,'Posicao',1,0,"L");
				$pdf->Cell(55,20,'Voltagem',1,1,"L");
				 
				//linhas da tabela
				$pdf->SetFont('arial','',8);
				$pdf->Cell(80,20,$item_principal->CATEGORIA,1,0,"L");
				$pdf->Cell(80,20,$item_principal->MODELO,1,0,"L");
				$pdf->Cell(60,20,$item_principal->MEDIDA,1,0,"L");
				$pdf->Cell(60,20,$item_principal->LINHA,1,0,"L");
				$pdf->Cell(80,20,$item_principal->ACABAMENTO,1,0,"L");
				$pdf->Cell(60,20,$item_principal->CORES,1,0,"L");
				$pdf->Cell(50,20,$item_principal->POSICAO,1,0,"L");
				$pdf->Cell(55,20,$item_principal->VOLTAGEM,1,1,"L");
				
				//Descrição
				$pdf->SetFont('arial','B',11);
				$pdf->Cell(445,20,'Valor:',0,0,"R");
				 
				//linhas da tabela
				$pdf->SetFont('arial','B',11);
				$pdf->Cell(80,20,'R$ '.number_format($item_principal->TOTAL,2,',','.'),0,1,"R");
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				//Fechamentos
				$pdf->Ln(26);
				$pdf->SetFont('arial','B',14);
				$pdf->Cell(0,5,"Opcionais",0,1,'L');
				$pdf->Cell(0,5,"","B",1,'C');
				$pdf->ln(10);
				
				//cabeçalho da tabela 
				$pdf->SetFont('arial','B',11);
				$pdf->Cell(30,20,'Cod.',1,0,"L");
				$pdf->Cell(260,20,'Descricao',1,0,"L");
				$pdf->Cell(80,20,'Valor',1,0,"E");
				$pdf->Cell(80,20,'Qtde',1,0,"E");
				$pdf->Cell(80,20,'Subtotal',1,1,"E");
				 
				//linhas da tabela
				while($itens_pedidos = oci_fetch_object($itens_pedido)){
					if($itens_pedidos->CODIGO != $item_principal->PRODUTO_CODIGO){
						$pdf->SetFont('arial','',8);
						$pdf->Cell(30,20,$itens_pedidos->CODIGO,1,0,"L");
						$pdf->Cell(260,20,$itens_pedidos->DESCRICAO,1,0,"L");
						$pdf->Cell(80,20,number_format($itens_pedidos->PRECO,2,',','.'),1,0,"L");
						$pdf->Cell(80,20,$itens_pedidos->QUANTIDADE,1,0,"L");
						$pdf->Cell(80,20,number_format($itens_pedidos->SUBTOTAL,2,',','.'),1,1,"L");
						
					}
				}
				$pdf->ln(25);
				$pdf->SetFont('arial','B',13);
				$pdf->Cell(450,20,'TOTAL ORCAMENTO: ',0,0,"R");
				$pdf->Cell(80,20,'R$ '.number_format($orcamento->TOTAL,2,',','.'),0,1,"L");
				$pdf->ln(30);
				
				
				
				
				//Observações
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Observacao:",0,1,'L');
				$pdf->setFont('arial','',12);
				$pdf->MultiCell(0,20,$observacoes,0,'J');
				
				 
				$pdf->Output("arquivo.pdf","I");
			}else{
				echo '3';
			}
		}else{
			echo '2';
		}
	}else{
		echo '1';
	}
?>