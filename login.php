<?php
include 'db_connection.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple HTML Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center; /* Center align items horizontally */
            justify-content: center; /* Center align items vertically */
            background-color: #E7DCC8;
            margin: 0; /* Remove default margin */
            position: relative; /* Make the body a positioning context for absolute positioning */
        }
        footer {
          padding: 0;
          text-align: center;
          margin-top: auto;
        }
        footer a {
          
          text-decoration: none;
          margin: 0 10px;
        }
        .login-container {
            background-color: transparent;
            border-radius: 50%; /* Change to make it circular */
            padding: 80px; /* Reduced padding */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: auto;
            height: 340px; /* Adjusted height */
            width: 340px; /* Adjusted width */
            position: relative; /* Relative positioning for absolute positioning of logo */
            border: 10px solid;
            border-color: #816246;
        }
        .login-container form {
            text-align: center; /* Align the content inside the form to center */
        }
        .form-group {
            border-radius: 15px; /* Adjusted radius */
            position: relative; /* Relative positioning for absolute positioning of logo */
            margin-top: 15px;
            text-align: center;
        }
        .form-control {
            border-radius: 20px; /* Adjusted radius for text inputs */
            background-color: #816246;
            position: relative; /* Relative positioning for absolute positioning of logo */
            border-left: none; /* Remove left border */
        }
        .logo {
            position: absolute; /* Absolute positioning for logo */
            left: -10px; /* Align to the left */
            top: 70%; /* Center vertically */
            transform: translateY(-50%);
            height: 50px; /* Adjust height as needed */
            width: 50px; /* Adjust width as needed */
            border-radius: 100%; /* Make it rounded */
            border: 3px solid #816246;
            z-index: 1; /* Ensure the logo stays above the input */        
        }
        .logo-right {
            right: -10px; /* Align to the right */
            left: auto; /* Remove left alignment */
        }
        h2 {
            margin: 0 auto; /* Center the text horizontally */
            margin-top: -55px;
            text-align: center; /* Center the text horizontally */
            font-size: 28px;
        }
        .btn-primary {
            background-color: #816246; /* Change the background color to green */
        }
        .sign-up {
            font-size: 14px; /* Reduce font size */
            margin-top: 5px; /* Adjust margin */
        }
        .foot {
          background-color: rgba(255, 255, 255, 0.6);
          border: 2px solid black;
          border-radius: 100%;
          margin-bottom: 15px;
        }
    </style>
</head>
<body>

<!-- Login Form -->
<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div class="form-group">
            <!-- Logo Image -->
            <img src="images/login.jpg" alt="Logo" class="logo">
            <label for="username" style="margin-bottom: 0;">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required style="padding-left: 42px">
        </div>
        <div class="form-group">
            <!-- Logo Image on the right side -->
            <img src="images/sec.jpg" alt="Logo" class="logo logo-right">
            <label for="password" style="margin-bottom: 0;">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="button" id="loginBtn" class="btn btn-primary" style="border-radius: 20px;">Login</button>
        <p class="sign-up"> Don't have an account? <a href="#" style="color: blue;" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a></p>
        <div id="loginMessage" class="text-danger"></div>

    </form>
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalTitle" style="color: black;">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="signup.php" method="post" id="signupForm">
                    <div class="form-group">
                        <label for="signupFirstName" class="kanit-light" style="color: black;">First Name</label>
                        <input type="text" class="form-control" id="signupFirstName" name="signupFirstName" placeholder="Enter your first name">
                    </div>
                    <div class="form-group">
                        <label for="signupLastName" class="kanit-light" style="color: black;">Last Name</label>
                        <input type="text" class="form-control" id="signupLastName" name="signupLastName" placeholder="Enter your last name">
                    </div>
                    <div class="form-group">
                        <label for="signupUsername" class="kanit-light" style="color: black;">Username</label>
                        <input type="text" class="form-control" id="signupUsername" name="signupUsername" placeholder="Choose a username">
                    </div>
                    <div class="form-group">
                        <label for="signupAge" class="kanit-light" style="color: black;">Age</label>
                        <input type="number" class="form-control" id="signupAge" name="signupAge" placeholder="Enter your age">
                    </div>
                    <div class="form-group">
                        <label for="signupPassword" class="kanit-light" style="color: black;">Password</label>
                        <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Choose a password">
                    </div>
                    <!-- Error message display -->
                    <?php
                    // Check if there's an error message in the session
                    if (isset($_SESSION['error'])) {
                        // Display the error message
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';
                        // Unset the session variable to clear the error message
                        unset($_SESSION['error']);
                    }
                    ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="signupButton">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div> 
  
   <footer style="margin-top: auto; display: flex; justify-content: space-evenly;">
        <a href="index.php" style="margin-left: 10px;"><img src="images/home.png" alt="Home" style="height: 60px;" class="foot"></a>
        <a href="product.php"><img src="images/products.png" alt="Products" style="height: 60px;" class="foot"></a>
        <a href="cart.php"><img src="images/cart.png" alt="Cart" style="height: 60px; width: auto;" class="foot"></a>
        <a href="contact.html" style="margin-right: 10px;"><img src="images/contacts.png" alt="Contacts" style="height: 60px;" class="foot"></a>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
$(document).ready(function() {
    $('#loginBtn').click(function(e) {
        e.preventDefault(); // Prevent default form submission

        var username = $('#username').val();
        var password = $('#password').val();
        var rememberMe = $('#rememberMe').is(':checked') ? 1 : 0;

        // AJAX request to server for authentication
        $.ajax({
            url: 'loginFunction.php', // PHP script handling authentication
            type: 'POST',
            data: {
                username: username, // Use only username
                password: password,
                rememberMe: rememberMe
            },
            success: function(response) {
                // Check the response from the server
                if (response.success) {
                    // Authentication successful, display success message
                    $('#loginMessage').text(response.message).removeClass('text-danger').addClass('text-success');
                    if ('userId' in response) {
                        // Display userId
                        $('#userId').text('User ID: ' + response.userId);
                    }
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 2000);
                } else {
                    // Authentication failed, display error message
                    $('#loginMessage').text(response.message).addClass('text-danger');
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error:', status, error);
                // Display error message
                $('#loginMessage').text('An error occurred while processing your request. Please try again later.').addClass('text-danger');
            }
        });
    });
});


    </script>
</body>
</html>
