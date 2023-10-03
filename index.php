<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>
        table, th, td {
        border:1px solid black;
        }
        table{
            width: 100%;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Avarrenta</title>
</head>
<body>
<form action="index.php" method="POST">
    <?php
       error_reporting(0);
        $id="";
        $produto="";
        $quantidade="";

        $arquivoProdutos=fopen("produtos.txt",'r') or die("não produtos no carrinho");

        $x = 0;

        $linha []= fgets($arquivoProdutos);

    ?>
    <h1>Produtos</h1>

    <table>
        <tr>
            <th>Id</th>
            <th>Produtos</th>
            <th>Valor</th>
            <th>Quantidade</th>
            
        </tr>
        <?php
         while(!feof($arquivoProdutos)){
            $linha []= fgets($arquivoProdutos);
            $coluna = explode(";",$linha[$x]);
            $id = $coluna[0];
            $produto = $coluna[1];
            $valor = $coluna[2];
        ?>  
        <tr>
            <td id="id" name="id"><?php echo $id?></td>
            <td id="produto" name="produdto"><?php echo $produto?></td>
            <td id="valor" name="valor"><?php echo $valor ?></td>
            <td id="quantidade" name="quantidade"><input type="number"><input type="submit" value="Concluir"></td>
            <?php $x++;} ?>
        </tr>
    </table>
</form>

</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];
    $produto = $_POST['produto'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $mensagem = "";

    echo "id: " . $id . "produto: " . $produto . "valor: " . $valor . "quantidade: " . $quantidade;

    $arquivoCarrinho= fopen("carrinho.txt","w") or die("Houve um problema na sua comprar");
    
    $linha = "id;produto;valor;quantidade";
    $linha = $id . ";" . $produto . ";" . $valor . ";" . $quantidade . "\n";

    fwrite($arquivoCarrinho, $linha);
    fclose ($arquivoCarrinho);
}

?>
