<?php
session_start();
require_once "headers.php";

//palauttaa kirjautuneen käyttäjän tiedot jos sivu ladataan uudestaan
if(isset($_SESSION['user'])){
    $user = (array)$_SESSION["user"];
    $data = array(
        "userid" => $user["userid"],
        "email" => $user["email"],
        "etunimi" => $user["etunimi"],
        "sukunimi" => $user["sukunimi"],
        "osoite" => $user["osoite"],
        "postinro" => $user["postinro"],
        "kunta" => $user["kunta"],
        "puh" => $user["puh"],
        "added" => $user["added"],
        "oikeudet" => $user["oikeudet"]
    );
    echo json_encode($data);
    
}