<?php

/*

class connector{            
    protected $conn;

    public function connect($user = "root",$password = "", $db ="enigma", $host = "localhost"):bool{
        $this->conn=new mysqli($host,$user,$password,$db);
        if ($this->conn->connect_errno) {
            return false;
        }else{
            return true;
            }
    }

    public function disconnect(){
        if($this->conn)
            $this->conn->close();
    }

    public function isConnected():bool{
        if($this->conn->connect_errno){
            return false;
        }
        else{
            return true;
        }
    }

    public function query($query){
        if($res=$this->conn->query($query)){
            return $res;
        }else{
            echo"query fallita";
            return false;
        }  
    }
}

*/

?>



