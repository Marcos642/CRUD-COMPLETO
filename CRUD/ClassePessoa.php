<?php
class Pessoa{
    private $pdo;
    /* CONEXÃO ATRAVEZ DO MÉTODO CONSTRUTOR */ 
    public function __construct($dbname,$host,$user,$password){
        GLOBAL $pdo;
        try {
            $pdo = NEW PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
        } catch (PDOException $e) {
            echo "Erro no banco de dados: ". $e->getMessage();
        } catch(Exception $e){
            echo "Erro: ". $e->getMessage();
        }
    }
    /* TRAZER TODOS OS DADOS DO BANCO */
    public function cadastrarPessoa(){
        GLOBAL $pdo;
        if(isset($_POST["Enviar"])){
            // PEGANDO DADOS DO FORM
            $nome = addslashes($_POST["Nome"]); # addslashes(): Para segurança da informação
            $telefone = addslashes($_POST["Telefone"]);
            $email = addslashes($_POST["Email"]);

            if(!empty($nome) & !empty($telefone) & !empty($email)){ // VERIFICAR SE NÃO TEM DADO VAZIO
                //VERIFICAR SE O USUARIO JÁ ESTA CADASTRADO
                $ver = "SELECT id FROM PESSOA WHERE Email = :e";
                $row = $pdo->prepare($ver);
                $row->bindParam(":e",$email);
                $row->execute();
                if($row->rowCount() > 0){
                    echo "Email já cadastrado";
                }else{
                    // CADASTRAR PESSOA
                    $sql = "INSERT INTO PESSOA(Nome,Telefone,Email) VALUES(:n,:t,:e)";
                    $res = $pdo->prepare($sql);
                    $res->bindParam(":n",$nome);
                    $res->bindParam(":t",$telefone);
                    $res->bindParam(":e",$email);
                    $res->execute();   
                }
            }else{
                echo "Cadastre todos os dados!";
            }
            
        }
    }
    /* EXCLUIR PESSOA */
    public function excluir($id){
        GLOBAL $pdo;
        $sql = "DELETE FROM PESSOA WHERE Id = :id";
        $row = $pdo->prepare($sql);
        $row->bindParam(":id",$id);
        $row->execute();
    }

    /* ATUALIZAÇÃO DE DADOS */
    /* 1 ETAPA: FAZER OS DADOS APARECEREM DENTRO NO INPUT E MUDAR O NOME BOTÃO PARA ATUALIZAR */
    public function dadoVaiParaImput($id){
        GLOBAL $pdo;

        $res = array(); // caso não venha dados do banco
        $sql = "SELECT * FROM PESSOA WHERE Id = :id";
        $row = $pdo->prepare($sql);
        $row->bindParam(":id",$id);
        $row->execute();
        $res = $row->fetch(PDO::FETCH_ASSOC); // ARRAY PARA APENAS UMA PESSOA
        return $res;
    }

    /* 2 ETAPA: ATUALIZAR OS DADOS */
}
