<?php
require 'db.php';

class OrderDB{
public static function add($order_number, $client_id, $sum) {
    $query = "INSERT INTO `orders` (`order_number`,`client_id`,`sum`) VALUES
            ($order_number, $client_id, '$sum');";
           
    
    $conn = open_conn();
    $result = mysqli_query($conn, $query);
    if ($result) {
        $result =  mysqli_insert_id($conn);
    }
    close_conn($conn);
    return $result;
}
}
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
            $result = OrderDB::add(
                $_POST['order_number'],
                $_POST['client_id'],
                $_POST['sum']);
            echo json_encode(array(
                'result' => $result
            ));
            }
}
