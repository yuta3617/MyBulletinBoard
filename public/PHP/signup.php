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
			echo "確認用パスワードが一致しません。再度入力してください。";
		}
	} else {
		echo "<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			ERROR : アカウントの新規作成に失敗しました。再試行してください。</div>";
	}
}
?>

<?php
include '../html/footer.html';