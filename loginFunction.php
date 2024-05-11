<?php
include 'db_connection.php';

// Function to authenticate user by username
function authenticateByUsername($username, $password) {
    global $conn;

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify password
        if ($password === $user['password']) { // Compare plaintext passwords
            return $user; // User authenticated successfully
        }
    }

    return null; // Authentication failed
}

// Perform server-side validation and authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username']; // Change variable name to $username
    $password = $_POST['password'];
    $rememberMe = $_POST['rememberMe'];
    
    // Perform authentication using username
    $user = authenticateByUsername($username, $password);

    // Check if authentication is successful
    // Check if authentication is successful
if ($user !== null) {
    // Authentication successful
    session_start();
    $_SESSION['user_id'] = $user['id']; // Store user ID in session variable
    $_SESSION['username'] = $user['username']; // Store username in session variable
    $_SESSION['first_name'] = $user['first_name']; // Store first name in session variable
    $_SESSION['last_name'] = $user['last_name']; // Store last name in session variable
    $response = array('success' => true, 'message' => 'Login successful!', 'userId' => $user['id']);
    // Optionally, you can set cookies or session variables for remembering the user
    if ($rememberMe) {
        // Set cookies or session variables for "Remember Me" functionality
    }
} else {
    // Authentication failed
    $response = array('success' => false, 'message' => 'Invalid username or password.');
}


    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


