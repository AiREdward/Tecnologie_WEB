<?php
namespace Test;
use PDO;
use PDOException;

/*
 *
 * File di testing locale
 *
 */

class Connection{
    public $conn = null;

    public function __construct() {
        $this->connect();
    }

    public function connect(): bool {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/testingDB.sqlite');

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function closeConnection(): void {
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

    public function checkIfUserExists($username) : ?string {
        $connection = $this->conn;

        $query = 'SELECT username FROM Utente where email=? OR username=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $username);
        $preparedQuery->execute();

        $exist = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        if(!$exist) return null;

        return $exist[0]["username"];
    }

    //verifica la validità delle credenziali unsate per il login
    public function checkLogin($username, $password) : bool {
        $connection = $this->conn;

        $query = 'SELECT count(*) FROM Utente WHERE username=? AND password=?';

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

    public function isUserAdmin($username) : bool {
        $connection = $this->conn;

        $query = 'SELECT admin FROM Utente WHERE username=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $type = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        if($type == 1) return true;
        else return false;
    }
    public function InserisciPrenotazione($username,$data_,$orario,$id_room){
        $connection=$this->conn;
        $query='INSERT INTO Prenota (data_, orario, username,id_room)VALUES(?,?,?,?)';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            'ssss',
            $data_,
            $orario,
            $username,
            $id_room
        );
        $res=$preparedQuery->execute();
        $preparedQuery->close();
        return $res;
    }
    public function CheckSlotDisponibili($data_,$id_room){
        $connection=$this->conn;
        $query='SELECT orario FROM SlotPrenotabili WHERE orario NOT IN(select orario From Prenota where data_=? AND id_room=? )';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            'ss',
            $data_,
            $id_room
        );
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $out=[];
        $i=0;
        while($row = $res->fetch_assoc()){
            $out[$i]=$row["orario"];
            $i++;
        }
        $preparedQuery->close();
        return $out;
    }
    public function GetTuttePrenotazioni(){
        $connection=$this->conn;
        $query='SELECT data id_prenotazione data_ orario username id_room FROM Prenota';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $out=[];
        $i=0;
        while($row = $res->fetch_assoc()){
            $out[$i]=$row;
            $i++;
        }
        $preparedQuery->close();
        return $out;
    }
    public function GetPrenotazioniUtente($username){
        $connection=$this->conn;
        $query='SELECT id_prenotazione data_ orario id_room FROM Prenota where username=?';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            's',
            $username
        );
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $out=[];
        $i=0;
        while($row = $res->fetch_assoc()){
            $out[$i]=$row;
            $i++;
        }
        $preparedQuery->close();
        return $out;
    }
}
?>