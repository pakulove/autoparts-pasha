<?php
require_once '../db.php';

function get_all() {
    global $conn;
    $query = "SELECT * FROM autoparts";
    $result = $conn->query($query);
    $autoparts = array();
    while ($row = $result->fetch_assoc()) {
        $autoparts[] = $row;
    }
    return $autoparts;
}

