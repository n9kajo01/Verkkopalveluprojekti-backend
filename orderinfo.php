<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $id = filter_var($input->id, FILTER_SANITIZE_STRING);
    $tuotenro = filter_var($input->tuotenro, FILTER_SANITIZE_STRING);
    $kpl = filter_var($input->kpl, FILTER_SANITIZE_STRING);


    $db->beginTransaction();

    $kysely2 = $db->prepare("INSERT INTO tilausrivi (tilausid, tuotenro, kpl)"
    . "VALUES (:id, :tuotenro, :kpl)");
    $kysely2->bindValue(":id", $id, PDO::PARAM_STR);
    $kysely2->bindValue(":tuotenro", $tuotenro, PDO::PARAM_STR);
    $kysely2->bindValue(":kpl", $kpl, PDO::PARAM_STR);
    $kysely2->execute();

    $db->commit();

    print "$id";

} catch (PDOException $pdoex) {
    $db->rollback();
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


