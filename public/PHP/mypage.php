<?php
ob_start();
session_start();
include '../../config/database.php';
include '../../function/post.php';
include '../../function/sign.php';
if (isset($_SESSION['message'])){
	$message = $_SESSION['message'];
	echo "<div class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		{$message}</div>";
	unset($_SESSION['message']);
}
include '../html/header_signin.html';
include '../html/mypage.html';
?>

<br><br>

<?php
if (isset($_POST['sign_out'])) {
	sign_out();
}

$posts_data = fetch_user_posts($_SESSION['user'],$mysqli);

if ( $posts_data !== false ) {
	foreach ($posts_data as $post_data ) {
	?>

	<div class="col-xs-12">
		<h4>
			名前：<?php echo $post_data['user_name']; ?>
			（<?php echo $post_data['post_date']; ?>）
			<a class="btn btn-primary btn-sm" href="../PHP/edit.php?edit_post_id=<?php echo $post_data['post_id']; ?>">編集・削除</a>
		</h4>
		<p><?php echo $post_data['post_comment']; ?></p>
	</div>

	<?php } ?>

<?php } else { ?>
	<div class="col-xs-12">
		<h4>まだ投稿はありません</h4>
	</div>
	<?php } ?>

<?php
include '../html/footer.html';