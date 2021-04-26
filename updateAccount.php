<?php
require_once "headers.php";
require_once "connection.php";

$input = json_decode(file_get_contents("php://input"));
$userid = filter_var($input->userid, FILTER_SANITIZE_EMAIL);
$email = filter_var($input->email, FILTER_SANITIZE_EMAIL);
$etunimi = filter_var($input->etunimi, FILTER_SANITIZE_STRING);
$sukunimi = filter_var($input->sukunimi, FILTER_SANITIZE_STRING);
$osoite = filter_var($input->osoite, FILTER_SANITIZE_STRING);
$postinro = filter_var($input->postinro, FILTER_SANITIZE_NUMBER_INT);
$kunta = filter_var($input->kunta, FILTER_SANITIZE_STRING);
$puh = filter_var($input->puh, FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM login WHERE userid =$userid";

try {
    $db = openDb();

    $sql = "
        UPDATE login
        SET email='$email', etunimi ='$etunimi', sukunimi='$sukunimi', osoite='$osoite', postinro='$postinro', kunta='$kunta', puh='$puh'
        WHERE userid =$userid
        ";
    $query = $db->query($sql);
    $query->execute();
    $data = array('message' => "success");


    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo header("HTTP/1.1 200 OK");
    echo json_encode($data);
} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe" . $pdoex->getMessage();
}
