<?php
    require_once 'ClassePessoa.php'; /* Chamando a classe */
    $c = new Pessoa("meuBancoCrud","localhost","root","1714");
    $c->cadastrarPessoa();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <section id="esquerda">
        <form method="POST">
            <h2>Cadastrar Pessoa</h2>
            <label for="Nome">Nome</label>
                <input type="text" name="Nome" id="Nome">
            <label for="Telefone">Telefone</label>
                <input type="text" name="Telefone" id="Telefone">
            <label for="Email">Email</label>
                <input type="email" name="Email" id="Email">

                <input type="submit" name="Enviar" value="Cadastrar">
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo"> <!-- LINHA -->
                <td>Nome</td> <!-- COLUNA -->
                <td>Telefone</td>
                <td colspan="2">Email</td> <!-- colspan="2" ocupa duas colunas -->
            </tr>
            <?php
               $sql = "SELECT * FROM PESSOA";
               $resultado = $pdo->query($sql);
               
               if ($resultado->rowCount() > 0) {
                   // Exibir os dados
                   while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr> <!-- LINHA -->
                        <td><?= $linha['Nome'] ?></td> <!-- COLUNA --> 
                        <td><?= $linha['Telefone'] ?></td>
                        <td><?= $linha['Email'] ?></td>
                        <td><a href="#">Editar</a> <a href="#">Excluir</a></td>
                    </tr>
                    <?php
                   }
               }else{
                    echo "Sem dados";
               }
            ?>
        </table>
    </section>
</body>
</html>