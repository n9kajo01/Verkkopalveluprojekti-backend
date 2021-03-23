<?php
require_once "connection.php";
require_once "headers.php";

$db = openDb();
$sql = "SELECT id,tuotenimi, hinta, tuotekuvaus FROM tuote";
$query = $db->query($sql);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo header("HTTP/1.1 200 OK");
echo json_encode($result);
