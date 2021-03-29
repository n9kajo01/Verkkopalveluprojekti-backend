<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $tuotenimi = filter_var($input->tuotenimi, FILTER_SANITIZE_STRING);
    $hinta = filter_var($input->hinta, FILTER_SANITIZE_STRING);
    $tuotetiivistelma = filter_var($input->tuotetiivistelma, FILTER_SANITIZE_STRING);
    $tuotekuvaus = filter_var($input->tuotekuvaus, FILTER_SANITIZE_STRING);
    $kuva = filter_var($input->kuva, FILTER_SANITIZE_STRING);
    $id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);
    $kategoria = filter_var($input->kategoria, FILTER_SANITIZE_STRING);
    $luokka = filter_var($input->luokka, FILTER_SANITIZE_STRING);

    $query = $db->prepare("UPDATE tuote SET tuotenimi = :tuotenimi, hinta = :hinta, tuotetiivistelmä = :tuotetiivistelma, tuotekuvaus = :tuotekuvaus, kuva = :kuva WHERE id = :id");
    $query->bindValue(":tuotenimi", $tuotenimi, PDO::PARAM_STR);
    $query->bindValue(":hinta", $hinta, PDO::PARAM_STR);
   $query->bindValue(":tuotetiivistelma", $tuotetiivistelma, PDO::PARAM_STR);
     $query->bindValue(":tuotekuvaus", $tuotekuvaus, PDO::PARAM_STR);
    $query->bindValue(":kuva", $kuva, PDO::PARAM_STR); 
    $query->bindValue(":id", $id, PDO::PARAM_INT); 
    $query->execute();

    $query2 = $db->prepare("UPDATE kategoria SET kategoria = :kategoria, luokka = :luokka WHERE id = :id");
    $query2->bindValue(":kategoria", $kategoria, PDO::PARAM_STR);
    $query2->bindValue(":luokka", $luokka, PDO::PARAM_STR); 
    $query2->bindValue(":id", $id, PDO::PARAM_INT); 
    $query2->execute();

}

catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
    exit;
}