<!-- <?php

include("includes/database.php");
if (isset($_POST['input'])) {
    
    $input = $_POST['input'];

    $query = "SELECT * FROM novels WHERE title LIKE '{$input}%' OR title LIKE '{$input}%'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){?>

        <table class="table table-bordered">
            <thead>
                <tr> 
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Synopsis</th>
                    <th>Genre</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $subtitle = $row['subtitle'];
                    $synopsis = $row['synopsis'];
                    $genre = $row['genre'];
                
            ?>
            
            <tr>
                <td><?php echo $title;?></td>
                <td><?php echo $subtitle;?></td>
                <td><?php echo $synopsis;?></td>
                <td><?php echo $genre;?></td>
                <td><?php echo $status;?></td>
                <td><?php echo $action;?></td>
            </tr>
            <?php
        }
    ?>
            </tbody>
        </table>
    <?php
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No Data Found</h6>";
    }
}

?> -->

