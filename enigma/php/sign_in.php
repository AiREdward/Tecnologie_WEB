<?php

    require_once('connector.php');

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $telefono = $_POST["telefono"];
    $nascita = $_POST["nascita"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conferma_password = $_POST["conferma"];
    
    
    
    
        function all_set():bool{                                     //controlla che tutti i dati obbligatori siano stati inseriti
            if($_POST["nome"] && $_POST["cognome"] && ($_POST["telefono"] || $_POST["email"] ) && $_POST["nascita"] && $_POST["username"] && $_POST["password"] && $_POST["conferma"]){
                return true;
            }else{
                echo'uno o più campi obbligatori mancanti';
                return false;
            }
        }

        function tel_check():bool{                               //controllo numero di telefono
            if(empty($_POST["telefono"]) || preg_match('/^[0-9]{10}$/', $_POST["telefono"])){
                return true;
            }else{
                echo'numero telefono non valido';
                return false;
            }
        }

        function email_check():bool{                             //controllo mail
            if(empty($_POST["email"]) || filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                return true;
            }else{
                echo'la mail non è una mail';
                return false;
            }
            
        }

        function password_check():bool{                          //controllo password e conferma
            $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$/';   //pattern password                        
            if($_POST["password"]==$_POST["conferma"]){
                if(preg_match($pattern, $_POST["password"])){
                    return true;
                }else{
                    echo'la password non è valida, deve avere almeno 1 carattere maiuscolo, 1 minuscolo, un numero, un simbolo ed almeno 8 caratteri';
                    return false;
                }
            }else{
                echo'la password e la sua conferma non coincidono';
                return false;
            }
        }

        function username_check():bool{ 
            $username = $_POST["username"];                         //controllo usename 
            if(ctype_alnum($username)){                         //restituisce true solo se tutti i caratteri della stringa sono alfanumerici, utile contro sql injection
                $conn = new connector();  
                if($conn->connect()) {                  //connessione database
                    $query = "select username from users where username='$username'";
                    $res=$conn->query($query);
                    $row = $res->fetch_assoc();
                    if($row){                           
                        echo"username gia presente";
                        return false;
                    }else{
                        $conn->disconnect();
                        return true;
                    }
                }else{
                    echo"connessione al database fallita";
                    return false;
                }
            }else{
                echo'lo username non può contenere solo lettere e numeri';
                return false;
            }      
        }

    





    if(all_set() && tel_check() && email_check() && password_check() && username_check()){
        $conn = new connector(); 
        if($conn->connect()){
            $query ="INSERT INTO users (username, nome, cognome, nascita, password, email, telefono) VALUES ('$username','$nome', '$cognome', '$nascita', '$password', '$email', '$telefono')";
            if($conn->query($query)){                                           
                $conn->disconnect(); 
                echo "registrazione effettuata";
                echo "<br><a href='/enigma/html/log_in.html'>vai al login</a>";
            }else{
                echo ' registrazione fallita ';
            }
        }else{
            echo"connessione al database fallita";
        }
    }else{
        echo ' registrazione fallita lol' . "<br><a href='/enigma/html/sign_in.html'>torna alla pagina precedente</a>";
    }
  
            
                                
    




?>
