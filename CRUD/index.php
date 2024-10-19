<?php
    require_once 'ClassePessoa.php'; /* Chamando a classe */
    $c = new Pessoa("meuBancoCrud","localhost","root","");

    // PEGAR O GET E APAGAR LINHA NA TABELA
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $c->excluir($id);
        header('Location: index.php');
    }
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
    <?php
    // VERIFICAR A EXISTENCIA DO ID PARA JOGAR DADOS NO INPUT
    if(isset($_GET['id_up'])){
        $id = $_GET["id_up"];
        $res = $c->dadoVaiParaImput($id); # $res tem os dados que serão distribuidos nos inputs
    }

    // VERIFICAR A EXISTENCIA DO ID PARA ATUALIZAR
    if(isset($_GET['id_up']) && isset($_POST['Editar'])){
        $Id = $_GET['id_up']; 
        $Nome = $_POST['Nome']; 
        $Telefone = $_POST['Telefone']; 
        $Email = $_POST['Email']; 
        $c->atualizar($Id,$Nome,$Telefone,$Email);
        header('Location: index.php');
    }else{ // SE O ID $_GET['id_up'] NÃO EXISTE É PORQUE SERA FEITO APENAS UM CADASTRO
        $c->cadastrarPessoa();
    }
    ?>
    <!----------------------- SESSÃO DE CADASTRO E ATUALIZAÇÃO DE DADOS ----------------------->
    <section id="esquerda">
        <form method="POST">
            <h2>Cadastrar Pessoa</h2>
            <label for="Nome">Nome</label>
                <input type="text" name="Nome" id="Nome" 
                    value="<?php
                            if(isset($res)){ # acima esta a explicação da variavel $res
                                echo $res['Nome']; #exibir oque etá na posição nome
                            }?>">
            <label for="Telefone">Telefone</label>
                <input type="text" name="Telefone" id="Telefone"
                value="<?php
                            if(isset($res)){ # acima esta a explicação da variavel $res
                                echo $res['Telefone']; #exibir oque etá na posição telefone
                            }?>">
            <label for="Email">Email</label>
                <input type="email" name="Email" id="Email"
                    value="<?php
                            if(isset($res)){ # acima esta a explicação da variavel $res
                                echo $res['Email']; #exibir oque etá na posição email
                            }?>">

                <input type="submit" value="Cadastrar" name="<?php 
                    if(isset($res)){
                        echo "Editar";
                    }
                    else{
                        echo"Cadastrar";
                    }
                ?>">
        </form>
    </section>
    <!----------------------- SESSÃO DE EXIBIÇÃO DE DADOS ----------------------->
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
                        <td>
                            <!-- PEGAR O ID E ENVIAR VIA GET / ATUALIZAÇÃO FEITA EM CIMA -->
                            <a href="index.php?id_up=<?= $linha['Id'] ?>">Editar</a> 
                            <!-- PEGAR O ID E ENVIAR VIA GET / EXCLUSÃO FEITA EM BAIXO -->
                            <a href="index.php?id=<?= $linha['Id'] ?>">Excluir</a>
                        </td>
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