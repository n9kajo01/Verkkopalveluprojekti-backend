<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $otsikko = filter_var($input->otsikko, FILTER_SANITIZE_STRING);
    $kommentti = filter_var($input->kommentti, FILTER_SANITIZE_STRING);
    $arvosana = filter_var($input->arvosana, FILTER_SANITIZE_STRING);
    $user = filter_var($input->user, FILTER_SANITIZE_STRING);
    $tuoteid = filter_var($input->tuoteid, FILTER_SANITIZE_STRING);


    $kysely = $db->prepare("INSERT INTO kommentit (tuoteid, otsikko, kommentti, arvosana, käyttäjä)"
    . "VALUES (:tuoteid, :otsikko, :kommentti, :arvosana, :user)");
    $kysely->bindValue(":tuoteid", $tuoteid, PDO::PARAM_STR);
    $kysely->bindValue(":otsikko", $otsikko, PDO::PARAM_STR);
   $kysely->bindValue(":kommentti", $kommentti, PDO::PARAM_STR);
     $kysely->bindValue(":arvosana", $arvosana, PDO::PARAM_STR);
    $kysely->bindValue(":user", $user, PDO::PARAM_STR); 
    $kysely->execute();


    print "<p>Tuote tallennettu!</p>";

} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


