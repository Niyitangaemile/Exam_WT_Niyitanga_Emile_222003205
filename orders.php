<?php
//<!-- NIYITANGA Emile 222003205-->2024
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";//this is empty because I din't set any password
                $dbname = "organic_baby_clothing";


                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM orders";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about orders</title>";
    echo "<h1>The Information about orders</h1>";
    echo "<table border='1'>
            <tr>
            <th>order_id</th>
            <th>customer_id</th>
            <th>order_date</th>
            <th>total_price</th>
            <th>status</th>
            <th>shipping_address</th>
            </tr>";

     

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
       echo "<td> " . $row["customer_id"] . "</td>";
    echo "<td>" . $row["order_date"] . "</td>";
    echo "<td> " . $row["total_price"] . "</td>";
    echo "<td> " . $row["status"] . "</td>";
    echo "<td> ".$row["shipping_address"] . "</td>";
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//<!-- NIYITANGA Emile 222003205--> 2024

$conn->close();
?>
