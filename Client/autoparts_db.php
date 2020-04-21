<?php
require 'db.php';

function get_all() {
    $query = "SELECT * FROM `autoparts`";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if (!$result) die('ERROR: ' . mysqli_error);
    
    $autoparts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $autoparts[] = $row;
    }
    
    close_conn($conn);
    return $autoparts;
}

