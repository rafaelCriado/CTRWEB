<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
		<style>
			img{ border:0px;}
			.divPassoaPasso{
				border:1px solid #CCC; 
				float:left; 
				width:100%; 
				height:10%; 
				line-height:100%; 
				font-family:Arial, Helvetica, sans-serif; 
			}
			#container-3passo{ float:left;}
			#orc_prod_selecionado{ height:235px;}
			.divOrcamentoLateral{border:2px solid #ccc; float:left; width:29%; height:87%; margin-top:1px; box-shadow:#eee 3px 3px}
			.divPassoaPasso span{ line-height:50px; margin:0 50px; color:#CFCFCF; height:100px !important; font-size:16px; font-weight:bold}
			
			span.passo_selecionado{ color:#039;}
			.or-item{ width:32%; float:left; margin-left:5px; margin-bottom:10px; height:45%}
			.item_imagens_maior{ height:100%; border:3px solid #666; width:240px; float:left;}
			.primeiro_passo{ border:0px solid red; float:left; width:auto; height:100%; width:100%; overflow:auto; display:inline; margin:0px; padding:0px;}
			.segundo_passo{ border: 0px solid red;float: left;width: 100%;height: 100%;display: none;overflow: auto;margin: 0px;padding: 0px;}

        </style>
    </head>
    <body>
    
        <!-- DIV  1º Passo-->
		<div class="primeiro_passo" >
        	<div id="divPassoaPasso"><strong>Categorias</strong></div>
			<?php 
                function img_existe($nome_imagem){
                    $caminho = 'img/grupos/';
                    $img = $nome_imagem.'.jpg';
                    if(file_exists($caminho.$img)){
                        return ''.$img;
                    }else{
                        return "img_indisponivel.jpeg";
                    }
                }
                
                function thumb_prod($codigo_produto){
                    $diretorio = 'img/grupos';
                    $img = $codigo_produto.'.jpg';
                    
                    // abre o diretório
                    $ponteiro  = opendir($diretorio);
                    while ($nome_itens = readdir($ponteiro)) {
                        $itens[] = $nome_itens;
                    }
                    
                    sort($itens);
                    
                    foreach ($itens as $listar) {
                        // retira "./" e "../" para que retorne apenas pastas e arquivos
                           if ($listar!="." && $listar!=".."){ 
                        
                        // checa se o tipo de arquivo encontrado é uma pasta
                                if (is_dir($listar)) { 
                        // caso VERDADEIRO adiciona o item à variável de pastas
                                    $pastas[]=$listar; 
                                } else{ 
                        // caso FALSO adiciona o item à variável de arquivos
                                    $arquivos[]=$listar;
                                }
                           }
                    }
                    
                    if ($arquivos != "") {
                        foreach($arquivos as $listar){
                            $nome = explode('.',$listar);
                            $num = count($nome);
                            
                            
                            if($nome[0] == $codigo_produto){
                                //print " Arquivo: <a href='$listar'>$listar</a><br>";
                            }else{
                                $nomes = explode('[',$nome[0]);
                                if($nomes[0] == $codigo_produto){
                                    print '<a href="img/grupos/'.$listar.'" rel="lightbox" title="" ><img width="83px" height="65px" src="img/produtos/'.$listar.'" style="float:left; border:1px solid #ccc;"></a>';
                                }
                            
                            }
                        }
                    }
                }
                
                //Consulta produtos
                $sql_produtos = 'SELECT PROGRUCOD AS CODIGO, PROGRUDEN AS DESCRICAO FROM PRODUTO_GRUPO ORDER BY CODIGO';
                $query_produtos = oci_parse($conecta, $sql_produtos);
                oci_execute($query_produtos);
                
                while($rows = oci_fetch_object($query_produtos)){
                    ?>
                    <div class="or-item">
                            <div class="item_imagens_maior">
                                <a href="#" name="tela_produtos_categoria" id="<?php echo $rows->CODIGO;?>" title="<?php echo $rows->DESCRICAO?>" ><img width="100%" height="100%" src="img/grupos/<?php echo img_existe($rows->CODIGO);?>"></a>
                            </div>
                        
                    </div>
                    <?php
                }
            ?>
        </div>
        <!-- FIM 1ºPASSO -->
		
        <!-- div 2º passo -->
        <div class="segundo_passo">
        	
        </div>
        <!-- fim 2º passo-->        


        <!-- div 3º passo -->
        <div class="terceiro_passo">
        	
        </div>
        <!-- fim 3º passo-->        
    </body>
</html>