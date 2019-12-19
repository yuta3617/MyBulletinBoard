<?php
include '../../config/database.php';
include '../html/header.html';
include '../html/signin.html';

include '../../function/sign.php';
ob_start();
session_start();
?>

<?php
if ( $_POST ) {
	if (
		!empty( $_POST['user_name']) &&
		!empty( $_POST['user_password'])
	 ) {
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];

		sign_in($user_name, $user_password, $mysqli);
	} else {
		echo "<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			ERROR : ログインに失敗しました。再試行してください。</div>";
	}
}
 ?>

<?php
include '../html/footer.html';