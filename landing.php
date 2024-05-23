<?php
session_start();
//<!-- NIYITANGA Emile 222003205-->

// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, role, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $username, $role, $email, $password);

    if ($stmt->execute()) {
        echo "Record added successfully.";
        header("Location:index.html");
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $newusername = $_POST['newusername'];
    $newemail = $_POST['newemail'];
    $newpassword = $_POST['newpassword'];
    $newrole = $_POST['newrole'];
   

    $sql = "UPDATE users SET username=?, role=?, email=?, password=? WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $newusername, $newrole, $newemail, $newpassword,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains user_id
    $id = $_POST['user_id'];

    // Select user_users's information from the database
    $sql = "SELECT * FROM users WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_users information
        $row = $result->fetch_assoc();
        echo "user_id: " . $row["user_id"] . "<br>";
        echo "username: " . $row["username"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo ":password " . $row["password"] . "<br>";
         echo "Role: " . $row["role"] . "<br>";
      
    } else {
        echo "No user found with the provided ID.";
    }
}


?>