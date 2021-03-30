<?php

require_once "headers.php";
require_once "connection.php";

$db = openDb();

try {
    $input = json_decode(file_get_contents("php://input"));
    $username = filter_var($input->username, FILTER_SANITIZE_STRING);
    $password = filter_var($input->password, FILTER_SANITIZE_STRING);
    $pass = password_hash($password, PASSWORD_DEFAULT);

    $kysely = $db->prepare("SELECT * FROM login WHERE username ='$username'");
    $kysely->bindValue(":username", $username, PDO::PARAM_STR);
    $kysely->execute();
    
    $kysely->setFetchMode(PDO::FETCH_ASSOC);

    $result = $kysely->fetchAll();
    
    foreach($result as $row){
        $data = array( "id" => $row['id'],"username" => $username, "password" => $pass);
        echo json_encode($data);
        
    }

} catch (PDOException $pdoex) {
    $error = array("error" => $pdoex->getMessage());
    echo json_encode($error);
}

?>


