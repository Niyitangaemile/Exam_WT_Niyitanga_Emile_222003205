<?php
session_start();
//<!-- NIYITANGA Emile 222003205-->
// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $customer_id = $_POST['customer_id'];
        $order_date = $_POST['order_date'];
        $total_price = $_POST['total_price'];
        $status = $_POST['status'];
        $shipping_address = $_POST['shipping_address'];

        $sql = "INSERT INTO orders (customer_id, order_date, total_price, status, shipping_address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssss", $customer_id, $order_date, $total_price, $status, $shipping_address);


    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
 $id = $_POST['order_id'];
        $newcustomer_id = $_POST['newcustomer_id'];
        $neworder_date = $_POST['neworder_date'];
        $newtotal_price = $_POST['newtotal_price'];
        $newstatus = $_POST['newstatus'];
        $newshipping_address = $_POST['newshipping_address'];

        $sql = "UPDATE orders SET customer_id=?, order_date=?, total_price=?, status=?, shipping_address=? WHERE order_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssi", $newcustomer_id, $neworder_date, $newtotal_price, $newstatus, $newshipping_address, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['order_id'];

    $sql = "DELETE FROM orders WHERE order_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains order_id
    $id = $_POST['order_id'];

    // Select user_orders's information from the database
    $sql = "SELECT * FROM orders WHERE order_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_orders information
        $row = $result->fetch_assoc();
        echo "order_id: " . $row["order_id"] . "<br>";
        echo "customer_id: " . $row["customer_id"] . "<br>";
    echo "order_date: " . $row["order_date"] . "<br>";
    echo "total_price: " . $row["total_price"] . "<br>";
    echo "status: " . $row["status"] . "<br>";
    echo "shipping_address: ".$row["shipping_address"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}


?>