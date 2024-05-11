<?php
session_start(); // Start the session

// Include your database connection file
include 'db_connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Prepare and execute the SQL statement to fetch cart items based on user ID
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create an array to store cart items
    $cartItems = array();

    // Fetch each row from the result set and add it to the cart items array
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    // Close the statement
    $stmt->close();

    // Return JSON response containing the cart items
    header('Content-Type: application/json');
    echo json_encode($cartItems);
} else {
    // User is not logged in
    // Return an empty JSON array
    echo json_encode([]);
}
?>
