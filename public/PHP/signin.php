<?php
include '../../config/database.php';
include '../html/header.html';
include '../html/signin.html';

include '../../function/sign.php';
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
		echo "Your sign in are rejected. There're some errors in your input.";
	}
}
 ?>

<?php
include '../html/footer.html';