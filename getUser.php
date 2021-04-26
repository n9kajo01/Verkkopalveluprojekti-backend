<?php
session_start();
require_once "headers.php";
require_once "connection.php";


//palauttaa kirjautuneen käyttäjän tiedot jos sivu ladataan uudestaan
if (isset($_SESSION['user'])) {
    $user = (array)$_SESSION["user"];
    $data = array(
        "userid" => $user["userid"],
    );
    $userid = implode(array("userid" => $user["userid"]));

    $sql = "SELECT * FROM login WHERE userid=$userid";


    $db = openDb();

    try {
        $query = $db->query($sql);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_OBJ);

        echo json_encode($user);

    } catch (PDOException $pdoex) {
        print "Tallennuksessa tapahtui virhe" . $pdoex->getMessage();
    }
}
