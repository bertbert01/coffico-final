<?php
session_start();
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('images/bg_new.png');
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 0;
            text-align: center;
        } 
        footer a {
            text-decoration: none;
            margin: 0 10px;
        }

        .delete-button {
            position: absolute;
            top: 0;
            right: 0;
            left: 50%;
            transform: translateX(50%);
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
         
        .item-container {
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-radius: 10px;         
        }
        .item-container img {
            border-radius: 15px;
        }
    
        .item-image {
            border-radius: 10px;
            margin-right: 50px;
            border: 5px solid black;
        }

        .item-details {
            flex-grow: 1;
            margin-left: 10px;
        }

        .item-name {
            margin: 0;
            margin-bottom: 100px;
            font-family: "Oswald", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }

        .item-price {
            display: flex;
            margin: 0;
            margin-bottom: 3px;
        }

        .quantity-container {
            display: flex;
            align-items: center;
            margin-top: -40px;
        }
 
        .quantity-label {
            margin-right: 10px;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
        }

        .quantity-button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            border-radius: 5px;
        }

        .item-container button {
            position: relative;
            margin-left: 10;         
            height: 30px;
            width: 30px;
            font-size: 18px;
            border-radius: 5px;
        }

        .item-container input[type="number"] {
            height: 30px;
            width: 30px;
            text-align: center;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8);
            width: 90%;
            height: auto;
            margin-top: 20px;
            margin-bottom: 80px;
            border-radius: 15px;
            border: 6px solid rgba(128, 128, 128, 0.5);
            display: flex;
            flex-direction: column;
        }

        .total-price {
            font-size: 18px;
            color: #333;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .total-price::before {
            content: "";
            display: block;
            width: 100%;
            border-top: 2px solid black;
        }

        .buy-button {
            font-size: 16px;
            background-color: #816246;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            align-self: flex-end;
            margin-right: 0;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .foot {  
            background-color: rgba(255, 255, 255, 0.6);
            border: 2px solid black;      
            border-radius: 100px;
            margin-bottom: 15px;
            height: 40px; /* Set the same height as the footer images */
            width: auto; /* Allow width to adjust based on height */
        }
        .limelight-regular {
            font-family: "Limelight", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Styles for buttons inside modal */
        .modal-content button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: none;
            background-color: #f1f1f1;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #ddd;
        }

        .modal-content img {
            border-radius: 10px;
        }

        .main-content name {
            font-family: "Oswald", sans-serif;
            font-weight: 700;
            font-style: normal;
            border-radius: 10px;
        }
  .modal-container {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 10px;
    border: 1px solid #888;
    width: 90%;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.modal-container h3 {
    margin-top: 0;
}

.modal-container img {
    border-radius: 10px;
    width: 100%;
}

    </style>
</head>
<body>

<div class="container">
    <h2 class="limelight-regular">Coffee Cart</h2>
    <div class="main-content">
    <?php


// Include your database connection file
include 'db_connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Prepare and execute the SQL statement to fetch cart items with product details based on user ID
    $sql = "SELECT c.id, p.name AS product_name, p.price AS product_price, p.image AS product_image, c.quantity
            FROM cart c
            INNER JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are cart items
    if ($result->num_rows > 0) {
        // Iterate through each cart item
        while ($row = $result->fetch_assoc()) {
            $itemId = $row['id'];
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];
            $productQuantity = $row['quantity'];
            $productImage = $row['product_image'];

            // Output HTML for each cart item
            ?>
            <div class="item-container">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" width="100" height="100">
                <div class="item-details">
                    <name><?php echo $productName; ?></name>
                    <p>₱<?php echo $productPrice; ?></p>
                    <p>₱<?php echo $productPrice; ?></p>
                    <div class="quantity-container">
                        <button onclick="decrementQuantity(<?php echo $itemId; ?>)">-</button>
                            <input type="number" min="1" value="<?php echo $productQuantity; ?>" class="quantity-input" id="quantity_<?php echo $itemId; ?>">
                        <button onclick="incrementQuantity(<?php echo $itemId; ?>)">+</button>
                    </div>
                    
                </div>
                <button onclick="deleteCartItem(<?php echo $itemId; ?>)">×</button>
            </div>
            <?php
        }
    } else {
        // No cart items found
        echo "Your cart is empty.";
    }

    // Close the statement
    $stmt->close();
} else {
    // User is not logged in
    echo "Please log in to view your cart.";
}
?>


        <div class="total-price">
        <?php
include 'db_connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Include the file containing the function
    include 'totalPriceFunctions.php';

    // Call the function to calculate the total price
    $userId = $_SESSION['user_id']; // Assuming user ID is stored in session
    $totalPrice = calculateTotalPrice($userId);

    // Output the total price
    echo 'Total Price: ₱' . number_format($totalPrice, 2); // Format the total price with two decimal places
} else {
    // User is not logged in, display a message or handle it accordingly
    echo "Total Price: ₱";
}
?>
        </div>
    </div>
    
    <?php
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0) {
        // Check if cart is not empty
        if ($result->num_rows > 0) {
            // User is logged in and cart is not empty, show normal "Go to checkout" button
            echo '<button class="buy-button" onclick="showPaymentModal()">Buy</button>';
        } else {
            // Cart is empty, show "No items" button and disable it
            echo '<button class="buy-button" style="font-size: inherit; background-color: #ccc; cursor: not-allowed;" disabled>No products</button>';
        }
    } else {
        // User is not logged in, show greyed out "Login to Checkout" button
        echo '<button class="buy-button" style="font-size: inherit; background-color: #ccc; cursor: not-allowed;" disabled>Please Login</button>';
    }
    ?>
    
