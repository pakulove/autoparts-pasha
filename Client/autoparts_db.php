<?php
require_once '../db.php';

function get_all($id = null) {
    global $conn;
    if ($id) {
        $query = "SELECT * FROM autoparts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $query = "SELECT * FROM autoparts";
        $result = $conn->query($query);
    }
    
    $autoparts = array();
    while ($row = $result->fetch_assoc()) {
        $autoparts[] = $row;
    }
    return $autoparts;
}

