<?php

function sign_up($user_name,$user_email,$user_password,$mysqli) {
    $user_name = $mysqli->real_escape_string($user_name);
    $user_email = $mysqli->real_escape_string($user_email);
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    $query="INSERT INTO
                users(
                    user_name,
                    user_email,
                    user_password
                    ) 
                VALUES(
                    '$user_name',
                    '$user_email',
                    '$user_password'
                    )
        ";
    $result = $mysqli->query($query);
    $_SESSION['message'] = 'アカウントを新規作成しました';
    header('Location: ../PHP/index.php');
}

function sign_in($user_email, $user_password, $mysqli) {
    $user_email = $mysqli->real_escape_string($user_email);
    $user_password = $mysqli->real_escape_string($user_password);
    
    $query = "SELECT
					user_id,
					user_email,
					user_password
				FROM
					users
				WHERE
                    user_email = '$user_email'
        ";
    
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
		$db_hashed_pwd = $row['user_password'];
		$user_id = $row['user_id'];
    }
    
    if (password_verify($user_password, $db_hashed_pwd)) {
        $_SESSION['user'] = $user_id;
        $_SESSION['message'] = 'ログインしました';
		header('Location: ../PHP/index.php');
	} else {
		echo "<div class='alert alert-warning'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        ERROR : ログインに失敗しました</div>";
	}
}

function sign_out() {
    $_SESSION = array();
    $_SESSION['message'] = 'ログアウトしました';
    header('Location: ../PHP/index.php');
}