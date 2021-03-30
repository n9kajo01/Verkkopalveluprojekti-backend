<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $username = filter_var($input->username, FILTER_SANITIZE_STRING);
    $password = filter_var($input->password, FILTER_SANITIZE_STRING);
    $pass = password_hash($password, PASSWORD_DEFAULT);


    $kysely = $db->prepare("INSERT INTO login (username,password)"
    . "VALUES (:username, :pass)");
    $kysely->bindValue(":username", $username, PDO::PARAM_STR);
    $kysely->bindValue(":pass", $pass, PDO::PARAM_STR);
    $kysely->execute();
    
   
    print "<p>Tiedot tallennettu!</p>";

} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


