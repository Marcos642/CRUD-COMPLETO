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
    public function retornaDados(){
       
        }
}
