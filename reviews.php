<?php
//<!-- NIYITANGA Emile 222003205-- 2024
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; //this is empty because I didn't set any password
$dbname = "organic_baby_clothing";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reviews";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about reviews</title>";
    echo "<h1>The Information about reviews</h1>";
    echo "<table border='1'>
            <tr>
            <th>product_id</th>
            <th>customer_id</th>
            <th>rating</th>
            <th>review_text</th>
            <th>review_date</th>
        </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["customer_id"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "<td>" . $row["review_text"] . "</td>";
        echo "<td>" . $row["review_date"] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No information found";
}

// Close the database connection
$conn->close();
?>
