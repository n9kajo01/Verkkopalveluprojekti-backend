<?php
session_start();
require_once "headers.php";

$user = (array)$_SESSION["user"];

$data = array(
    "userid" => $user["userid"],
    "email" => $user["email"],
    "oikeudet" => $user["oikeudet"]
);
echo json_encode($data);
