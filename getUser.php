<?php
session_start();
require_once "headers.php";

$data = $_SESSION["user"];
echo json_encode($data);
