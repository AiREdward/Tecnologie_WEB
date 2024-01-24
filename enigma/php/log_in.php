<?php

    require_once('connector.php');


    session_start();


    $username = $_POST["username"];
    $password = $_POST["password"];


    if($username && $password){
        if(ctype_alnum($username)){        //restituisce true solo se tutti i caratteri della stringa sono alfanumerici
           $conn = new connector();                
            if($conn->connect()){                   //connessione database
                $query = "select username,password from users where username='$username'";
                $res=$conn->query($query);
                $row = $res->fetch_assoc();
                if($row){
                    if($row['password']==$password){
                        echo "accesso effettuato";               // accesso effettuato correttamente
                    }else{
                        echo "password errata";
                    }
                }else{
                    echo"l'acount non esiste";
                }
                $conn->disconnect();                             
            }else{
                echo"connessione al database fallita";
            }
        }else{
            echo'nome utente errato';       //non sono ammessi simboli nel nome utente
        }       
    }else{
        echo'username o password mancante';
    }





?>
