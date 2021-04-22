<?php
session_start();
require_once 'headers.php';
session_destroy();
header('HTTP/1.1 200 OK');