<?php
session_start(); // Start the session

// Include your database connection file
include 'db_connection.php';

function clearCart($userId, $conn) {
    // Check if the user is logged in
    if (isset($userId)) {
        // Prepare SQL statement to delete cart items for the user
        $sql_delete_cart = "DELETE FROM cart WHERE user_id = ?";
        $stmt_delete_cart = $conn->prepare($sql_delete_cart);
        $stmt_delete_cart->bind_param("i", $userId);

        // Execute the statement
        if ($stmt_delete_cart->execute()) {
            return true; // Cart cleared successfully
        } else {
            return false; // Error occurred while clearing cart
        }
    } else {
        return false; // User is not logged in
    }
}

// Usage example:
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        // Call the clearCart function
        if (clearCart($userId, $conn)) {
            echo json_encode(['success' => true, 'message' => 'Cart cleared successfully!']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to clear cart.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
