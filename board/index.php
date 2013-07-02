<!DOCTYPE html>
<html>
	<head>
		<title>/board/ - Board Title</title>
		<link rel="stylesheet" type="text/css" href="../static/style.css" />
	</head>
	
	<body>
		<div id="content">
		
			<div class="top-nav">[ / <a href="..">home</a> / <a href="#">board</a> / ]</div>
		
			<h1>/board/ - Board Title</h1>
		
			<hr>
			
			<div class="post-box">
				<form name="thread" action="../src/post.php" method="post">
					<textarea class="post" name="content" ></textarea>
					</br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		
			<div class="thread" id="1">
				<span class="post-info">Month Day, Year @ Time <a href="#number">#number</a> <span class="more">[<a href="thread.php">more</a>]</span></span>
				<hr class="post">
				thread content
			</div>
			
			<div class="thread" id="2">
				<span class="post-info">Month Day, Year @ Time <a href="#number">#number</a> <span class="more">[<a href="thread.php">more</a>]</span></span>
				<hr class="post">
				reply content
			</div>
			
			<div class="footer">powered by <a href="https://github.com/baka-rust/microboard">microboard</a></div>
		
		</div>
	</body>
</html>