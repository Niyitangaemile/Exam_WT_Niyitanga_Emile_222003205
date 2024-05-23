<?php
session_start();
//<!-- NIYITANGA Emile 222003205-->

// Connect to database (replace dbname, username, category with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $material = $_POST['material'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO products(name, description, category, price, material, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $name, $description, $category, $price, $material, $image_url);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['product_id'];
    $newname = $_POST['newname'];
    $newdescription = $_POST['newdescription'];
    $newcategory = $_POST['newcategory'];
    $newprice = $_POST['newprice'];
    $newmaterial = $_POST['newmaterial'];
    $newimage_url = $_POST['newimage_url'];

    $sql = "UPDATE productsSET name=?, description=?, category=?, price=?, material=?, image_url=?WHERE product_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssi", $newname, $newdescription, $newcategory, $newprice, $newmaterial, $newimage_url, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['product_id'];

    $sql = "DELETE FROM products WHERE product_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains product_id
    $id = $_POST['product_id'];

    // Select user_student's information from the database
    $sql = "SELECT * FROM products WHERE product_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_productsinformation
        $row = $result->fetch_assoc();
        echo "<b>ID:</b>" . $row["product_id"] . "<br>";
        echo "Name:" . $row["name"] . "<br>";
        echo "description" . $row["description"] . "<br>";
        echo "category:" . $row["category"] . "<br>";
        echo "Phone Number:" . $row["price"] . "<br>";
        echo "material:" . $row["material"] . "<br>";
        echo "image_url:" . $row["image_url"] . "<br>";
      
    } else {
        echo "No user found with the provided ID.";
    }
}
?>
