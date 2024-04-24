<?php
require_once('../functions/config.php');
// Assume you have already established a database connection ($conn)
// Include proper error handling and security measures in your actual code

// Input data
$search = isset($_POST['search_form']) ? $_POST['search_form'] : '';
$author = isset($_POST['author']) ? $_POST['author'] : '';
$order_by_fig = isset($_POST['order_by_fig']) ? $_POST['order_by_fig'] : '';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : '';
$genres = isset($_POST['genre']) ? $_POST['genre'] : array();

// Base query
$query = "SELECT n.*, u.users_username, u.users_email,p.firstname,p.lastname
          FROM novels n
          LEFT JOIN genre g ON n.id=g.novel_id
          LEFT JOIN users u ON n.users_id = u.users_id
          LEFT JOIN profiles as p ON u.users_id=p.users_id
          WHERE n.status = 'PUBLISHED'";

// Apply search conditions
// Apply search conditions
if (!empty($search)) {
    $query .= " AND (n.title LIKE '%$search%' OR 
                    n.id IN (SELECT novel_id FROM genre WHERE genre_name LIKE '%$search%'))";
}

// Apply author condition
if (!empty($author)) {
    $query .= " AND p.firstname LIKE '%$author%' OR p.lastname LIKE '%$author%'";
}

// Apply genre conditions using WHERE IN
if (!empty($genres)) {
    $genre_ids = implode(",", $genres);
    $query .= " AND n.id IN (
                SELECT novel_id
                FROM genre
                WHERE genre_id IN ($genre_ids)
              )";
}

// Apply order by
if (!empty($order_by_fig) && !empty($order_by)) {
    $query .= " ORDER BY";
    if ($order_by_fig === 'alphabetical') {
        $query .= " n.title $order_by";
    } elseif ($order_by_fig === 'release') {
        $query .= " n.novel_added $order_by";
    }
}

// Execute the query
$result = mysqli_query($conn, $query);

// Handle query result
if ($result) {
    $novelData = array(); // To store unique novels by ID

    // Fetch and process the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $novelId = $row['id'];

        // If the novel ID is not already in the array, add it
        if (!isset($novelData[$novelId])) {
            $novelData[$novelId] = $row;
        }
    }

    // Process the unique novels
    foreach ($novelData as $novel) {
        // Get the genres for the current novel
        $novelId = $novel['id'];
        $genreQuery = "SELECT g.genre_name FROM genre g
                       WHERE g.novel_id = $novelId";
        $genreResult = mysqli_query($conn, $genreQuery);
        $genres = array();
        while ($genreRow = mysqli_fetch_assoc($genreResult)) {
            $genres[] = $genreRow['genre_name'];
        }
        $chapter_countings = "SELECT count(chapter_id) AS chapterCount FROM chapters WHERE novel_id='$novelId'";
        $chapter_result = mysqli_query($conn, $chapter_countings);
        $chapter_count = mysqli_fetch_assoc($chapter_result);
        // Output the novel details
?>
        <div class="col-6 card-size g-0">
            <h3 class="title-d">Title: <?= $novel['title'] ?> ( <?= $novel['subtitle'] ?>)</h3>
            <div class="card-up shadow col-4">
                <img src="<?= $novel['novel_image'] ?> " class="picture_novel">
            </div>
            <div class="card novel-card">
                <div class="offset-5 col-7 mt-3">
                    <p class="text-white m-0">
                        Rating:
                        <?php
                        $novel_id = $novel['id'];
                        $avg_ratings = $conn->query("SELECT ROUND(AVG(user_rating), 1) AS average, COUNT(user_rating) AS count  FROM ratings WHERE novel_id = '$novel_id'");
                        $rating_row = $avg_ratings->fetch_assoc();
                        $average_rating = $rating_row['average'];
                        ?>

                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $starClass = 'fas fa-star text-secondary';

                            if ($i <= floor($average_rating)) {
                                $starClass = 'fas fa-star text-warning';
                            } elseif ($i == floor($average_rating) + 1 && ($average_rating - floor($average_rating)) >= 0.5) {
                                $starClass = 'fas fa-star-half-alt text-warning';
                            }
                        ?>
                            <i class="<?php echo $starClass ?> mr-1 main_star mb-2"></i>
                        <?php
                        }
                        ?>
                    </p>

                    <h4 class="details mb-2">Author: <?= $novel['firstname'] . ' ' . $novel['lastname'] ?></h4>
                    <h4 class="details mb-2">Genre: <?= implode(', ', $genres) ?></h4>
                    <h4 class="details mb-2">Chapters: <?= $chapter_count['chapterCount'] ?></h4>
                    <a href="includes/history.php?novel_id=<?= $novel['id'] ?>" class="btn btn-primary button-teal btn-sm px-4"><i class="fa fa-book"></i> Read</a>
                </div>
            </div>
        </div>
<?php
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle query error
    echo "Query Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>