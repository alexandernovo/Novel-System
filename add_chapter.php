<?php
require("includes/database.php");
include_once 'header.php';
$last_chapter = last('chapters', ['novel_id' => $_GET['id']], 'chapter_number');
?>

<?php
if (isset($_GET['id'])) {
    $novel_id = $_GET['id'];
?>
    <div class="container py-3">
        <h2 class="h2 text-bold"><i class="fa fa-book mb-2 "></i>Adding Chapters</h2>
        <form method="POST" action="includes/create_chap.php">
            <input type="hidden" name="novel_id" value="<?php echo $_GET['id'] ?>">
            <div id="inputsContainer">
                <div class="input-container card container my-2 p-4 shadow">
                    <label>Chapter</label>
                    <input type="number" value="<?php echo !empty($last_chapter) && $last_chapter['chapter_number'] ? $last_chapter['chapter_number'] + 1 : 1; ?>" name="chapter_number[]" class="form-control d-flex my-2" placeholder="Chapter Number">
                    <label>Title</label>
                    <input name="title[]" class="form-control d-flex my-2" placeholder="Title">
                    <label>Content</label>
                    <textarea class="form-control d-flex my-2" rows="10" name="content[]" placeholder="Content"></textarea>
                </div>
                <!-- Inputs will be dynamically added here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm px-4 me-1 " onclick="addInput()"><i class="fa fa-plus"></i> Add Chapter</button>

                <button type="submit" class="btn btn-success  btn-sm px-4" name="create"><i class="fa fa-check"></i> Save Chapters</button>
            </div>
        </form>
    </div>

    <script>
        let inputCount = 0;
        let lastChapterNumber = <?php echo !empty($last_chapter) && $last_chapter['chapter_number'] ? $last_chapter['chapter_number'] + 1 : 1; ?>;

        function addInput() {
            inputCount++;
            lastChapterNumber++;

            const inputContainer = document.createElement('div');
            inputContainer.className = 'input-container card container my-2 p-4 shadow';

            const label1 = document.createElement('label');
            label1.textContent = "Chapter";
            const label2 = document.createElement('label');
            label2.textContent = "Title";
            const label3 = document.createElement('label');
            label3.textContent = "Content";


            const chapterNumber = document.createElement('input');
            chapterNumber.className = "form-control d-flex my-2";
            chapterNumber.type = 'number';
            chapterNumber.value = lastChapterNumber;
            chapterNumber.name = 'chapter_number[]';
            chapterNumber.placeholder = "Chapter Number";

            const title = document.createElement('input');
            title.className = "form-control d-flex my-2";
            title.type = 'text';
            title.name = 'title[]';
            title.placeholder = "Title";

            const content = document.createElement('textarea');
            content.className = "form-control d-flex my-2";
            content.name = 'content[]';
            content.rows = 10;
            content.placeholder = "Content";

            const deleteButton = document.createElement('span');
            deleteButton.className = 'delete-button modal-footer cursor-pointer';
            deleteButton.innerHTML = '&#10060;';
            deleteButton.onclick = function() {
                inputContainer.remove();
            };

            inputContainer.appendChild(deleteButton);
            inputContainer.appendChild(label1);
            inputContainer.appendChild(chapterNumber);
            inputContainer.appendChild(label2);
            inputContainer.appendChild(title);
            inputContainer.appendChild(label3);
            inputContainer.appendChild(content);

            document.getElementById('inputsContainer').appendChild(inputContainer);
        }
    </script>


<?php
}
require_once('footer.php')
?>