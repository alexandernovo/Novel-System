<form method="post" action="search.php">
  <input type="text" name="keyword" placeholder="Enter search keyword">
  <?php
    // Fetch categories from the database
    $categories = fetchCategories();

    // Generate checkboxes dynamically
    foreach ($categories as $category) {
      echo '<input type="checkbox" name="category[]" value="' . $category['id'] . '"> ' . $category['name'] . '<br>';
    }
  ?>
  <input type="submit" value="Search">
</form>


<?php
// Retrieve search keyword
$keyword = $_POST['keyword'];

// Retrieve selected checkboxes
$selectedCategories = $_POST['category'];

// Perform your search query based on the keyword and selected categories
// Customize this code to fit your specific search requirements
$results = performSearch($keyword, $selectedCategories);

// Display search results
foreach ($results as $result) {
  echo $result . '<br>';
}

// Function to perform the search based on the keyword and selected categories
function performSearch($keyword, $selectedCategories) {
  // Customize this function to implement your search logic
  $searchResults = array();

  // Example implementation: Search for items in a database
  $dbConnection = // Create your database connection
  $selectedCategories = implode(', ', $selectedCategories);
  $query = "SELECT * FROM items WHERE item_name LIKE '%$keyword%' AND category_id IN ($selectedCategories)";
  $result = mysqli_query($dbConnection, $query);

  // Fetch the search results
  while ($row = mysqli_fetch_assoc($result)) {
    $searchResults[] = $row['item_name'];
  }

  // Close the database connection
  mysqli_close($dbConnection);

  return $searchResults;
}

// Function to fetch categories from the database
function fetchCategories() {
  // Customize this function to fetch categories from your database
  // Example implementation using MySQLi:
  $dbConnection = // Create your database connection
  $query = "SELECT id, name FROM categories";
  $result = mysqli_query($dbConnection, $query);

  $categories = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
  }

  // Close the database connection
  mysqli_close($dbConnection);

  return $categories;
}
?>
