<?php
namespace Test;
use PDO;
use PDOException;

/*
 *
 * File di testing locale con sqlite
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

        $query = 'SELECT Username FROM Utente where Username=? OR Email=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $username);
        $preparedQuery->execute();

        $exist = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        if(!$exist) return null;

        return $exist[0]["Username"];
    }

    public function checkLogin($username, $password) : bool {
        $connection = $this->conn;

        $query = 'SELECT count(*) FROM Utente WHERE Username=? AND Password=?';

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

        $query = 'INSERT INTO Utente (Username, Email, Password, Nome, Cognome, Telefono, Data_di_Nascita, Admin) VALUES(?,?,?,?,?,?,?,?)';

        $preparedQuery = $connection->prepare($query);

        $usertype = "BasicUser";

        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $email);
        $preparedQuery->bindValue(3, $password);
        $preparedQuery->bindValue(4, $nome);
        $preparedQuery->bindValue(5, $cognome);
        $preparedQuery->bindValue(6, $telefono);
        $preparedQuery->bindValue(7, $nascita);
        $preparedQuery->bindValue(8, false);

        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function isUserAdmin($username) : bool {
        $connection = $this->conn;

        $query = 'SELECT Admin FROM Utente WHERE Username=?';

        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $type = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        if($type == 1) return true;
        else return false;
    }

    public function getRooms() {
        $conn = $this->conn;

        $query = 'SELECT * FROM Room';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getRoomsEnglish() {
        $conn = $this->conn;

        $query = 'SELECT * FROM RoomTranslated';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function inserisciPrenotazione($data, $ora, $username, $id_room) {
        $conn = $this->conn;

        $query='INSERT INTO Prenota (Data_Prenotazione, Ora_Prenotazione, Username, ID_Room) VALUES (?,?,?,?)';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $data);
        $preparedQuery->bindValue(2, $ora);
        $preparedQuery->bindValue(3, $username);
        $preparedQuery->bindValue(4, $id_room);
        $res = $preparedQuery->execute();

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