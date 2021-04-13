<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $username = filter_var($input->username, FILTER_SANITIZE_STRING);
    $password = filter_var($input->password, FILTER_SANITIZE_STRING);

    $kysely = $db->prepare("SELECT * FROM login WHERE username =:username");
    $kysely->bindValue(":username", $username, PDO::PARAM_STR);
    $kysely->execute();
    
    $kysely->setFetchMode(PDO::FETCH_ASSOC);

    $result = $kysely->fetchAll();

    foreach($result as $row){
        if(password_verify($password, $row['password'])){
        $data = array( "id" => $row['id'],"username" => $username, "oikeudet" => $row['oikeudet'], "added" => $row['added']);
        echo json_encode($data);
        }
        
    }

} catch (PDOException $pdoex) {
    $error = array("error" => $pdoex->getMessage());
    echo json_encode($error);
}

?>


