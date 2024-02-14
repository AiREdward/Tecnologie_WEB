<?php 
require_once "utilities/DBConnectionTest.php";

use Test\Connection;

function getLoggedUser() {
    return $_SESSION["user"] ?? null;
}

function logUser($email, $password): ?string {
    $conn = new Connection();

    if(!$conn->connect()) return "errore_connessione";


    $username = $conn->checkIfUserExists($email);

    if(!$username){
        $conn->closeConnection();
        return "utente_inesistente";
    }

    if(!$conn->checkLogin($username, $password)) {
        $conn->closeConnection();
        return "password_errata";
    }

    $_SESSION["user"] = $username;

    $conn->closeConnection();

    return null;
}

function logout(): void {
    $_SESSION["user"]=null;
    $_SESSION["admin"]=false;
}

function registerUser($username, $email, $password, $nome, $cognome, $telefono, $nascita) {
    $conn = new Connection();
    if(!$conn->connect()) return "errore_connessione";

    if($conn->checkIfUserExists($username)) {
        $conn->closeConnection();
        return "username_gia_presente";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if(!$conn->registerNewUser($username, $email, $password, $nome, $cognome, $telefono, $nascita)) {
        $conn->closeConnection();
        return "errore_registrazione_utente";
    }

    $conn->closeConnection();
    return null;
}

function checkIfUserIsAdmin($username): bool {
    $conn = new Connection();
    if(!$conn->connect()) return "errore_connessione";

    $isAdmin = $conn->isUserAdmin($username);
    $conn->closeConnection();

    return $isAdmin ;
}