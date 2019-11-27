<?php
include '../../config/database.php';
include '../html/header.html';
include '../html/signup.html';

include '../../function/sign.php';
?>

<?php
if ( $_POST ) {
	if (
		!empty( $_POST['user_name']) &&
		!empty( $_POST['user_email']) &&
		!empty( $_POST['user_password']) &&
		!empty( $_POST['user_pass_check'])
	 ) {
		if ( $_POST['user_password'] === $_POST['user_pass_check']) {
			$user_name = $_POST['user_name'];
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];

			sign_up($user_name, $user_email, $user_password, $mysqli);
		} else {
			echo "パスワードが一致しません";
		}
	} else {
		echo "エラーがあります";
	}
}
?>

<?php
include '../html/footer.html';