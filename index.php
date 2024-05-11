<?php
session_start();
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

        header {
            padding: 20px;
        }

        .carousel {
            width: 50%;
            height: 100%;
            margin: 0 auto;
            margin-bottom: 80px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item {
            text-align: center;
            position: relative;
        }

        .carousel-item img {
            height: 350px;
            width: 100%;
            object-fit: cover;
            border-radius: 50px;
            border: 2px solid white;
            margin-top: 5px;
        }

        .product-description {
            display: none;
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

        .coffee-categories {
            text-align: center;
            margin-top: 20px;
            border: 2px solid #ccc;
            padding: 10px;
        }

        .coffee-categories h4 {
            margin-bottom: 10px;
        }

        .coffee-categories ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .coffee-categories ul li {
            display: inline-block;
            margin-right: 10px;
            justify-content: space-between;
        }

        .input-group {
            display: flex;
            align-items: center;
            width: auto;
        }

        .dropdown-toggle {
            border-radius: 50%;
            padding: 12px;
            background-color: skyblue;
            border: none;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:active,
        .dropdown-toggle:focus {
            background-color: rgb(204, 204, 204) !important;
        }

        .search-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15px;
        }

        .mylogo {
            margin-top: -5px;
        }

        .logo {
            height: 40px;
            width: 40px;
            margin-right: 0px;
            cursor: pointer;
            border-radius: 100%;
            object-fit: cover;
        }

        .foot {
            background-color: rgba(255, 255, 255, 0.6);
            border: 2px solid black;
            border-radius: 100px;
            margin-bottom: 15px;
            height: 40px;
            width: auto;
        }

        .additional-images {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 20px;
            margin-left: 15px;
            margin-right: 15px;
            height: auto;
        }

        .additional-images img {
            margin-top: 8px;
            max-width: 100%;
            margin-bottom: 10px;
            height: 60px;
            width: 60px
        }

        .cat {
            border: 3px solid white;
            border-radius: 100%;
            border-bottom-right-radius: 120px;
            border-bottom-left-radius: 120px;
        }

        .text-color {
            background-color: white;
            color: black;
        }

        .oswald-font {
            background-color: white;
            font-family: "Oswald", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            padding: 0px 4px 0px 4px;
            font-style: normal;
            border-radius: 10px;
        }

        .bj {
            height: 50px;
            width: 90px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 100px;
            object-fit: cover;
        }

        @media only screen and (max-width: 768px) {
            .carousel {
                margin-top: 30px;
                width: 100%;
            }
        }

        /* Additional styles for the introduction */
        .intro {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
            text-align: center;
            border-radius: 10px;
            margin-top: 20px; /* Adjust margin-top to your preference */
        }

        .intro h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 36px;
            margin-bottom: 20px;
            color: #383838;
        }

        .intro p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header class="container-fluid">
        <span class="mylogo" style="float: left; margin-right: 10px;">
            <a><img src="images/bj.png" alt="Logo" class="bj"></a>
        </span>
        <span class="logo-container" style="float: right;">
            
            <div class="dropdown">
            <a href="#" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #FFD5AA; text-decoration: none;">
            <img src="images/login.jpg" alt="Logo" class="logo">
            <?php
            if(isset($_SESSION['user_id'])) {
                echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
            } else {
                echo 'No account';
            }
            ?>
        </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                
                <?php
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
            echo '<a class="dropdown-item" style="cursor: pointer;" href="logout.php">Log out</a>';
        } else {
            echo '<a class="dropdown-item" style="cursor: pointer;" href="login.php">Log in</a>';
        }
        ?>
            </div>
            </div>
        </span>
        <span class="input-group" style="float: right; margin-right: 15px;">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button"
            data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false" data-bs-toggle="dropdown">
                    <img src="images/search.svg" class="search-icon">
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="productDropdown">
            <li>
            <div class="input-group mt-2 mx-0">
    <div class="form-outline" data-mdb-input-init>
        <input type="text" id="searchInput" class="form-control" placeholder="Search products">
    </div>
