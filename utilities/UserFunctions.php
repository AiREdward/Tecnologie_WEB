<?php 
require_once "utilities/DBConnection.php";

use DB\DBAccess;

function get_logged_user(){
    if(isset($_SESSION["user"])){
        return $_SESSION["user"];
    }
    return "";
}
function LoginUser($email,$password){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore di connessione";
    }
    $username=$connessione1->UserExists($email);
    if(!$username){
        $connessione1->closeDBConnection();
        return "utente inesistente";
    }
    if(!$connessione1->CheckLogin($username,$password)){
        $connessione1->closeDBConnection();
        return "password errata";
    }
    $_SESSION["user"]=$username;
    $_SESSION["admin"]=$connessione1->CheckUserPriviledge($username)=="ADMIN";
    $connessione1->closeDBConnection();
    return "";
}
function logout(){
    $_SESSION["user"]=null;
    $_SESSION["admin"]=false;
}
function RegisterUser($username,$email,$password){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore di connessione";
    }
    if($connessione1->UserExists($username)||$connessione1->UserExists($email)){
        $connessione1->closeDBConnection();
        return "mail or username gia in uso";
    }
    if(!$connessione1->RegisterNewUser($username,$email,$password)){
        $connessione1->closeDBConnection();
        return "errore registrazione utente";
    };
    $connessione1->closeDBConnection();
    return "";
}
?>