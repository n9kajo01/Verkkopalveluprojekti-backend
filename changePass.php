<?php
require_once "headers.php";
require_once "connection.php";

$input = json_decode(file_get_contents("php://input"));
$userid = filter_var($input->email, FILTER_SANITIZE_STRING);
 $oldPass = filter_var($input->oldPass, FILTER_SANITIZE_EMAIL);
 $newPass = filter_var($input->newPass, FILTER_SANITIZE_STRING);
 $passwordHash = password_hash($newPass, PASSWORD_DEFAULT);

$sql = "SELECT * FROM login WHERE userid=$userid";

try {
    $db = openDb();
    $query = $db->query($sql);
    $user = $query->fetch(PDO::FETCH_OBJ);
    $passwordFromDb = $user->password;

    if (password_verify($oldPass, $passwordFromDb)) {
        $sql = "
        UPDATE login
        SET password ='$passwordHash'
        WHERE userid ='$userid'
        ";
        $query = $db->query($sql);
        $query->execute();
        $data = array('message' => "success");
    }else{
        $data = array('message' => "fail");
    }
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo header("HTTP/1.1 200 OK");
    echo json_encode($data);




} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe" . $pdoex->getMessage();
}