</div>
            </li>
            <li>
                <hr class="dropdown-divider" />
            </li>
            <div id="searchResults" class="mt-2"></div>
        </ul>
            </div>
        </span>
    </header>

    <div style="text-align: center;">
        <!-- Additional images section -->
        <div class="additional-images">
            <a href="espresso.php" style="text-decoration: none; color: black;">
                <div><img src="images/ristretto.jpg" alt="Additional Image 1" class="cat"></div>
                <div class="oswald-font">Espresso</div>
            </a>
            <a href="cappuccino.php" style="text-decoration: none; color: black;">
                <div><img src="images/cara.jpg" alt="Additional Image 2" class="cat"></div>
                <div class="oswald-font">Cappuccino</div>
            </a>
            <a href="latte.php" style="text-decoration: none; color: black;">
                <div><img src="images/hazelnut.jpg" alt="Additional Image 3" class="cat"></div>
                <div class="oswald-font">Latte</div>
            </a>
            <a href="americano.php" style="text-decoration: none; color: black;">
                <div><img src="images/iced.jpg" alt="Additional Image 4" class="cat"></div>
                <div class="oswald-font">Americano</div>
            </a>
        </div>
        
        <!-- Aesthetic introduction -->
        <div class="intro">
            <h1>Welcome to B&J’s Coffee Shop</h1>
            <p>Indulge in the rich aroma and exquisite flavors of our handcrafted coffee blends. Discover a cozy retreat where every sip tells a story and every moment is savored.</p>
        </div>
        
        
        <div id="featured-products-carousel" class="carousel slide" data-ride="carousel" data-bs-ride="carousel" data-bs-interval="1000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="product.php">
                <img src="images/iced.jpg" class="d-block">
            </a>
        </div>
        <div class="carousel-item">
            <a href="product.php">
                <img src="images/black.jpg" class="d-block">
            </a>
        </div>
        <div class="carousel-item">
            <a href="product.php">
                <img src="images/vann.jpg" class="d-block">
            </a>
        </div>
        <div class="carousel-item">
            <a href="product.php">
                <img src="images/cara.jpg" class="d-block">
            </a>
        </div>
        <div class="carousel-item">
            <a href="product.php">
                <img src="images/ristretto.jpg" class="d-block">
            </a>
        </div>
        <div class="carousel-item">
            <a href="product.php">
                <img src="images/mocha.jpg" class="d-block">
            </a>
        </div>
    </div>
</div>

        
    </div>

    <footer style="margin-top: auto; display: flex; justify-content: space-evenly;">
        <a href="#" style="margin-left: 10px;"><img src="images/home.png" alt="Home" style="height: 60px;"
                class="foot"></a>
        <a href="product.php"><img src="images/products.png" alt="Products" style="height: 60px;" class="foot"></a>
        <a href="cart.php"><img src="images/cart.png" alt="Cart" style="height: 60px; width: auto;" class="foot"></a>
        <a href="contact.html" style="margin-right: 10px;"><img src="images/contacts.png" alt="Contacts"
                style="height: 60px;" class="foot"></a>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add event listener to the search input field
document.getElementById('searchInput').addEventListener('input', function() {
  // Get the value entered by the user
  var searchText = this.value.trim();

  // Send AJAX request to fetch search results
  if (searchText !== '') {
      $.ajax({
          type: 'GET',
          url: 'productsSearch.php',
          data: { search: searchText },
          success: function(response) {
              // Update the search results container with search results
              document.getElementById('searchResults').innerHTML = response;
          },
          error: function(xhr, status, error) {
              console.error('Error fetching search results:', error);
          }
      });
  } else {
      // If search input is empty, clear the search results container
      document.getElementById('searchResults').innerHTML = '';
  }
});
    </script>
</body>

</html>
