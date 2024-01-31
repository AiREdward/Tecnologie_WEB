<?php

require_once "DBConnectionTest.php";
require_once "InputCleaner.php";
require_once "config.php";

use Test\Connection;

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $telefono = $_POST["telefono"];
    $nascita = $_POST["nascita"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conferma_password = $_POST["conferma"];

    function check_tel() : bool {
        global $telefono, $patternTelefono;
        if(empty($telefono) || checkInputCorrectness($telefono, $patternTelefono))
            return true;
        else {
            // TODO: add multi-language support
            echo "Numero di telefono non valido";
            return false;
        }
    }

    function check_email() : bool {
        global $email;
        if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        else{
            // TODO: add multi-language support
            echo "La mail non è corretta";
            return false;
        }
    }

    // TODO: add check of the username
    function check_username() : bool {
        global $username, $patternUser;

        if(ctype_alnum($username)) {
            $conn = new Connection();

            if($conn->connect()) {
                $query = "SELECT username FROM Utente WHERE username='$username'";
                $res = $conn->executeQuery($query);
                if($res){
                    echo "Username già presente";
                    return false;
                }else{
                    $conn->closeConnection();
                    return true;
                }
            }else{
                // TODO: Change to an error 500?
                echo "Connessione al database fallita";
                return false;
            }
        }else{
            // TODO: add multi-language support
            echo "Username non corretto: si accettano solo lettere e numeri.";
            return false;
        }
    }

    function check_password() : bool {
        global $password, $conferma_password, $patternPassword;

        if($password == $conferma_password){
            if(checkInputCorrectness($password, $patternPassword))
                return true;
            else{
                echo "La password non è valida, deve avere almeno 1 carattere maiuscolo, 1 minuscolo, un numero, un simbolo ed almeno 8 caratteri";
                return false;
            }
        }else{
            echo "La password e la sua conferma non coincidono";
            return false;
        }
    }

    function all_set() : bool {
        if(isset($_POST["nome"]) && isset($_POST["cognome"]) && check_tel() && check_email() && isset($_POST["nascita"]) && check_username() && check_password())
            return true;
        else
            return false;
    }

    if(all_set()) {
        $conn = new Connection();

        if($conn->connect()) {
            try {
                $conn->registerNewUser($username, $email, $password, $nome, $cognome, $telefono, $nascita);

                // TODO: add multi-language support
                echo "Registrazione effettuata";
                echo "<br><a href='../login.php'>Vai al login</a>";
            } catch (Exception $e) {
                // TODO: remove for final version
                echo $e->getMessage();

                // TODO: add multi-language support
                echo "Registrazione fallita";
                echo "<br><a href='../signup.php'>Torna alla pagina precedente</a>";
            } finally {
                $conn->closeConnection();
            }
        } else {
            // TODO: add 500 error?
        }

    }