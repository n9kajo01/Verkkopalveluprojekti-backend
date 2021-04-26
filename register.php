<?php
require_once "headers.php";
require_once "connection.php";

$input = json_decode(file_get_contents("php://input"));
$email = filter_var($input->email, FILTER_SANITIZE_EMAIL);
$password = filter_var($input->password, FILTER_SANITIZE_STRING);
$etunimi = filter_var($input->etunimi, FILTER_SANITIZE_STRING);
$sukunimi = filter_var($input->sukunimi, FILTER_SANITIZE_STRING);
$osoite = filter_var($input->osoite, FILTER_SANITIZE_STRING);
$postinro = filter_var($input->postinro, FILTER_SANITIZE_NUMBER_INT);
$kunta = filter_var($input->kunta, FILTER_SANITIZE_STRING);
$puh = filter_var($input->puh, FILTER_SANITIZE_NUMBER_INT);
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
//$email = "posti@postifi";

try {
    $db = openDb();

    

    $sql = "INSERT INTO login (email, password, etunimi, sukunimi, osoite, postinro, kunta, puh)
    VALUES('$email', '$passwordHash', '$etunimi', '$sukunimi', '$osoite', '$postinro', '$kunta', '$puh')";

    //testaa onko sähköposti jo olemassa login taulussa
    if ($email) {
        $query = $db->prepare("SELECT email FROM login where email='$email'");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $data = array('message' => "fail");
        } else { //jos ei sähköpostia ei löydy taulusta, tehdään uusi
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $data = array('message' => "success");
        }
        echo header("HTTP/1.1 200 OK");
        echo json_encode($data);
    }
} catch (PDOException $pdoex) {
    print "Tallennuksessa tapahtui virhe" . $pdoex->getMessage();
}
