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
<form action="carrinho.php" method="POST">
    <?php
       error_reporting(0);
        $id="";
        $produto="";
        $quantidade="";

        $arquivoCarrinho=fopen("carrinho.txt",'r') or die("não produtos no carrinho");

        $x = 0;

        $linha []= fgets($arquivoCarrinho);

    ?>
    <h1>Produtos</h1>

    <table>
        <tr>
            <th>Id</th>
            <th>Produtos</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th>Opções</th>
        </tr>
        <?php
         while(!feof($arquivoCarrinho)){
            $linha []= fgets($arquivoCarrinho);
            $coluna = explode(";",$linha[$x]);
            $id = $coluna[0];
            $produto = $coluna[1];
            $valor = $coluna[2];
            $quantidade = $coluna[3];
        ?>  
        <tr>
            <td id="id" name="id"><?php echo $id?></td>
            <td id="produto" name="produdto"><?php echo $produto?></td>
            <td id="valor" name="valor"><?php echo $valor ?></td>
            <td id="quantidade" name="quantidade"><?php echo $quantidade ?></td>
            <td><a href="Excluir.php">Excluir</a></td>
            <?php $x++;} 
            fclose($arquivoCarrinho); 
            ?>
        </tr>
    </table>
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

        $arquivoCarrinho = fopen("carrinho.txt","r") or die("Houve um problema na sua comprar");
        $arquivoAuxiliar = fopen("auxcarrinho.txt","a") or die("Houve um erro ao ecrever");
        $linhaVet []= fgets($arquivoAuxiliar);
        $x=0;

        while(!feof($arquivoAuxiliar)){

        $linhaVet []= fgets($arquivoAuxiliar);
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
        fclose ($arquivoAuxiliar);
    }
?>

    <?php echo $mensagem ?>
    <br>
</body>
</html>

