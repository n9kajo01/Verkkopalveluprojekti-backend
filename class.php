<?php

require_once "headers.php";
require_once "connection.php";


$db = openDb();



$input = json_decode(file_get_contents("php://input"));
$search = filter_var($input->search, FILTER_SANITIZE_STRING);
$sort = filter_var($input->sort, FILTER_SANITIZE_STRING);

$sql = "
SELECT *
FROM tuote
INNER JOIN kategoria
ON tuote.id = kategoria.id
WHERE luokka LIKE '%$search%' $sort"
;


$query = $db->prepare($sql);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo header("HTTP/1.1 200 OK");
echo json_encode($result);
