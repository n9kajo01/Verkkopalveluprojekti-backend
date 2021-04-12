<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $nimi = filter_var($input->nimi, FILTER_SANITIZE_STRING);
    $puhelin = filter_var($input->puhelin, FILTER_SANITIZE_STRING);
    $sahkoposti = filter_var($input->sahkoposti, FILTER_SANITIZE_STRING);
    $aihe = filter_var($input->aihe, FILTER_SANITIZE_STRING);
    $viesti = filter_var($input->viesti, FILTER_SANITIZE_STRING);
    $tuoteid = filter_var($input->tuoteid, FILTER_SANITIZE_STRING);



    $db->beginTransaction();

    $kysely = $db->prepare("INSERT INTO kysymys (nimi, tuoteid, puhelin, sähköposti, aihe, viesti)"
    . "VALUES (:nimi, :tuoteid, :puhelin, :sahkoposti, :aihe, :viesti)");
    $kysely->bindValue(":nimi", $nimi, PDO::PARAM_STR);
    $kysely->bindValue(":tuoteid", $tuoteid, PDO::PARAM_STR);
    $kysely->bindValue(":puhelin", $puhelin, PDO::PARAM_STR);
    $kysely->bindValue(":sahkoposti", $sahkoposti, PDO::PARAM_STR); 
    $kysely->bindValue(":aihe", $aihe, PDO::PARAM_STR); 
    $kysely->bindValue(":viesti", $viesti, PDO::PARAM_STR); 

    $kysely->execute();
    $id = $db->lastInsertId();

    $db->commit();

    
    print "$id";

} catch (PDOException $pdoex) {
    $db->rollback();
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


