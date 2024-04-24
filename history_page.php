<?php require_once('header3.php'); ?>
<div class="col-11 mx-auto my-4 mangga_read">
    <h3 class="text-white"><i class="fa fa-history "></i> Last Read</h3>
    <div class="row mx-auto mt-3">
        <?php $history = joinTable('novels', [['history', 'history.novel_id', 'novels.id'], ['profiles', 'profiles.users_id', 'history.users_id']], ['history.users_id' => $_SESSION['userid']]); ?>
        <?php foreach ($history as $histo) :
            $novelId = $histo['id'];
            $genreQuery = "SELECT genre_name FROM genre 
            WHERE novel_id = $novelId";
            $genreResult = mysqli_query($conn, $genreQuery);
            $genres = array();
            while ($genreRow = mysqli_fetch_assoc($genreResult)) {
                $genres[] = $genreRow['genre_name'];
            }
            $chapter_countings = "SELECT count(chapter_id) AS chapterCount FROM chapters WHERE novel_id='$novelId'";
            $chapter_result = mysqli_query($conn, $chapter_countings);
            $chapter_count = mysqli_fetch_assoc($chapter_result);
        ?>
            <div class="col-6 card-size g-0">
                <h3 class="title-d">Title: <?= $histo['title'] ?> (<?= $histo['subtitle'] ?>)</h3>

                <div class="card-up shadow col-4">
                    <img src="<?= $histo['novel_image'] ?> " class="picture_novel">
                </div>
                <div class="card novel-card">
                    <div class="offset-5 col-7 mt-3">
                        <p class="text-white m-0">
                            Rating:
                            <?php
                            $novel_id = $histo['id'];
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

                        <h4 class="details mb-2">Author: <?= $histo['firstname'] . ' ' . $histo['lastname'] ?></h4>
                        <h4 class="details mb-2">Genre: <?= implode(', ', $genres) ?></h4>
                        <h4 class="details mb-2">Chapters: <?= $chapter_count['chapterCount'] ?></h4>
                        <a href="includes/history.php?novel_id=<?= $histo['id'] ?>" class="btn btn-primary button-teal btn-sm px-4"><i class="fa fa-book"></i> Read</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<?php require_once('footer.php'); ?>