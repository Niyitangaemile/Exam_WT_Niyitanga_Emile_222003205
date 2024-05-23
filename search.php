<?php
session_start();

// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";
//niyitanga emile search place---------------------//

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];
    $output = "";

    $queries = [
        'products' => "SELECT product_id,name, description, category, price, material, image_url FROM products WHERE product_id LIKE '%$searchTerm%'",
        'inventory' => "SELECT inventory_id,product_id, quantity_available, quantity_sold, reorder_threshold FROM inventory WHERE inventory_id LIKE '%$searchTerm%'",
         'orders' => "SELECT order_id,customer_id, order_date, total_price, status, shipping_address FROM orders WHERE order_id LIKE '%$searchTerm%'",
          'users' => "SELECT user_id,username, role, email, password FROM users WHERE user_id LIKE '%$searchTerm%'",
           'reviews' => "SELECT review_id,product_id, customer_id, rating, review_text, review_date FROM reviews WHERE review_id LIKE '%$searchTerm%'",
            'suppliers' => "SELECT supplier_id, name, address, contact_person, email, phone_number FROM suppliers WHERE supplier_id LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $output .= "<h3>Table of $table:</h3>";
        
        if ($result) {
            if ($result->num_rows > 0) {
                $output .= "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $output .= "<li>";
                    foreach ($row as $key => $value) {
                        $output .= "$key: $value, ";
                    }
                    $output .= "</li>";
                }
                $output .= "</ul>";
            } else {
                $output .= "<p>No results found in $table matching the search term: '$searchTerm'</p>";
            }
        } else {
            $output .= "<p>Error executing query: " . $connection->error . "</p>";
        }
    }

    echo $output;

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
