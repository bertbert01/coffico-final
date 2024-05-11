<?php
session_start(); // Start the session

// Include your database connection file
include 'db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get the item ID and new quantity from the POST data
        $itemId = $_POST['itemId'];
        $newQuantity = $_POST['newQuantity'];

        // Prepare and execute the SQL statement to update the quantity of the cart item
        $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $newQuantity, $itemId);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Update successful
            echo json_encode(['success' => true, 'message' => 'Quantity updated successfully!']);
        } else {
            // Update failed
            echo json_encode(['success' => false, 'error' => 'Failed to update quantity.']);
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
