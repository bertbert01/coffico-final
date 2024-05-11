// Retrieve cart items from localStorage



// function displayCartItems() {
//     const cartContainer = document.getElementById('cart-items');
//     cartContainer.innerHTML = '';

//     // Make an AJAX request to fetch cart items from the database
//     $.ajax({
//         url: 'fetchCartItems.php', // Path to your PHP script handling the cart items retrieval
//         type: 'GET',
//         success: function(response) {
//             // Parse the JSON response
//             const cartItems = JSON.parse(response);

//             // Iterate through each item in the cart
//             cartItems.forEach((item) => {
//                 const itemContainer = document.createElement('div');
//                 itemContainer.classList.add('item-container');

//                 // Create image element
//                 const itemImage = document.createElement('img');
//                 itemImage.src = item.image; // Assuming the image URL is stored in the 'image' column
//                 itemImage.alt = item.name;
//                 itemImage.width = 100;
//                 itemImage.height = 100;

//                 const itemDetails = document.createElement('div');
//                 itemDetails.classList.add('item-details');

//                 const itemName = document.createElement('name');
//                 itemName.textContent = item.name;

//                 const itemPrice = document.createElement('p');
//                 itemPrice.textContent = '₱' + item.price;

//                 const quantityContainer = document.createElement('div');
//                 quantityContainer.classList.add('quantity-container');

//                 const quantityLabel = document.createElement('label');
//                 quantityLabel.textContent = 'Quantity:';

//                 const quantityInput = document.createElement('input');
//                 quantityInput.type = 'number';
//                 quantityInput.min = 1;
//                 quantityInput.value = item.quantity || 1; // Set default quantity to 1 if not previously set
//                 quantityInput.classList.add('quantity-input');

//                 quantityContainer.appendChild(quantityLabel);
//                 quantityContainer.appendChild(quantityInput);

//                 itemDetails.appendChild(itemName);
//                 itemDetails.appendChild(itemPrice);
//                 itemDetails.appendChild(quantityContainer);

//                 itemContainer.appendChild(itemImage); // Append image to item container
//                 itemContainer.appendChild(itemDetails);

//                 const deleteButton = document.createElement('button');
//                 deleteButton.textContent = 'Remove';
//                 deleteButton.onclick = () => deleteCartItem(item.id); // Pass item id instead of index
//                 itemContainer.appendChild(deleteButton);

//                 cartContainer.appendChild(itemContainer);
//             });

//             displayTotalPrice(); // Update total price after displaying cart items
//         },
//         error: function(xhr, status, error) {
//             console.error('AJAX Error:', status, error);
//             // Handle error
//         }
//     });
// }




// Function to update quantity of an item in the cart
// function updateCartItemQuantity(index, quantity) {
//     cartItems[index].quantity = quantity;
//     localStorage.setItem('cart', JSON.stringify(cartItems));
//     displayTotalPrice();
// }

// Function to decrement quantity
function decrementQuantity(itemId) {
    var quantityInput = document.getElementById('quantity_' + itemId);
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        updateCartItemQuantity(itemId, currentQuantity - 1);
    }
}

// Function to increment quantity
function incrementQuantity(itemId) {
    var quantityInput = document.getElementById('quantity_' + itemId);
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
    updateCartItemQuantity(itemId, currentQuantity + 1);
}

// Function to update cart item quantity via AJAX
function updateCartItemQuantity(itemId, newQuantity) {
    // Make an AJAX request to update the cart item quantity
    $.ajax({
        url: 'updateCartItemQuantity.php',
        type: 'POST',
        data: { itemId: itemId, newQuantity: newQuantity },
        success: function(response) {
            // Handle success response
            console.log('Quantity updated successfully!');
            // Reload the page after updating
            location.reload();
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error updating quantity:', error);
        }
    });
}
function submitQuantityForm(itemId) {
    var form = document.getElementById('quantityForm_' + itemId);
    form.submit();
}

