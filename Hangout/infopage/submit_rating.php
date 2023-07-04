<?php

//submit_rating.php

require("../../connection/connection.php");

session_start();
$place_id = $_SESSION['place_id'];
$user_id = $_SESSION['user_id'];

$connect = new PDO("mysql:host=localhost;dbname=ducks_row", "root", "Abdo1234");

$select = "select username from users where user_id = $user_id ";
$resulut5 = $con->query($select);

	if($resulut5->num_rows > 0){
		while($row = $resulut5->fetch_assoc()){
			$user_name = $row['username'];
		}
	}

if(isset($_POST["rating_data"]))
{

	$data = array(
		':user_name'		=>	$user_name,
		':place_id'		=>	$place_id,
		':user_id'		=>	$user_id,
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time()
	);


	// // NEW
	// $select = "select username from users where user_id = $user_id ";
	// $resulut5 = $con->query($select);

	// 	if($resulut5->num_rows > 0){
	// 		while($row = $resulut5->fetch_assoc()){
	// 			$user_name = $row['username'];
	// 		}
	// 	}


	$query = "
	INSERT INTO review_table 
	(user_name, user_rating, user_review, datetime, place_id, user_id) 
	VALUES (:user_name, :user_rating, :user_review, :datetime, :place_id, :user_id)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

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
	SELECT * FROM review_table 
	WHERE place_id='$place_id' ORDER BY review_id DESC
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	date('l jS, F Y h:i:s A', $row["datetime"])
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