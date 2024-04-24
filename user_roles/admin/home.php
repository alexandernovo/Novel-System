<?php
require_once('../../components/header.php');
require_once("../../includes/database.php");
require_once("../../functions/functions.php");
?>

<div class="container d-flex justify-content-between my-4">
    <h1>Releases</h1>
</div>

<div class="container">
    <table class="table table-bordered" id="datatablesSimple">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Synopsis</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Ratings</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query novels with details
            $sql = "SELECT novels.id, novels.title, novels.synopsis, users.users_username, users.users_id AS userid
                    FROM novels
                    INNER JOIN users ON novels.users_id = users.users_id
                    WHERE novels.status = 'PUBLISHED'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $novelId = $row["id"];
                $genres = getGenresForNovel($conn, $novelId);
                $averageRating = getAverageRatingForNovel($conn, $novelId);
            ?>
                <tr>
                    <td><?php echo $novelId; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["synopsis"]; ?></td>
                    <td><?php echo $genres; ?></td>
                    <td><?php echo $row["users_username"]; ?></td>
                    <td><?php echo $averageRating; ?>/5 <i class="fa fa-star text-warning"></i></td>
                    <td>
                        <a href="publish_view.php?id=<?php echo $novelId; ?>" class="btn btn-success"><i class="fa fa-book"></i> Read</a>
                        <a href="author_profile.php?id=<?php echo $row['userid']; ?>" class="btn btn-dark"><i class="fa fa-user"></i> Author Profile</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php require_once('../../components/footer.php'); ?>