<?php
session_start();
	// $_SESSION["attempt"] = NULL;
	// print_r($_SESSION['attempt']); print_r($_SESSION['code']);
	if (isset($_POST) & !empty($_POST)){
		if ($_POST['captcha'] == $_SESSION['code']){
			echo "<p class=\"alert-success text-center\"> Correct captcha</p>";
			header('Location: success.html');
		} else {
			echo "<p class=\"alert-danger text-center\">Invalid captcha</p>";
			if ($_SESSION['attempt'] == 0) {
			 	$count = 0;
			} else {
			 	$count = $_SESSION['attempt'];
			}
			$count = $count+1;
			// echo "string".$count;
			$_SESSION['attempt'] = $count;
			// $_SESSION["attempt"] = $count;
			if ($_SESSION["attempt"] == 5) {
				echo "string";
				header('Location: fail.php');
				session_destroy();
			}
		}
	}
?>
<html>
	<head>
	    <title>Simple CAPTCHA Script in PHP</title>
	    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway">
	    <style type="text/css">
		    html {
				position: relative;
				min-height: 100%;
			}

			body {
				margin: 0; width: 100%
			}
			label {
				margin: 5px 0;
			}
			.btn {
				margin-top: 5px;
			}
	    	/*header {background-color: #E5E5E5}*/
	    </style>
	</head>
	<body>
	<div class="jumbotron">
		<header class="text-center"><h1 class="">Simple Captcha App</h1></header></div>
		<div class="container">
			<div class="row>">
			    <form action="" method="post" class="form-group">
			    	<label class="">Name</label><input type="text" name="name" class="form-control form-rounded" />
			    	<label class="">Email</label><input type="email" name="email" class="form-control" />
			    	<label class="">Captcha</label><img src="captcha.php" /><input type="text" name="captcha" class="form-control" />
			        <button type="submit" value="submit" class="btn btn-default center-block"/>Submit</button>
			    </form>
			</div>
		</div>
	</body>
</html>