</div>

<!-- Modal for payment methods -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="hidePaymentModal()">&times;</span>
        <h2>Select Payment Method</h2>
        <button onclick="showOrderModal('Counter Payment')">Counter Payment</button>
        <button onclick="showGcashContainer()">Gcash</button>

        <div id="gcashContainer" class="modal-container" style="display: none;">
            <!-- Add content for Gcash payment here -->
            <h3>Gcash Payment</h3>
            <p class="total-price">
                <?php
                echo 'Total Price: ₱' . number_format($totalPrice, 2);
                ?>
            </p>
            <p>Scan the QR code below to proceed with the payment:</p>
            <img src="images/qr.jpg" alt="Gcash QR Code">
          <a href="product.php">
             <button>Change Order</button>
          </a>
          <a href="review.html">
             <button onclick="clearCart()">Done</button>
          </a>
        </div>
    </div>
</div>
  
<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="hideOrderModal()">&times;</span>
        <h2 id="orderModalTitle">Order Information</h2>
        <!-- Add order information here -->
        <p id="paymentMethodText"></p>
        <p>Order Items:</p>
        <ul id="orderItemsList"></ul>
        <p>Kindly present this and hand in your payment to the cashier. Thank you!</p>
        <!-- Add download button for image -->
      <a href="product.php">
             <button>Change Order</button>
      </a>
      <a href="review.html">
        <button onclick="clearCart()">Done</button>
      </a>
    </div>
</div>
  

<footer style="margin-top: auto; display: flex; justify-content: space-evenly;">
    <a href="index.php" style="margin-left: 10px;"><img src="images/home.png" alt="Home" style="height: 60px;" class="foot"></a>
    <a href="product.php"><img src="images/products.png" alt="Products" style="height: 60px;" class="foot"></a>
    <a href="cart.php"><img src="images/cart.png" alt="Cart" style="height: 60px; width: auto;" class="foot"></a>
    <a href="contact.html" style="margin-right: 10px;"><img src="images/contacts.png" alt="Contacts" style="height: 60px;" class="foot"></a>
</footer>

<!-- JavaScript for handling modals -->
<script>
    // Get the payment modal
    var paymentModal = document.getElementById("paymentModal");

    // Get the order modal
    var orderModal = document.getElementById("orderModal");

    // Function to show the payment modal
    function showPaymentModal() {
        paymentModal.style.display = "block";
    }

    // Function to hide the payment modal
    function hidePaymentModal() {
        paymentModal.style.display = "none";
    }

    // Function to show the Gcash container
    function showGcashContainer() {
        var gcashContainer = document.getElementById("gcashContainer");
        gcashContainer.style.display = "block";
        // Update total price in Gcash modal
        var totalPrice = calculateTotalPrice(); // You need to implement this function to calculate the total price
        var gcashTotalPriceElement = document.getElementById("gcashTotalPrice");
        gcashTotalPriceElement.textContent = 'Total Price: ₱' + totalPrice.toFixed(2);
    }

    // Function to move items to the review page
function moveToReview() {
    // Get all the items from the cart
    var cartItems = document.querySelectorAll(".item-container");

    // Store items to review in local storage
    var itemsToReview = [];
    cartItems.forEach(function(item) {
        var itemName = item.querySelector(".item-name").innerText;
        itemsToReview.push(itemName);
    });
    localStorage.setItem("itemsToReview", JSON.stringify(itemsToReview));

    // Redirect to review page
    window.location.href = "review.html";
}

// Function to show the order modal
function showOrderModal(paymentMethod) {
    hidePaymentModal();
    orderModal.style.display = "block";

    // Clear previous order items
    document.getElementById("orderItemsList").innerHTML = "";

    // Get all the items from the cart
    var cartItems = document.querySelectorAll(".item-container");

    var totalPrice = 0;

    // Loop through each item and extract image, name, and quantity
    cartItems.forEach(function(item) {
        var itemName = item.querySelector(".item-name").innerText;
        var itemImage = item.querySelector(".item-image").outerHTML;
        var itemPrice = parseFloat(item.querySelector(".item-price").innerText.replace('₱', ''));
        var quantity = parseInt(item.querySelector(".quantity-input").value);

        // Create list item element to display image, name, and quantity
        var listItem = document.createElement("li");
        listItem.innerHTML = itemImage + "<p>" + itemName + " (Quantity: " + quantity + ")</p>";

        // Append the list item to the order items list
        document.getElementById("orderItemsList").appendChild(listItem);

        // Calculate total price including quantity
        totalPrice += itemPrice * quantity;
    });

    // Display total price
    document.getElementById("total-price-order").textContent = 'Total Price: &#8369;' + totalPrice.toFixed(2);

    // Add event listener to the "Done" button inside the order modal
    var doneButton = document.getElementById("doneButton");
    doneButton.addEventListener("click", function() {
        // Call moveToReview function to move items to the review page
        moveToReview();
    });
}


    // Call showOrderModal when the page loads
    window.onload = function() {
        showOrderModal(); // Automatically show order items and total price when the page loads
    };
</script>


<script src="cart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
