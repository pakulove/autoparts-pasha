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

function get($id) {
    $query = "SELECT * FROM `autoparts` WHERE id = {$id}";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if (!$result) die('ERROR: ' . mysqli_error);
    
    $autopart = mysqli_fetch_assoc($result);
    
    close_conn($conn);
    return $autopart;
}

function add($name, 
             $type, 
             $description, 
             $cost) {
    $query = "INSERT INTO `autoparts` (`name`, `type`, `description`, `cost`) VALUES ('$name', '$type', '$description', '$cost');";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if ($result) {
        $result =  mysqli_insert_id($conn);
    }
    close_conn($conn);
    return $result;
}

function edit($id, 
                $name, 
                $type, 
                $description,
                $cost) {
    $query = "UPDATE `autoparts` SET `name` = '$name', `type` = '$type', `description` = '$description', `cost` = '$cost' WHERE id = $id;";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    close_conn($conn);
    return $result;
}


function delete($id) {
        $query = "DELETE FROM autoparts WHERE id = $id;";

        $conn = open_conn();
        $result = mysqli_query($conn, $query);
        close_conn($conn);
        return $result;
}

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'get') {
        $result = get($_REQUEST['id']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'add') {
        $result = add(
            $_REQUEST['name'],
            $_REQUEST['type'],
            $_REQUEST['description'],
            $_REQUEST['cost']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'edit') {
        $result = edit(
            $_REQUEST['id'],
            $_REQUEST['name'],
            $_REQUEST['type'],
            $_REQUEST['description'],
            $_REQUEST['cost']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'delete') {
        $result = delete($_REQUEST['id']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'get_autoparts') {
        $result = get_all();
        echo json_encode(array(
            'result' => $result
        ));
    } else {
        echo 'Action not defind'; 
    } 
}


