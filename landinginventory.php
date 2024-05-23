<?php
session_start();
// NIYITANGA Emile 222003205-->

// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
        $product_id = $_POST['product_id'];
        $quantity_available = $_POST['quantity_available'];
        $quantity_sold = $_POST['quantity_sold'];
        $reorder_threshold = $_POST['reorder_threshold'];
        

    $sql = "INSERT INTO inventory (product_id, quantity_available, quantity_sold, reorder_threshold) VALUES ( ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $name, $quantity_available, $quantity_sold, $reorder_threshold);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
   $id = $_POST['id'];
        $newname = $_POST['newproduct_id'];
        $newquantity_available = $_POST['newquantity_available'];
        $newquantity_sold = $_POST['newquantity_sold'];
        $newreorder_threshold = $_POST['newreorder_threshold'];
       

        $sql = "UPDATE inventory SET product_id=?, quantity_available=?, quantity_sold=?, reorder_threshold=? WHERE inventory_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $newproduct_id, $newquantity_available, $newquantity_sold, $newreorder_threshold, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['inventory_id'];

    $sql = "DELETE FROM inventory WHERE inventory_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains inventory_id
    $id = $_POST['inventory_id'];

    // Select user_inventory's information from the database
    $sql = "SELECT * FROM inventory WHERE inventory_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_inventory information
        $row = $result->fetch_assoc();
        echo "inventory_id: " . $row["inventory_id"] . "<br>";
        echo "product_id: " . $row["product_id"] . "<br>";
        echo "quantity_available: " . $row["quantity_available"] . "<br>";
        echo "quantity_sold: " . $row["quantity_sold"] . "<br>";
         echo "reorder_threshold: " . $row["reorder_threshold"] . "<br>";
        echo "inventory ID: " . $row["inventory_id"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}


?>