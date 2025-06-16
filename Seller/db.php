<?php

define("HOST", "db");
define("USER", "root");
define("PASS", "admin");
define("DB", "Clients_db");

function open_conn() {
    $conn = mysqli_connect(HOST, USER, PASS, DB);
    if (!$conn) die('ERROR');
    
    return $conn;
}

function close_conn($conn) {
    mysqli_close($conn);
}
