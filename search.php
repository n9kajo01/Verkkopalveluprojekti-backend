<?php

require_once "headers.php";
require_once "connection.php";


$db = openDb();



$input = json_decode(file_get_contents("php://input"));
$search = filter_var($input->search, FILTER_SANITIZE_STRING);
$sort = filter_var($input->sort, FILTER_SANITIZE_STRING);

$sql = $db->prepare("SELECT tuotenimi, hinta, tuotetiivistelmä,tuotekuvaus,id,kuva FROM tuote WHERE tuotenimi like '%$search%' or tuotekuvaus like '%$search%' $sort");

$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo header("HTTP/1.1 200 OK");
echo json_encode($result);