// Function to delete an item from the cart
function deleteCartItem(itemId) {
    // Make an AJAX request to delete the cart item
    $.ajax({
        url: 'deleteCartItem.php',
        type: 'POST',
        data: { itemId: itemId },
        success: function(response) {
            // Handle success response
            console.log('Item deleted successfully!');
            // Reload the page after deletion
            location.reload();
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error deleting item:', error);
        }
    });
}

function clearCart() {
    // Make an AJAX request to the PHP script that contains the clearCart function
    $.ajax({
        url: 'clearCart.php', // Path to your PHP script containing the clearCart function
        type: 'POST',
        success: function(response) {
            // Handle the response from the server
            var data = JSON.parse(response);
            if (data.success) {
                // Cart cleared successfully
                
            } else {
                // Error occurred while clearing cart
                
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error clearing cart:', error);
        }
    });
}

// Function to calculate and display the total price
function displayTotalPrice() {
    const totalPriceElement = document.getElementById('total-price');
    const totalPrice = cartItems.reduce((total, item) => total + (item.price * (item.quantity || 1)), 0); // Calculate total price taking quantity into account
    totalPriceElement.textContent = 'Total Price: ₱' + totalPrice.toFixed(2);

    // Update total price in Gcash modal
    const gcashTotalPriceElement = document.getElementById("gcashTotalPrice");
    if (gcashTotalPriceElement) {
        gcashTotalPriceElement.textContent = 'Total Price: ₱' + totalPrice.toFixed(2);
    }
}

// Function to download order information as an image
function downloadOrderAsImage() {
    var orderModal = document.getElementById("orderModal");

    // Use HTML2Canvas to capture the order modal content as an image
    html2canvas(orderModal).then(canvas => {
        // Convert canvas to image data URL
        var imgData = canvas.toDataURL('image/png');

        // Create an anchor element with the image data URL
        var downloadLink = document.createElement('a');
        downloadLink.href = imgData;
        downloadLink.download = 'order_info.png';
        
        // Append anchor to the body and click it programmatically to trigger download
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });
}

// Function to show the order modal
function showOrderModal(paymentMethod) {
    hidePaymentModal();
    var orderModal = document.getElementById("orderModal");
    orderModal.style.display = "block";

    // Clear previous order items
    document.getElementById("orderItemsList").innerHTML = "";

    // Get all the items from the cart
    var cartItems = document.querySelectorAll(".item-container");

    var totalPrice = 0;

    // Loop through each item and extract image, name, and price
    cartItems.forEach(function(item) {
        var itemName = item.querySelector(".item-details name:first-child").innerText;
        var itemImage = item.querySelector(".item-container img").outerHTML;
        var itemPrice = parseFloat(item.querySelector(".item-details p:nth-child(2)").innerText.replace('₱', ''));
        var quantity = parseInt(item.querySelector(".quantity-input").value);

        // Create list item element to display image, name, and price
        var listItem = document.createElement("li");
        listItem.innerHTML = itemImage + "<p>" + itemName + " - ₱" + (itemPrice * quantity).toFixed(2) + " x " + quantity + "</p>";

        // Append the list item to the order items list
        document.getElementById("orderItemsList").appendChild(listItem);

        // Calculate total price
        totalPrice += itemPrice * quantity;
    });

    // Display total price in order information
    document.getElementById("orderTotalPrice").textContent = 'Total Price: ₱' + totalPrice.toFixed(2);
}

// Function to hide the order modal
function hideOrderModal() {
    var orderModal = document.getElementById("orderModal");
    orderModal.style.display = "none";
}

// Function to show the Gcash container
function showGcashContainer() {
    var gcashContainer = document.getElementById("gcashContainer");
    gcashContainer.style.display = "block";
    
    // Update total price in Gcash modal
    displayTotalPrice();
}

// Call display functions when the page loads
window.onload = () => {
    displayCartItems();
};
