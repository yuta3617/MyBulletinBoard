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
if(!empty($_SESSION['user'])){
	include '../html/header_signin.html';
} else {
	include '../html/header.html';
}
include '../html/index.html';
?>

<div class="container">
	<div class="row">
		 <div class="col-xs-12">
		 	<h3>投稿する</h3>
			<form action="" method="post">
				<textarea name="add_post_text" class="form-control" placeholder="投稿内容"></textarea>
				<button name="add_post" type="submit" class="btn btn-primary">投稿する</button>
			</form>
		 </div>
	</div>
</div>

<br><br>

<?php
if (isset($_POST['sign_out'])) {
	sign_out();
}

if (isset($_POST['add_post'])) {
	if ( !empty( $_POST['add_post_text'] )) {
		$add_post = $_POST['add_post_text'];
		add_post($add_post, $mysqli);
	} else {
		echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		ERROR : 投稿内容を入力してください</div>";
	}
}
?>

<?php
$posts_data = fetch_posts($mysqli);

if ( $posts_data !== false ) {
	foreach ($posts_data as $post_data ) {
	?>

	<div class="col-xs-12">
		<h4>
			名前：<?php echo $post_data['user_name']; ?>
			（<?php echo $post_data['post_date']; ?>）
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