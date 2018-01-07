<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		.label-success {
			content: '';
			display: block;
			clear: both;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h2>Chat Application Web Socket</h2>


			<h3>Messages</h3>
			<ul class="messages-list"></ul>


			<h3>Username <span class="username label label-primary"></span></h3>
			<!-- <div class="row"> -->
				<form class="username-setter" action="index.php" method="post">
					<div class="form-group">
						<label for="">Set username</label>
						<input type="text" name="username" value="" class="form-control username-input">
					</div>
					<button class="btn btn-primary pull-right" type="submit" name="button">Set</button>
				</form>
			<!-- </div> -->

			<form class="chatForm" action="/index.php" method="post">
				<div class="form-group">
					<label for="message">Message</label>
					<textarea type="button" id="message" name="message" class="form-control" value=""></textarea>					
				</div>
				<div class="form-group">
					<button type="submit" name="button" class="btn btn-primary pull-right">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>