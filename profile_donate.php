<?php require_once('header3.php');
//  $donationLink = $users['donation_link'];
//  $pattern = '/(?:https?:\/\/)?(?:www\.)?([^\/]+)/i';

//  if (preg_match($pattern, $donationLink, $matches)) {
//      echo '<a href="' . $donationLink . '" target="_blank" rel="noopener noreferrer">' . $matches[1] . '</a>';
//  } else {
//      echo $donationLink; // Display the original link if parsing fails
//  }
$novel = first('novels', ['id' => $_GET['novel_id']]);
$users = firstJoin('users', [['profiles', 'profiles.users_id', 'users.users_id']], ['users.users_id' => $_GET['users_id']]);
?>
<div class="container my-4 text-white">
    <h2 class="mb-3 ms-3"><i class="fa fa-user"></i>
        Profile
    </h2>

    <div class="d-flex px-3 pb-3 align-items-center">
        <div class="rounded-circle overflow-hidden" style="height:250px; width:250px;">
            <img class="picture_novel" src="<?php echo !empty($users['profile_picture']) ? $users['profile_picture'] : 'images/placeholder.jpg' ?>" alt="Preview Image">
        </div>
        <div class="ms-3">
            <p class="profile_class m-0 mb-4"><i class="fa fa-user"></i> Username: <?= $users['users_username'] ?></p>
            <p class="profile_class m-0 mb-4"><i class="fa fa-pen"></i> Author: <?= $users['firstname'] . ' ' . $users['lastname'] ?></p>
            <p class="profile_class m-0 mb-4"><i class="fa fa-book"></i> Novel you Read: <?= $novel['title'] ?></p>
            <a href="donation_reader.php?users_id=<?php echo $_GET['users_id'] ?>&novel_id=<?php echo $_GET['novel_id'] ?>" class="btn btn-primary btn-sm button-teal px-4"><i class="fas fa-donate"></i> Donate</a>
        </div>
    </div>
    <div class="row mx-auto mt-3">
        <h2 class="mb-3"><i class="fa fa-info-circle"></i>
            About
        </h2>
        <div class="px-4">
            <p class="profile_class m-0 mb-3"><?= $users['profiles_introtitle'] ?></p>
            <p class="profile_class m-0 mb-3"><?= $users['profiles_about'] ?></p>
            <p class="profile_class m-0 mb-3"><?= $users['profiles_introtext'] ?></p>
        </div>
    </div>
    <hr>
    <div class="row mx-auto mt-1 p-3">
        <h2><i class="fa fa-book"></i> Novels Created:</h2>
        <div class="row mx-auto ">
            <?php $history = joinTable('novels', [['users', 'users.users_id', 'novels.users_id'], ['profiles', 'profiles.users_id', 'users.users_id']], ['users.users_id' => $_GET['users_id'], 'novels.status' => 'PUBLISHED']); ?>
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
</div>


<div class="modal fade " id="login" style="top:10%" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content reviews border">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"><i class="fa fa-sign-in"></i> Login</h1>
            </div>
            <form method="post" id="login_form">
                <div class="modal-body p-3">
                    <div class="form-group mb-2">
                        <label class="text-white">Username</label>
                        <input type="hidden" id="link" value="profile_donate.php?users_id=<?php echo $_GET['users_id'] ?>&novel_id=<?php echo $_GET['novel_id'] ?>">
                        <input class="form-control search-forms" required type="text" name="username" id='username'>
                        <p class="text-warning m-0 d-none" id="error_username" style="font-size:13px"></p>
                    </div>
                    <div class=" form-group">
                        <label class="text-white">Password</label>
                        <input class="form-control search-forms" required type="password" name="password" id="password">
                        <p class="text-warning m-0 d-none" id="error_password" style="font-size:13px"></p>
                    </div>
                </div>
                <div class=" modal-footer mt-3">
                    <button type="button" class="btn btn-secondary px-4 btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary button-teal px-4 btn-sm" id="login"><i class="fa fa-sign-in"></i> Login</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>