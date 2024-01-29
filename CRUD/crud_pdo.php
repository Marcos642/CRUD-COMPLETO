<?php
class MYCRUD{
    public $pdo;
// CONEXÃO COM BANCO DE DADOS
public function conectar($host,$user,$dbname,$password){
    GLOBAL $pdo;
    try {
        $pdo = NEW PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
    } catch (PDOException $e) {
        echo "Erro com banco de dados: ".$e->getMessage();
    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}

}