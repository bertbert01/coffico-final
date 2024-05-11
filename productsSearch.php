<?php
// Include your database connection file here
include 'db_connection.php';

// Get the search term from the AJAX request
$searchText = $_GET['search'];

// Query to fetch products matching the search term from the database
$sql = "SELECT * FROM products WHERE name LIKE '%$searchText%'";
$result = $conn->query($sql);

// Check if the query executed successfully and returned a result
if ($result && $result->num_rows > 0) {
    // Initialize an empty string to store the HTML for search results
    $searchResults = '';
    $href = '#';

    // Check the category of the row and set the href accordingly
    

    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        switch ($row['category']) {
            case 1:
                $href = 'espresso.php';
                break;
            case 2:
                $href = 'cappuccino.php';
                break;
            case 3:
                $href = 'latte.php';
                break;
            case 4:
                $href = 'americano.php';
                break;
            // Add more cases for other categories if needed
            default:
                // Handle default case (if category doesn't match any known category)
                break;
        }
        // Build HTML for each search result
        $searchResults .= '<li class="dropdown-item">';
        $searchResults .= '<a href="' . $href . '" style="cursor: pointer; text-decoration: none; color: inherit;" data-toggle="modal" data-target="#productModal' . $row['id'] . '">';
        $searchResults .= '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" style="width: 50px;">';
        $searchResults .= '<span class="search-name">' . $row['name'] . '</span>';
        $searchResults .= '</a>';
        $searchResults .= '</li>';
    }
    
    // Output the search results
    echo $searchResults;
} else {
    // If no matching products found, display a message
    echo '<div class="search-no-results">No products found.</div>';
}
?>
