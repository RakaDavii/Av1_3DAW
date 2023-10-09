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
        <?php $x++;} 
        fclose($arquivoProdutos); 
        ?>
    </tr>
</table>
<a href="carrinho.php">Ver Carrinho</a>
<a href="editar.php">Editar</a>
<form action="index.php" method="POST">   
    <br>
    Id do produto:
    <input type="text" name="id" id="id">
    <br>
    Quantidade:
    <input type="number" name="quant" id="quant">
<input type="submit" value="Comprar">
</form>

<?php 
error_reporting(0);
$id = "";
$produto = "";
$valor = "";
$quantidade = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        $quantidade = $_POST['quant'];
        $mensagem = "";

        $arquivoCarrinho = fopen("carrinho.txt","a") or die("Houve um problema na sua comprar");
        $arquivoProdutos = fopen("produtos.txt","r");
        $linhaVet []= fgets($arquivoProdutos);
        $x=0;

        while(!feof($arquivoProdutos)){

        $linhaVet []= fgets($arquivoProdutos);
        $coluna = explode(";",$linhaVet[$x]);

            if($coluna[0]==$id){
                $produto = $coluna[1];
                $valor = $coluna[2];

                $mensagem = "Compra realizado com sucesso";
                
                $linha = "id;produto;valor;quantidade";
                $linha = $id . ";" . $produto . ";" . $valor . ";" . $quantidade . "\n";
                fwrite($arquivoCarrinho, $linha);
            }
        $x++;
        }
        
        fclose ($arquivoCarrinho);
        fclose ($arquivoProdutos);
    }
?>

    <?php echo $mensagem ?>
    <br>
</body>
</html>