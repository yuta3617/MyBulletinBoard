<?php
include '../../config/database.php';
include '../../function/post.php';
include '../html/header.html';
include '../html/index.html';
ob_start();
session_start();
?>

<?php
$posts_data = fetch_posts($mysqli);

if ( $posts_data !== false ) {
	foreach ($posts_data as $post_data ) {
	?>

	<div class="col-xs-12">
		<h4>
			名前：<?php echo $post_data['user_name']; ?>さん
			（<?php echo $post_data['post_date']; ?>）
		</h4>
		<p><?php echo $post_data['post_comment']; ?></p>
	</div>

	<?php } // End of foreach ?>

<?php } // End of if ?>

<?php
// 口コミの投稿
if ($_POST) {

	// 必須項目に情報が入っているかを確認する
	if ( !empty( $_POST['add_post'] )) {
		$add_post = $_POST['add_post'];
		add_post($add_post, $mysqli);
	} else {
		echo "口コミを入力してください";
	}
}
 ?>

<div class="container">
	<div class="row">
		 <div class="col-xs-12">
		 	<h3>口コミを投稿する</h3>
			<form action="" method="post">
				<textarea name="add_post" class="form-control" placeholder="口コミを記入してください。"></textarea>
				<button type="submit" class="btn btn-default">投稿する</button>
			</form>
		 </div>
	</div>
</div>

<?php
include '../html/footer.html';