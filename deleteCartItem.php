<?php
session_start(); // Start the session

// Include your database connection file
include 'db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get the item ID from the POST data
        $itemId = $_POST['itemId'];

        // Prepare and execute the SQL statement to delete the cart item
        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemId);
        
        if ($stmt->execute()) {
            // Deletion successful
            echo json_encode(['success' => true, 'message' => 'Item deleted successfully!']);
        } else {
            // Deletion failed
            echo json_encode(['success' => false, 'error' => 'Failed to delete item.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // User is not logged in
        echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
