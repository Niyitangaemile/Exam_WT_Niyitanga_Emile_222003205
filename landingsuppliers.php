<?php
session_start();
///- NIYITANGA Emile 222003205-->

// Connect to database (replace dbname, username, email with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = $_POST['name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email']; 
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
   
    $sql = "INSERT INTO suppliers (name, address, contact_person, email, phone_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $name, $address, $contact_person, $email, $phone_number);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['supplier_id'];
    $newname = $_POST['newname'];
    $newcontact_person = $_POST['newcontact_person'];
    $newemail =$_POST['newemail'];
    $newphone_number = $_POST['newphone_number'];
    $newaddress = $_POST['newaddress'];
   
    $sql = "UPDATE suppliers SET name=?, address=?, contact_person=?, email=?, phone_number=? WHERE supplier_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $newname, $newaddress, $newcontact_person, $newemail, $newphone_number,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['supplier_id'];

    $sql = "DELETE FROM suppliers WHERE supplier_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains supplier_id
    $id = $_POST['supplier_id'];

    // Select user_suppliers's information from the database
    $sql = "SELECT * FROM suppliers WHERE supplier_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_suppliers information
        $row = $result->fetch_assoc();
        echo "supplier_id: " . $row["supplier_id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "contact_person: " . $row["contact_person"] . "<br>";
        echo "phone_number: " . $row["phone_number"] . "<br>";
         echo "address: " . $row["address"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}


?>