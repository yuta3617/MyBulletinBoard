<?php
ob_start();
session_start();
include '../../config/database.php';
include '../html/header.html';
include '../html/signin.html';

include '../../function/sign.php';
?>

<?php
if ( $_POST ) {
	if (
		!empty( $_POST['user_email']) &&
		!empty( $_POST['user_password'])
	 ) {
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];

		sign_in($user_email, $user_password, $mysqli);
	} else {
		echo "<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			ERROR : ログインに失敗しました。再試行してください。</div>";
	}
}
 ?>

<?php
include '../html/footer.html';