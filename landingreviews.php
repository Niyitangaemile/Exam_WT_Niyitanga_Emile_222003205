<?php
session_start(); //<!-- NIYITANGA Emile 222003205-->

// Connect to database (replace dbproduct_id, userproduct_id, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
     $product_id = $_POST['product_id'];
        $customer_id = $_POST['customer_id'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];
        $review_date = $_POST['review_date'];
       

        $sql = "INSERT INTO reviews (product_id, customer_id, rating, review_text, review_date) VALUES (?, ?, ?, ?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssss", $product_id, $customer_id, $rating, $review_text, $review_date);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['review_id'];
   $newproduct_id = $_POST['newproduct_id'];
        $newcustomer_id = $_POST['newcustomer_id'];
        $newrating = $_POST['newrating'];
        $newreview_text = $_POST['newreview_text'];
        $newreview_date = $_POST['newreview_date'];

        $sql = "UPDATE reviews SET product_id=?, customer_id=?, rating=?, review_text=?, review_date=? WHERE review_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $newproduct_id, $newcustomer_id, $newrating, $newreview_text, $newreview_date, $id);


    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['review_id'];

    $sql = "DELETE FROM reviews WHERE review_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains review_id
    $id = $_POST['review_id'];

    // Select user_reviews's information from the database
    $sql = "SELECT * FROM reviews WHERE review_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_reviews information
        $row = $result->fetch_assoc();
        echo "review_id: " . $row["review_id"] . "<br>";
         echo "product_id: " . $row["product_id"] . "<br>";
        echo "customer_id: " . $row["customer_id"] . "<br>";
        echo "rating: " . $row["rating"] . "<br>";
        echo "review_text: " . $row["review_text"] . "<br>";
        echo "review_date: " . $row["review_date"] . "<br>";
       
    } else {
        echo "No user found with the provided ID.";
    }
}


?>