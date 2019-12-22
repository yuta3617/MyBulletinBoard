<?php
ob_start();
session_start();
include '../../config/database.php';
include '../../function/post.php';
if(empty($_SESSION['user'])){
	include '../html/header_signin.html';
} else {
	include '../html/header.html';
}
include '../html/edit.html';
?>

<?php
if( empty($_GET['edit_post_id']) ) {
	header('Location: ../PHP/mypage.php');
}
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3>投稿を編集または削除する</h3>
			<form action="" method="post">
				<textarea name="edit_post_text" class="form-control" placeholder="変更後のテキスト"></textarea>
				<button name="edit_post" type="submit" class="btn btn-primary">変更する</button>
				<button name="delete_post" type="submit" class="btn btn-danger">削除する</button>
				<button name="cancel" type="submit" class="btn btn-default">キャンセル</button>
			</form>
		</div>
	</div>
</div>

<br><br>

<?php
if (isset($_POST['edit_post'])) {
	if ( !empty( $_POST['edit_post_text'] )) {
		$edit_post = $_POST['edit_post_text'];
		edit_post($_GET['edit_post_id'],$edit_post,$mysqli);
	} else {
		echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		ERROR : 投稿内容を入力してください</div>";
	}
}
?>

<?php
if (isset($_POST['delete_post'])) {
	delete_post($_GET['edit_post_id'],$mysqli);
}
?>

<?php
if (isset($_POST['cancel'])) {
	header('Location: ../PHP/mypage.php');
}
?>

<?php
include '../html/footer.html';