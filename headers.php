<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Accept, Content-Type, Access-Control-Allow-Header, Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-Type: application/json");
header("Access-Control-Max-Age: 3600");