<?php 
require_once "utilities/DBConnectionTest.php";

use Test\Connection;

function get_logged_user(){
    return $_SESSION["user"] ?? null;
}

function loginUser($email, $password) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return "errore_connessione";
    }

    $username = $conn->checkIfUserExists($email);

    if(!$username){
        $conn->closeConnection();
        return "utente_inesistente";
    }

    if(!$conn->checkLogin($username,$password)) {
        $conn->closeConnection();
        return "password_errata";
    }

    $_SESSION["user"] = $username;
    $_SESSION["admin"] = $conn->getUserPrivilege($username) == "ADMIN";

    $conn->closeConnection();

    return null;
}

function logout(){
    $_SESSION["user"]=null;
    $_SESSION["admin"]=false;
}
function RegisterUser($username,$email,$password,$nome,$cognome,$telefono,$nascita){
    $connessione1 = new Connection();
    $connOK = $connessione1->connect();
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