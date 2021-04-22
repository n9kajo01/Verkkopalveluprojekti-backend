<?php
session_start();
require_once 'headers.php';

if ($_SESSION["user"]){
    $data = $_SESSION["user"];
    echo json_encode($data);
    } else {
        header('HTTP/1.1 401 Unauthorized');
    }
    