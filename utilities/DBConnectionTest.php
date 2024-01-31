<?php
namespace Test;
use PDO;
use PDOException;

class Connection{
    public $conn = null;

    public function __construct() {
        $this->connect();
    }

    public function connect(): bool {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/identifier.sqlite');

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }

    public function executeQuery($query) {
        $connection = $this->conn;

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->execute();

        $preparedQuery->closeCursor();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function checkIfUserExists($username){
        $connection = $this->conn;

        $query = 'SELECT username FROM Utente where email=? OR username=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $username);
        $preparedQuery->execute();

        $exist= $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        if(!$exist){
            return null;
        }

        return $exist[0];
    }

    //verifica la validità delle credenziali unsate per il login
    public function checkLogin($username,$password){
        $connection = $this->conn;

        $query = 'SELECT count(*) FROM Utente where  username=? AND password=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $password);
        $preparedQuery->execute();

        $exist = $preparedQuery->fetchColumn() > 0;

        $preparedQuery->closeCursor();

        return $exist;
    }

    public function registerNewUser($username, $email, $password, $nome, $cognome, $telefono, $nascita) {
        $connection = $this->conn;

        $query = 'INSERT INTO Utente (username, email, password, nome, cognome, telefono, nascita, usertype) VALUES(?,?,?,?,?,?,?,?)';

        $preparedQuery = $connection->prepare($query);

        $usertype = "BasicUser";

        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $email);
        $preparedQuery->bindValue(3, $password);
        $preparedQuery->bindValue(4, $nome);
        $preparedQuery->bindValue(5, $cognome);
        $preparedQuery->bindValue(6, $telefono);
        $preparedQuery->bindValue(7, $nascita);
        $preparedQuery->bindValue(8, $usertype);

        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getUserPrivilege($username){
        $connection = $this->conn;

        $query = 'SELECT usertype FROM Utente where username=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $type = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        return $type;
    }
}
?>