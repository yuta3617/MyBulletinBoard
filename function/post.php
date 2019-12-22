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
			ORDER BY
				posts.post_id DESC
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

function fetch_user_posts($user_id, $mysqli) {
	$query ="SELECT
				posts.post_id,
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
			WHERE
				posts.post_user_id = $user_id
			ORDER BY
				posts.post_id DESC
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
	if(!isset($_SESSION['user'])) {
		echo "<div class='alert alert-warning'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		ERROR : 投稿にはログインが必要です</div>";
	} else{
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
			echo "<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			ERROR : 投稿に失敗しました</div>";
		} else {
			$_SESSION['message'] = '投稿しました';
			header("Location: " . $_SERVER['PHP_SELF']);
		}
	}
}

function edit_post($post_id, $edit_post, $mysqli) {
	$edit_post = $mysqli->real_escape_string($edit_post);
	
	$query ="UPDATE
				posts
			SET
				posts.post_comment = '$edit_post'
			WHERE
				posts.post_id = $post_id
			";

	$result = $mysqli->query($query);
	echo $query;

	if(!$result) {
		echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		ERROR : 編集に失敗しました</div>";
	} else {
		$_SESSION['message'] = '編集しました';
		header('Location: ../PHP/mypage.php');
	}
}

function delete_post($post_id, $mysqli) {
	$query ="DELETE
			FROM
				posts
			WHERE
				posts.post_id = $post_id
			";
	$result = $mysqli->query($query);

	if(!$result) {
		echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		ERROR : 削除に失敗しました</div>";
	} else {
		$_SESSION['message'] = '削除しました';
		header('Location: ../PHP/mypage.php');
	}
}