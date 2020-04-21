<?php
require 'db.php';

function get_all() {
    $query = "SELECT * FROM `clients`";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if (!$result) die('ERROR: ' . mysqli_error);
    
    $clients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }
    
    close_conn($conn);
    return $clients;
}

function get($id) {
    $query = "SELECT * FROM `clients` WHERE id = {$id}";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if (!$result) die('ERROR: ' . mysqli_error);
    
    $client = mysqli_fetch_assoc($result);
    
    close_conn($conn);
    return $client;
}

function add($surname, 
             $name, 
             $patronymic, 
             $phone, 
             $email,
             $address, 
             $birthday) {
    $query = "INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`, `email`, `address`, `birthday`) VALUES ('$surname', '$name', '$patronymic', '$phone', '$email', '$address', '$birthday');";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if ($result) {
        $result =  mysqli_insert_id($conn);
    }
    close_conn($conn);
    return $result;
}

function edit($id, 
                $surname, 
                $name, 
                $patronymic, 
                $phone,
                $email,
                $address, 
                $birthday) {
    $query = "UPDATE `clients` SET `surname` = '$surname', `name` = '$name', `patronymic` = '$patronymic', `phone` = '$phone', `email` = '$email', `address` = '$address', `birthday` = '$birthday' WHERE id = $id;";
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    close_conn($conn);
    return $result;
}


function delete($id) {
        $query = "DELETE FROM clients WHERE id = $id;";

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
            $_REQUEST['surname'],
            $_REQUEST['name'],
            $_REQUEST['patronymic'],
            $_REQUEST['phone'],
            $_REQUEST['email'],
            $_REQUEST['address'],
            $_REQUEST['birthday']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'edit') {
        $result = edit(
            $_REQUEST['id'],
            $_REQUEST['surname'],
            $_REQUEST['name'],
            $_REQUEST['patronymic'],
            $_REQUEST['phone'],
            $_REQUEST['email'],
            $_REQUEST['address'],
            $_REQUEST['birthday']);
        echo json_encode(array(
            'result' => $result
        ));
    } elseif ($_REQUEST['action'] == 'delete') {
        $result = delete($_REQUEST['id']);
        echo json_encode(array(
            'result' => $result
        ));
    } else {
        echo 'Action not defind'; 
    }
}
