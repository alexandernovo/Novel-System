<?php
require("includes/database.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titleInputs = $_POST['title'];
    $contentInputs = $_POST['content'];
    $novel_id = $_GET['id'];
    $chapter_date_added = date("Y-m-d");

    // Prepare the SQL statement
    $sql = "INSERT INTO chapters ( title, content, novel_id, chapter_date_added) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute for each input
    for ($i = 0; $i < count($titleInputs); $i++) {
        $title = $titleInputs[$i];
        $content = $contentInputs[$i];

        $stmt->bind_param("ssis", $title, $content, $novel_id, $chapter_date_added);
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect to a success page or do further processing

    exit;
}
?>
