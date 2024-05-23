<?php
//<!-- NIYITANGA Emile 222003205--> 2024
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

$sql = "SELECT * FROM inventory";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about inventory</title>";
    echo "<h1>The Information about inventory</h1>";
    echo "<table border='1'>
           <tr>
            <th>product_id</th>
            <th>quantity_available</th>
            <th>quantity_sold</th>
            <th>reorder_threshold</th>
        </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["quantity_available"] . "</td>";
        echo "<td>" . $row["quantity_sold"] . "</td>";
        echo "<td>" . $row["reorder_threshold"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

$conn->close();
?>
