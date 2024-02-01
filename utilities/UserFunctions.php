<?php 
require_once "utilities/DBConnection.php";

//use Connection;

function get_logged_user(){
    return $_SESSION["user"] ?? null;
}

function loginUser($email, $password) {
    $conn = new Connection();

    if(!$conn->apriConnessione()) {
        return "errore_connessione";
    }

    $username = $conn->UserExists($email);

    if(!$username){
        $conn->closeConnection();
        return "utente_inesistente";
    }

    if(!$conn->checkLogin($username,$password)) {
        $conn->closeConnection();
        return "password_errata";
    }

    $_SESSION["user"] = $username;
    $_SESSION["admin"] = $conn->CheckUserPriviledge($username) == "ADMIN";

    $conn->closeConnection();

    return null;
}

function logout(){
    $_SESSION["user"]=null;
    $_SESSION["admin"]=false;
}
function RegisterUser($username,$email,$password,$nome,$cognome,$telefono,$nascita){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    if($connessione1->UserExists($username)||$connessione1->UserExists($email)){
        $connessione1->closeDBConnection();
        return "mail_username_duplicata";
    }
    if(!$connessione1->RegisterNewUser($username,$email,$password,$nome,$cognome,$telefono,$nascita)){
        $connessione1->closeDBConnection();
        return "errore_registrazione_utente";
    };
    $connessione1->closeDBConnection();
    return null;
}