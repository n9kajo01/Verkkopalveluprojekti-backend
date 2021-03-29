<?php

require_once "headers.php";
require_once "connection.php";


$db = openDb();



$input = json_decode(file_get_contents("php://input"));
$search = filter_var_array($input->search, FILTER_SANITIZE_STRING);

$arr = implode(" ,", $search);
$sql = "SELECT tuotenimi, hinta, tuotekuvaus,id,kuva FROM tuote WHERE id IN ($arr)";

$query = $db->prepare($sql);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo header("HTTP/1.1 200 OK");
echo json_encode($result);
