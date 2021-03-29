<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

    $query = $db->prepare("delete from kategoria where id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $query2 = $db->prepare("delete from tuote where id=:id");
    $query2->bindValue(":id", $id, PDO::PARAM_INT);
    $query2->execute();

}

catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
    exit;
}