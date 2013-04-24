<?php
	error_reporting(0);
	include('../../../../../php/classes/bd_oracle.class.php');
	
	$grupo  = $_POST['grupo'];
	$nGrupo = $_POST['nGrupo'];

?>

<div id="divPassoaPasso"><strong>Modelo</strong></div>
<?php 
function img_existeg($nome_imagem){
    $caminho = '../../../../../img/grupos/subgrupo/';
    $img = $nome_imagem.'.jpg';
    if(file_exists($caminho.$img)){
        return ''.$img;
    }else{
        return "img_indisponivel.jpeg";
    }
}

function thumb_prodg($codigo_produto){
    $diretorio = 'img/grupos/subgrupo';
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
                    print '<a href="#" title="" ><img width="83px" height="65px" src="img/produtos/'.$listar.'" style="float:left; border:1px solid #ccc;"></a>';
                }
            
            }
        }
    }
}

//Consulta produtos
$sql_produtos = 'SELECT PROSUBGRUCOD AS CODIGO, PROSUBGRUDEN AS DESCRICAO, PROGRUCOD AS GRUPO FROM PRODUTO_SUBGRUPO WHERE PROGRUCOD = '. $grupo;
$query_produtos = oci_parse($conecta, $sql_produtos);
oci_execute($query_produtos);

while($rows = oci_fetch_object($query_produtos)){
    ?>
<div class="or-item">
  <div class="item_imagens_maior"> <a href="#" name="tela_produtos_subcategoria" id="<?php echo $grupo.'|'.$rows->CODIGO;?>" title="<?php echo $nGrupo.' | '.$rows->DESCRICAO?>" ><img width="100%" height="100%" src="img/grupos/subgrupo/<?php echo img_existeg($rows->CODIGO);?>"></a> </div>
</div>
<?php
}
?>
<input type="input" name="bt_po_voltar_1" value="Voltar" class="k-button"  style="position:absolute; top:12px; right:30px;"/>
