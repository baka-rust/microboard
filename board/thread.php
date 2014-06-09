<?php
	$Board = basename(getcwd());
	include('../src/functions.php');
	DatabaseConnect();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Thread Title</title>
		<link rel="stylesheet" type="text/css" href="../static/style.css" />
	</head>
	
	<body>
		<div id="content">
		
			<div class="top-nav">[ / <a href="..">home</a> / <a href="#">board</a> / ]</div>
		
			<h1>/board/ - Board Title</h1>
		
			<hr>
		
			<?php
			
				if(isset($_GET['id'])) {
					GetParent($Board, $_GET['id']);
					GetPosts($Board, $_GET['id']);
				}
				else {
					print("Thread not found.");
				}
			
			?>
			
			<div class="post-box">
				<form name="thread" action="../src/post.php" method="post">
					<textarea class="post" name="content" ></textarea>
					</br>
					<input type="submit" value="Submit" />
				</form>
			</div>
			
			<div class="footer">powered by <a href="https://github.com/baka-rust/microboard">microboard</a></div>
		
		</div>
	</body>
</html>