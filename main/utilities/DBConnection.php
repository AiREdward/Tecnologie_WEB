<?php
class Connection{
    //Variabili di connessione al database
    const HOST = "localhost";
    const USERNAME = "root";
    const PASS = "";
    const DATABASE = "enigma";

    public $conn = null;

    //Apre la connessione restituendo true se è andata a buon fine altrimenti false
    public function apriConnessione(){
        $this->conn = new mysqli(Connection::HOST, Connection::USERNAME, Connection::PASS, Connection::DATABASE);
        if(!$this->conn->connect_errno)
            return true; //Connessione avvenuta con successo
        else
            return false; //Connessione fallita
    }

    public function closeDBConnection(){
        if($this->conn != null){
            $this->conn->close();
        }
    }

    
    public function UserExists($username){
        $connection=$this->conn;
        $query='SELECT username FROM Utente where username=?';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            'ss',
            $username,
            $username
        );
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $exist= $res->fetch_array();
        if(!$exist){
            $preparedQuery->close();
            return null;
        }
        $preparedQuery->close();
        return $exist[0];
    }
    public function CheckLogin($username,$password){
        $connection=$this->conn;
        $query='SELECT count(*) FROM Utente where  username=? AND password=?';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            'ss',
            $username,
            $password
        );
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $exist= $res->fetch_array(MYSQLI_NUM)[0]>0;
        $preparedQuery->close();
        return $exist;
    }
    public function RegisterNewUser($username,$email,$password,$nome,$cognome,$telefono,$nascita){
        $connection=$this->conn;
        $query='INSERT INTO Utente (username, email, password,nome, cognome,telefono,nascita,type)VALUES(?,?,?,?,?,?,?,?)';
        $preparedQuery = $connection->prepare($query);
        $usertype="BasicUser";
        $preparedQuery->bind_param(
            'ssssssss',
            $username,
            $email,
            $password,
            $nome,
            $cognome,
            $telefono,
            $nascita,
            $usertype
        );
        $res=$preparedQuery->execute();
        $preparedQuery->close();
        return $res;
    }    
    public function CheckUserPriviledge($username){
        $connection=$this->conn;
        $query='SELECT type FROM user where username=?';
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->bind_param(
            's',
            $username
        );
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $type= $res->fetch_array(MYSQLI_NUM)[0];
        $preparedQuery->close();
        return $type;
    }
    public function InserisciPrenotazione($giorno,$orario,$username,$room){
        $connection=$this->conn;
        $query='INSERT INTO Prenota (giorno, orario, username,id_room)VALUES("$giorno","$orario","$username","$room")';
        $preparedQuery = $connection->prepare($query);
        $res=$preparedQuery->execute();
        $preparedQuery->close();
        return $res;
    }
    public function CheckSlotDisponibili(){
        $connection=$this->conn;
        $query="SELECT id, orario, room FROM SlotPrenotabili";
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();  
        $preparedQuery->close();
        return $res;
    }


    public function GetOrario($slot){
        $connection=$this->conn;
        $query="SELECT orario FROM SlotPrenotabili where id='$slot'";
        $preparedQuery = $connection->prepare($query);
        $preparedQuery->execute();
        $res=$preparedQuery->get_result();
        $preparedQuery->close();
        return $res;
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
        $query='SELECT data id_prenotazione data_ orario id_room FROM Prenota where username=?';
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