<?
class Connection{
    //Variabili di connessione al database
    const HOST = "localhost";
    const USERNAME = "root";
    const PASS = "";
    const DATABASE = "escaperoom";

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
        $query='SELECT username FROM user where email=? OR username=?';
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
        $query='SELECT count(*) FROM user where  username=? AND password=?';
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
        $query='INSERT INTO user (username, email, password,nome, cognome,telefono,nascita,type)VALUES(?,?,?,?,?,?,?,?)';
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
}
?>