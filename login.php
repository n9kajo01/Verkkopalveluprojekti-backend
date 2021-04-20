<?php
session_start();
require_once "headers.php";
require_once "connection.php";


$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// $username = "testi";
// $password = "testi";

$sql = "SELECT * FROM login WHERE username='$username'";

try {
    $db = openDb();
    $query = $db->query($sql);
    $user = $query->fetch(PDO::FETCH_OBJ);

    if ($user) {
        $passwordFromDb = $user->password;
        if (password_verify($password, $passwordFromDb)) {
            header('HTTP/1.1 200 OK');
            $data = array(
                "id" => $user->id,
                "username" => $user->username,
                "oikeudet" => $user->oikeudet
            );
            $_SESSION["user"] = $user;
        } else {
            header('HTTP/1.1 401 Unauthorized');
            $data = array('message' => "Unsuccessfull login.");
        }
    } else {
        header('HTTP/1.1 401 Unauthorized');
        $data = array('message' => "Unsuccessfull login.");
    }
    echo json_encode($data);

} catch (PDOException $pdoex) {
    $error = array("error" => $pdoex->getMessage());
    echo json_encode($error);
}
