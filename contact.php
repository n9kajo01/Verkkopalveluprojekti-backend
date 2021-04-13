<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {

    $input = json_decode(file_get_contents("php://input"));
    $nimi = filter_var($input->nimi, FILTER_SANITIZE_STRING);
    $puhelin = filter_var($input->puhelin, FILTER_SANITIZE_NUMBER_INT);
    $sposti = filter_var($input->sposti, FILTER_SANITIZE_EMAIL);
    $otsikko = filter_var($input->otsikko, FILTER_SANITIZE_STRING);
    $viesti = filter_var($input->viesti, FILTER_SANITIZE_STRING);

    $sql = $db->prepare("
    INSERT INTO palaute (nimi, otsikko, viesti, puhelin, sposti)
    VALUES ('$nimi', '$otsikko', '$viesti', '$puhelin', '$sposti')
    ");

    $sql->execute();
} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe" . $pdoex->getMessage();
}
