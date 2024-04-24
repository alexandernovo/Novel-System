<?php require_once('header3.php');
$novel = firstJoin('novels', [['users', 'users.users_id', 'novels.users_id'], ['profiles', 'profiles.users_id', 'users.users_id']], ['id' => $_GET['id']]);
?>

<div class="container text-white">
    <div class="d-flex justify-content-between my-4">
        <h3 class="text-white"><i class="fa fa-book"></i> Novel Profile</h3>
        <div>
            <a href="index.php" class="btn btn-primary button-teal px-4 btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row mx-auto mb-2" style="height:300px; overflow-y:hidden">
        <div class="col-3 g-0" style="height:100%">
            <img src="<?= $novel['novel_image'] ?>" class="picture_novel rounded">
        </div>
        <div class="col-9" style="overflow-y: scroll;height:100%">
            <h4 class="title-review">Title</h4>
            <p><?php echo $novel["title"]; ?></p>
            <h4 class="title-review">Subtitle</h4>
            <p><?php echo $novel["subtitle"]; ?></p>
            <h4 class="title-review">Author</h4>
            <p><?php echo $novel["firstname"] . ' ' . $novel["lastname"]; ?></p>
            <h4 class="title-review">Published By:</h4>
            <p><?php echo $novel["users_username"]; ?></p>
            <h4 class="title-review">Genre</h4>
            <p><?php
                $genres = find_where('genre',  ['novel_id' => $_GET['id']]);
                $genreCount = count($genres);
                foreach ($genres as $index => $genre) {
                    echo $genre['genre_name'];
                    if ($index < $genreCount - 1) {
                        echo ', ';
                    }
                }
                ?></p>
            <h4>Synopsis</h4>
            <p class="synopsis"><?php echo $novel["synopsis"]; ?></p>
        </div>
    </div>
    <div class="row mx-auto mb-3 g-0">
        <div class="col-3">
            <div class="row mx-auto">
                <div class="col-6">
                    <div class="row mx-auto">
                        <?php $first = first('chapters', ['novel_id' => $_GET['id']]); ?>
                        <a href="<?php echo $first ? 'read-novel.php?chapter_id=' . $first['chapter_id'] . '&novel_id=' . $_GET['id'] : '#' ?>" class="btn btn-primary btn-sm button-teal"><i class="fa fa-book"></i> Read First</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row mx-auto">
                        <?php $last = last('chapters', ['novel_id' => $_GET['id']], 'chapter_number'); ?>
                        <a href="<?php echo $last ? 'read-novel.php?chapter_id=' . $last['chapter_id'] . '&novel_id=' . $_GET['id'] : '#' ?>" class="btn btn-primary btn-sm button-teal"><i class="fa fa-book"></i> Read Last</a>
                    </div>
                </div>
            </div>
            <div class="row mx-auto mt-2">
                <div class="col-12">
                    <div class="row mx-auto">
                        <a href="profile_donate.php?users_id=<?= $novel['users_id'] ?>&novel_id=<?= $novel['id'] ?>" class="btn btn-primary btn-sm px-4"><i class="fa fa-user"></i> Authors Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-auto mb-5 mt-5">
        <h4 class=""><i class="fa fa-file"></i> Chapters</h4>
        <div class="row mx-auto mt-3">
            <table class="table table-custom" id="tables">
                <thead>
                    <tr>
                        <th>Chapter</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $chpter = find_where('chapters', ['novel_id' => $_GET['id']]); ?>
                    <?php foreach ($chpter as $chpters) : ?>
                        <tr>
                            <td>Chapter<?= $chpters['chapter_number'] ?></td>
                            <td><?= $chpters['title'] ?></td>
                            <td><?php echo date('M d, Y', strtotime($chpters['chapter_date_added'])) ?></td>
                            <td><a href="read-novel.php?novel_id=<?php echo $_GET['id'] ?>&chapter_id=<?= $chpters['chapter_id'] ?>" class="btn btn-primary btn-sm px-4 button-teal"><i class="fa fa-book"></i> Read</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" card reviews mb-3">
        <div class="card-header text-white">
            <h4>
                Ratings and Reviews
            </h4>
        </div>

        <div class="card-body text-white">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <h1 class="text-warning mt-4 mb-4">
                        <?php
                        $id = $_GET['id'];
                        $avg_ratings = $conn->query("SELECT ROUND(AVG(user_rating), 1) AS average, COUNT(user_rating) AS count  FROM ratings WHERE novel_id = '$id'");
                        while ($rating_row = $avg_ratings->fetch_assoc()) {
                            $average_rating = $rating_row['average'];
                        ?>
                            <b><span id="average_rating"><?php echo $average_rating ? $average_rating : 0 ?></span> / 5</b>
                    </h1>

                    <div class="mb-3">
                        <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $starClass = ($i <= floor($average_rating)) ? 'fas fa-star text-warning' : 'fas fa-star star-light';

                                // If the decimal part is greater than or equal to 0.5, light up the next star partially
                                if ($i == floor($average_rating) + 1 && ($average_rating - floor($average_rating)) >= 0.5) {
                                    $starClass = 'fas fa-star-half-alt text-warning';
                                }
                        ?>
                            <i class="<?php echo $starClass ?> mr-1 main_star"></i>
                        <?php
                            }
                        ?>
                    </div>

                    <h4><span id="total_review"><?php echo $rating_row['count'] ?></span> Review<?php echo $rating_row['count'] != 1 ? "s" : "" ?></h4>
                <?php
                        }
                ?>
                </div>


                <div class="col-sm-4">
                    <?php
                    $starRatings = [5, 4, 3, 2, 1]; // Array of star ratings
                    foreach ($starRatings as $rating) {
                        $ratings = $conn->query("SELECT COUNT(user_rating) AS count FROM ratings WHERE user_rating = $rating AND novel_id = '$id'");
                        $rate = $ratings->fetch_assoc();
                        $count = $rate['count'];

                        // Calculate the progress bar percentage
                        $total_ratings = $conn->query("SELECT COUNT(*) AS total_count FROM ratings WHERE novel_id = '$id'");
                        $total_data = $total_ratings->fetch_assoc();
                        $totalReviews = $total_data['total_count'];
                        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                    ?>
                        <p>
                        <div class="progress-label-left"><b><?php echo $rating ?></b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span><?php echo $count ?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage ?>%;"></div>
                        </div>
                        </p>
                    <?php
                    }
                    ?>
                </div>

                <div class="col-sm-4 text-center">
                    <h4 class="mt-4 mb-3">Write Review Here</h4>
                    <?php if (!empty($_SESSION['userid'])) {
                        $review_edit = first('ratings', ['users_id' => $_SESSION['userid'], 'novel_id' => $_GET['id']]);
                    ?>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary button-teal btn-sm px-4" data-bs-toggle="modal" data-bs-target="#ratings"><i class="fa fa-edit"></i> <?php echo $review_edit ? 'Edit Your Review' : 'Review' ?> </button>
                    <?php } else { ?>
                        <p style="font-size:14px">Please Login to Write a Review </p>
                        <button type="button" class="btn btn-primary btn-sm button-teal px-4" data-bs-toggle="modal" data-bs-target="#login"><i class="fa fa-sign-in"></i> Login</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-auto mb-5 mt-4 p-4 rounded reviews">
        <h4 class=""><i class="fa fa-comments-o"></i> Feedbacks</h4>
        <?php
        $novel_id = $_GET['id'];
        $query = "SELECT * 
              FROM users 
              INNER JOIN ratings ON users.users_id = ratings.users_id 
              LEFT JOIN profiles ON profiles.users_id = users.users_id 
              WHERE ratings.novel_id = '$novel_id'";

        $result = mysqli_query($conn, $query);

        $feedbacks = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $feedbacks[] = $row;
        }
        ?>
        <div class="px-4 mt-2 py-2" style="max-height:500px; overflow-x:hidden; overflow-y:auto">
            <?php foreach ($feedbacks as $feedback) : ?>
                <div class="row mx-auto mb-3">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo !empty($feedback['profile_picture']) ? $feedback['profile_picture'] : 'images/placeholder_user.jpg' ?>" class="rounded-circle" style="height: 30px; width:30px;" />
                        <p class="m-0 ms-1"><?= $feedback['users_username'] . ': ' ?></p>
                        <?php if (!isset($_SESSION) && $_SESSION['userid'] == $feedback['users_id']) { ?>
                            <p class="m-0 ms-1" style="font-size: 13px;">(You)</p>
                        <?php } ?>
                        <p class="m-0 ms-1 ">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php $star = ($i <= $feedback['user_rating']) ? 'fas fa-star text-warning ' : 'fas fa-star text-secondary '; ?>
                                <i class="<?php echo $star; ?>" id="<?php echo $i; ?>" data-rating="<?php echo $i; ?>"></i>
                            <?php endfor; ?>
                        </p>
                        <?php if (!isset($_SESSION) && $_SESSION['userid'] == $feedback['users_id']) { ?>
                            <p class="m-0 ms-2 cursor-pointer" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#ratings"><i class="fa fa-edit"></i> edit</p>
                        <?php } ?>
                    </div>
                    <p class="" style="margin-bottom:0;margin-left: 33px; font-size:14px"><?= $feedback['user_rev'] ?></p>
                </div>
            <?php endforeach; ?>

            <?php if (empty($feedbacks)) : ?>
                <p class="text-secondary" style="margin-bottom:0; margin-left:14px; font-size:14px">No feedback</p>
            <?php endif; ?>

        </div>

    </div>
    <div class="modal fade " id="ratings" style="top:10%" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content reviews border">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"><i class="fas fa-star text-warning"></i> Rate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="d-none text-center text-warning m-0 mb-1" id="warning_star" style="font-size:14px">Please rate a star!</p>
                    <?php if ($review_edit) { ?>
                        <script>
                            var rating_data = <?php echo $review_edit['user_rating'] ?>;
                        </script>
                        <h4 class="text-center mt-2 mb-4">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php $starClass = ($i <= $review_edit['user_rating']) ? 'fas fa-star text-warning submit_star' : 'fas fa-star text-secondary submit_star'; ?>
                                <i class="<?php echo $starClass; ?>" id="submit_star_<?php echo $i; ?>" data-rating="<?php echo $i; ?>"></i>
                            <?php endfor; ?>
                        </h4>
                    <?php } else { ?>
                        <script>
                            var rating_data = 0;
                        </script>
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star text-secondary submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star text-secondary submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star text-secondary submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star text-secondary submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star text-secondary submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                    <?php } ?>

                    <div class="form-group mt-3">
                        <?php if (!empty($_SESSION)) {
                        ?>
                            <textarea name="user_review" id="user_review" novel-id="<?php echo $_GET['id'] ?>" user-id="<?php echo $_SESSION['userid'] ?>" style="height:130px" class="form-control search-forms" placeholder="Type Review Here"><?php echo $review_edit ? $review_edit['user_rev'] : '' ?></textarea>
                        <?php } else { ?>
                            <textarea name="user_review" id="user_review" novel-id="<?php echo $_GET['id'] ?>" user-id="<?php echo $_SESSION['userid'] ?>" style="height:130px" class="form-control search-forms" placeholder="Type Review Here"></textarea>
                        <?php } ?>

                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary px-4 btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="button" class="btn btn-primary button-teal px-4 btn-sm" id="save_reviews"><i class="fa fa-save"></i> Submit Review</button>
                    </div>
                </div>
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
                            <input type="hidden" id="link" value="publish_view.php?id=<?php echo $_GET['id'] ?>">
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