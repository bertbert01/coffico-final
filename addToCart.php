<?php
session_start(); // Start the session

// Include your database connection file
include 'db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get the product ID, user ID, quantity, and username from the POST data
        $productId = $_POST['productId'];
        $userId = $_SESSION['user_id'];
        $quantity = $_POST['quantity'];
        $username = $_SESSION['username'];

        // Check if the item already exists in the cart
        $sql_check_existing_item = "SELECT id, quantity FROM cart WHERE product_id = ? AND user_id = ?";
        $stmt_check_existing_item = $conn->prepare($sql_check_existing_item);
        $stmt_check_existing_item->bind_param("ii", $productId, $userId);
        $stmt_check_existing_item->execute();
        $result_check_existing_item = $stmt_check_existing_item->get_result();

        if ($result_check_existing_item->num_rows > 0) {
            // If the item already exists, fetch its ID and quantity
            $row_check_existing_item = $result_check_existing_item->fetch_assoc();
            $itemId = $row_check_existing_item['id'];
            $quantity += $row_check_existing_item['quantity'];

            // Update quantity for the existing item
            $sql_update_quantity = "UPDATE cart SET quantity = ? WHERE id = ?";
            $stmt_update_quantity = $conn->prepare($sql_update_quantity);
            $stmt_update_quantity->bind_param("ii", $quantity, $itemId);
            if ($stmt_update_quantity->execute()) {
                // Quantity updated successfully
                echo json_encode(['success' => true, 'message' => 'Item quantity updated in cart.']);
            } else {
                // Error occurred while updating quantity
                echo json_encode(['success' => false, 'error' => 'Failed to update item quantity in cart.']);
            }
        } else {
            // If the item does not exist, insert it into the cart table
            $sql_insert = "INSERT INTO cart (product_id, user_id, quantity, username) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("iiis", $productId, $userId, $quantity, $username);

            if ($stmt_insert->execute()) {
                // Item inserted successfully
                echo json_encode(['success' => true, 'message' => 'Item added to cart successfully!']);
            } else {
                // Error occurred
                echo json_encode(['success' => false, 'error' => 'Failed to add item to cart.']);
            }
        }
    } else {
        // User is not logged in
        echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}

?>
