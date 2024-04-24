<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/effects.js"></script>
<script src="js/genre.js"></script>
<script src="js/audit_trail.js"></script>
<script>
    new DataTable('#tables');
</script>
<script>
    function togglePopup() {
        document.getElementById("popup-1").classList.toggle("active");
        const selectBtn = document.querySelector(".select-btn"),
            items = document.querySelectorAll(".item");

        selectBtn.addEventListener("click", () => {
            selectBtn.classList.toggle("open");
        });

        items.forEach(item => {
            item.addEventListener("click", () => {
                item.classList.toggle("checked");

                let checked = document.querySelectorAll(".checked"),
                    btnText = document.querySelector(".btn-text");

                if (checked && checked.length > 0) {
                    btnText.innerText = `${checked.length} Selected`;
                } else {
                    btnText.innerText = "Select Language";
                }
            });
        })
    }
</script>
<!-- <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
    })
</script> -->
<script>
    // Counter for tracking the number of chapters
    let chapterCounter = 0;

    // Event listener for the "Add Chapter" button
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
<script>
    const txHeight = 16;
    const txList = document.getElementsByClassName("chapters");

    for (let i = 0; i < txList.length; i++) {
        const tx = txList[i];
        if (tx.value == '') {
            tx.setAttribute("style", "height:" + txHeight + "px;overflow-y:hidden;");
        } else {
            tx.setAttribute("style", "height:" + (tx.scrollHeight) + "px;overflow-y:hidden;");
        }
        tx.addEventListener("input", OnInput, false);
    }

    console.log('hey');

    function OnInput(e) {
        this.style.height = 0;
        this.style.height = (this.scrollHeight) + "px";
    }
</script>

<?php if ($flash = getFlash('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: "<?php echo $flash; ?>",
            showConfirmButton: true,
        });
    </script>
<?php endif; ?>

<?php if ($flash = getFlash('failed')) : ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: "<?php echo $flash; ?>",
            showConfirmButton: true,
        });
    </script>
<?php endif; ?>

</body>

</html>