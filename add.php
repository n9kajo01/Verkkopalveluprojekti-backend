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
    $kategoria = filter_var($input->kategoria, FILTER_SANITIZE_STRING);
    $luokka = filter_var($input->luokka, FILTER_SANITIZE_STRING);
    


    $kysely = $db->prepare("INSERT INTO tuote (tuotenimi, hinta, tuotetiivistelmä, tuotekuvaus, kuva)"
    . "VALUES (:tuotenimi, :hinta, :tuotetiivistelma, :tuotekuvaus, :kuva)");
    $kysely->bindValue(":tuotenimi", $tuotenimi, PDO::PARAM_STR);
    $kysely->bindValue(":hinta", $hinta, PDO::PARAM_STR);
   $kysely->bindValue(":tuotetiivistelma", $tuotetiivistelma, PDO::PARAM_STR);
     $kysely->bindValue(":tuotekuvaus", $tuotekuvaus, PDO::PARAM_STR);
    $kysely->bindValue(":kuva", $kuva, PDO::PARAM_STR); 
    $kysely->execute();
    
    $kysely2 = $db->prepare("INSERT INTO kategoria (kategoria, luokka)"
    . "VALUES (:kategoria, :luokka)");
    $kysely2->bindValue(":kategoria", $kategoria, PDO::PARAM_STR);
    $kysely2->bindValue(":luokka", $luokka, PDO::PARAM_STR);
    $kysely2->execute();


    print "<p>Tuote tallennettu!</p>";

} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


