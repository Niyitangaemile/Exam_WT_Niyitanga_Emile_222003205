<?php
// NIYITANGA Emile 222003205--> 2024
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "organic_baby_clothing";


                // Create database connection
                $conn = new mysqli($servername, $username, $email, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM suppliers";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about supplier</title>";
    echo "<h1>The Information about supplier</h1>";
    echo "<table border='1'>
            <tr>
                <th>supplier_id</th>
                <th>name</th>
                <th>contact_person</th>
               <th>email</th>
                <th>phone_number</th>
                <th>address</th>
               
            </tr>";

     //<!-- NIYITANGA Emile 222003205-- 2024

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["supplier_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["contact_person"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//habiyaremye daniel 222007495 april 2024

$conn->close();
?>
