<?php
session_start(); // Start the session
include 'db_connection.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve form data
        $firstName = $_POST["signupFirstName"];
        $lastName = $_POST["signupLastName"];
        $username = $_POST["signupUsername"];
        $age = $_POST["signupAge"];
        $password = $_POST["signupPassword"];

        // Check if the username or email already exists in the database
        $checkSql = "SELECT * FROM users WHERE username = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$username,]);
        $existingUser = $checkStmt->fetch();

        if ($existingUser) {
            // Username or email already exists, set session error message
            $_SESSION['error'] = "Username or email already exists. Please choose a different one.";
            // Redirect back to the signup form
            header("Location: login.php");
            exit();
        } else {
            // Insert new user into the database
            $sql = "INSERT INTO users (first_name, last_name, username, age, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$firstName, $lastName, $username, $age, $password]);

            // Redirect the user to the home page
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
        echo "<script>";
        echo "console.error('Error: " . $e->getMessage() . "');";
        echo "</script>";
        // Redirect back to the signup form
        header("Location: login.php");
        exit();
    }
}

header("Location: login.php");
exit();
?>
