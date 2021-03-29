<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $username = filter_var($input->username, FILTER_SANITIZE_STRING);
    $password = filter_var($input->password, FILTER_SANITIZE_STRING);
    


    $kysely = $db->prepare("SELECT * FROM login WHERE username ='$username' AND password = '$password'");
    $kysely->bindValue(":username", $username, PDO::PARAM_STR);
    $kysely->bindValue(":password", $password, PDO::PARAM_STR);
    $kysely->execute();
    
    $kysely->setFetchMode(PDO::FETCH_ASSOC);

    $result = $kysely->fetchAll();

    foreach($result as $row){
        print($row['id']);
        print($row['username']);
        print($row['password']);
        echo json_encode($result);
    }
} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe". $pdoex->getMessage();
}

?>


