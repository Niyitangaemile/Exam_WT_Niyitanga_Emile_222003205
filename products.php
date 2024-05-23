<?php
//-- NIYITANGA Emile 222003205 2024
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "organic_baby_clothing";


                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM products";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about products</title>";
    echo "<h1>The Information about products</h1>";
    echo "<table border='1'>
            <tr>
            <th>product_id</th>
            <th>name</th>
            <th>description</th>
            <th>category</th>
            <th>price</th>
            <th>material</th>
            <th>image_url</th>
            </tr>";

     //<!-- NIYITANGA Emile 222003205-- 2024

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["material"] . "</td>";
        echo "<td>" . $row["image_url"] . "</td>";
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//<!-- NIYITANGA Emile 222003205-- 2024

$conn->close();
?>
