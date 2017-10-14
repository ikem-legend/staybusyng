<?php
session_start();
if(file_exists('session.php')){
	include 'session.php';
}
if (isset($done_at) && (time() - $done_at > 10)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
	session_destroy();   // destroy session data in storage
	unlink('session.php');
}
// $_SESSION['lockedoutbitch'] = 'locked';
if (isset($_POST) & !empty($_POST)){
	if ($_POST['captcha'] == $_SESSION['code']){
		echo "<p class=\"alert-success text-center\"> Correct captcha</p>";
		header('Location: success.php');
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
		
		if ($_SESSION["attempt"] >= 5) {
			echo "string".$count;
			$_SESSION['lockedoutbitch'] = 'locked';
			$done_at = time();
			$var_str = var_export($done_at, true);
			$var = "<?php\n\n\$done_at = $var_str;\n\n?>";
			file_put_contents('session.php', $var);
			// header('Location: fail.php');
			// session_destroy();
			// $_SESSION['lockedoutbitch'] = time();
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

			header {
				background-color: #E5E5E5;
				text-align: center;
				line-height: 3em;
				font-weight: bold;
			}

			h1 {
				text-align: center;
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
		<?php if(isset($_SESSION["lockedoutbitch"]) && $_SESSION["lockedoutbitch"] == "locked"){
			// sleep(10);
			// session_destroy();
			// header('Location: simple_captcha.php');  
		?>
		<header>Simple CAPTCHA Script in PHP</header>
		<h1>You have exceeded the number of tries for the captcha, please try again</h1>
		<?php } else  { ?>
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
		<?php } ?>
		<?php //endif ?>
	</body>
</html>