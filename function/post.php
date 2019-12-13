<?php

function fetch_posts($mysqli) {
	$query ="SELECT
				posts.post_comment,
				posts.post_date,
				posts.post_user_id,

				users.user_id,
				users.user_name
			FROM
				posts
			LEFT JOIN
				users
			ON
				posts.post_user_id = users.user_id
			";

	$result = $mysqli->query($query);

	if( !$result ) {
		exit;
	} else {
		if( mysqli_num_rows($result) == 0 ){
			return false;
		} else {
			$posts_data = array();
			while ($row = $result->fetch_assoc()) {
				$posts_data[] = $row;
			}
			return $posts_data;
		}
	}
}

function add_post($add_post, $mysqli) {
	$add_post = $mysqli->real_escape_string($add_post);
	$user_id = $_SESSION['user'];

	$query ="INSERT INTO
				posts(
					post_comment,
					post_date,
					post_user_id
				)
			VALUES (
				'$add_post',
				NOW(),
				$user_id
			)";

	$result = $mysqli->query($query);

	if(!$result) {
		echo 'A fatal error occured.';
	} else {
		echo "Your post is just recieved.";
	}
}