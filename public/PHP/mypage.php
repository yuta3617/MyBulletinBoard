<?php
include '../../config/database.php';
include '../../function/post.php';
include '../html/header_signin.html';
include '../html/mypage.html';
ob_start();
session_start();
?>

<br><br>

<?php
$posts_data = fetch_posts_mypage($_SESSION['user'],$mysqli);

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

<?php } ?>

<?php
include '../html/footer.html';