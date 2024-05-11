<?php
function calculateTotalPrice($userId) {
    // Include your database connection file
    include 'db_connection.php';

    // Prepare and execute the SQL statement to fetch cart items based on user ID
    $sql = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize total price
    $totalPrice = 0;

    // Fetch each row from the result set and calculate total price
    while ($row = $result->fetch_assoc()) {
        // Retrieve product details (price) from the products table using product_id
        $productId = $row['product_id'];
        $quantity = $row['quantity'];

        // Query to get product price
        $productQuery = "SELECT price FROM products WHERE id = ?";
        $stmtProduct = $conn->prepare($productQuery);
        $stmtProduct->bind_param("i", $productId);
        $stmtProduct->execute();
        $resultProduct = $stmtProduct->get_result();

        // If product exists, calculate total price
        if ($resultProduct->num_rows > 0) {
            $productData = $resultProduct->fetch_assoc();
            $productPrice = $productData['price'];
            $totalPrice += $productPrice * $quantity;
        }

        // Close product statement
        $stmtProduct->close();
    }

    // Close the statement
    $stmt->close();

    // Close database connection
    $conn->close();

    // Return the total price
    return $totalPrice;
}
?>