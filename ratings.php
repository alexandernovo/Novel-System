<?php

require ('includes/database.php');

if(isset($_POST["rating_data"]))
{
 
	
		$user_uid	=	$_POST["user_name"];
		$user_rating=	$_POST["rating_data"];
		$user_rev	=	$_POST["user_review"];
		$novel_id = $_POST["novel_id"];
		$date		=	date("Y-m-d");

	$query = "
	INSERT INTO ratings 
	(user_uid, user_rating, user_rev, novel_id, date) 
	VALUES ('$user_uid', '$user_rating', '$user_rev', '$novel_id','$date')
	";
    
	$statement = $conn->prepare($query);

	$statement->execute();

	echo "Your Review & Rating Successfully Submitted";
	

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM ratings 
	ORDER BY review_id DESC
	";

	$result = $conn->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'user_uid'		=>	$row["user_uid"],
			'user_rev'	=>	$row["user_rev"],
			'rating'		=>	$row["user_rating"],
			'date'		=>	date('l jS, F Y h:i:s A', $row["date"])
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>