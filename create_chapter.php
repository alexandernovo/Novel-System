<?php
include_once 'header.php';
$id = $_GET['id']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/createstyle.css">
    <title>Create Novel</title>
    <script>
        // Counter for tracking the number of chapters
        let chapterCounter = 0;

        // Event listener for the "Add Chapter" button
        document.getElementById('addChapterBtn').addEventListener('click', function() {
            chapterCounter++;

            // Create a new chapter container
            const chapterContainer = document.createElement('div');
            chapterContainer.className = 'chapter';

            // Create a label and input field for the chapter title
            const titleLabel = document.createElement('label');
            titleLabel.textContent = 'Chapter Title:';
            const titleInput = document.createElement('input');
            titleInput.type = 'text';
            titleInput.name = 'chapter_title[]'; // Use array syntax for input name
            chapterContainer.appendChild(titleLabel);
            chapterContainer.appendChild(titleInput);

            // Create a label and textarea for the chapter content (rich text editor)
            const contentLabel = document.createElement('label');
            contentLabel.textContent = 'Chapter Content:';
            const contentTextarea = document.createElement('textarea');
            contentTextarea.name = 'chapter_content[]'; // Use array syntax for input name
            chapterContainer.appendChild(contentLabel);
            chapterContainer.appendChild(contentTextarea);

            // Append the chapter container to the chapters container
            document.getElementById('chaptersContainer').appendChild(chapterContainer);

            // Update the chapter count input field
            document.getElementById('chapterCount').value = chapterCounter;
        });
    </script>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Create a New Novel</h1>
            <div>
                <a href="library.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <!-- HTML structure for the rich text editor and chapters -->
        <form method="POST" action="save_novel.php">
            <!-- Rich Text Editor -->
            <textarea name="content" id="editor"></textarea>

            <!-- Button to add chapters dynamically -->
            <button type="button" id="addChapterBtn">Add Chapter</button>

            <!-- Container to hold the dynamically added chapters -->
            <div id="chaptersContainer"></div>

            <!-- Hidden input field to store the number of chapters -->
            <input type="hidden" name="chapter_count" id="chapterCount" value="0">

            <!-- Submit button to save the novel -->
            <button type="submit">Save Novel</button>
        </form>
    </div>
    <?php require_once('footer.php') ?>