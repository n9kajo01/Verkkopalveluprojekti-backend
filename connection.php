<?php

function openDb()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    $servername = "localhost";
    $username = "root";
    $password = "";

    $db = new PDO("mysql:host=$servername;dbname=verkkokauppa", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
}
