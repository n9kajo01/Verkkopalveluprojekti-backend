<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $nimi = filter_var($input->nimi, FILTER_SANITIZE_STRING);
    $puhelin = filter_var($input->puhelin, FILTER_SANITIZE_STRING);
    $osoite = filter_var($input->osoite, FILTER_SANITIZE_STRING);
    $posti = filter_var($input->posti, FILTER_SANITIZE_STRING);
    $sahkoposti = filter_var($input->sahkoposti, FILTER_SANITIZE_STRING);
    $kuljetus = filter_var($input->kuljetus, FILTER_SANITIZE_STRING);
    $maksu = filter_var($input->maksu, FILTER_SANITIZE_STRING);
    $hinta = filter_var($input->hinta, FILTER_SANITIZE_STRING);
    $kayttajanimi = filter_var($input->kayttajanimi, FILTER_SANITIZE_STRING);


    $db->beginTransaction();

    $kysely = $db->prepare("INSERT INTO tilaus (nimi, puhelin, osoite, postinro, sähköposti, toimitustapa, maksutapa, hinta, käyttäjänimi)"
    . "VALUES (:nimi, :puhelin, :osoite, :posti, :sahkoposti, :kuljetus, :maksu, :hinta, :sahkoposti)");
    $kysely->bindValue(":nimi", $nimi, PDO::PARAM_STR);
    $kysely->bindValue(":puhelin", $puhelin, PDO::PARAM_STR);
   $kysely->bindValue(":osoite", $osoite, PDO::PARAM_STR);
     $kysely->bindValue(":posti", $posti, PDO::PARAM_STR);
    $kysely->bindValue(":sahkoposti", $sahkoposti, PDO::PARAM_STR); 
    $kysely->bindValue(":kuljetus", $kuljetus, PDO::PARAM_STR); 
    $kysely->bindValue(":maksu", $maksu, PDO::PARAM_STR); 
    $kysely->bindValue(":hinta", $hinta, PDO::PARAM_STR);
    $kysely->bindValue(":kayttajanimi", $kayttajanimi, PDO::PARAM_STR);

    $kysely->execute();
    $id = $db->lastInsertId();

    $db->commit();

    
    print "$id";

} catch (PDOException $pdoex) {
    $db->rollback();
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


