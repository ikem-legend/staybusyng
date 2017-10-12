<?php
session_start();
	// $_SESSION["attempt"] = NULL;
	// print_r($_SESSION['attempt']); print_r($_SESSION['code']);
	if (isset($_POST) & !empty($_POST)){
		if ($_POST['captcha'] == $_SESSION['code']){
			echo "<p class=\"alert-success\"> Correct captcha</p>";
			header('Location: success.php');
		} else {
			echo "<p class=\"alert-danger\">Invalid captcha</p>";
			if ($_SESSION['attempt'] == 0) {
			 	$count = 0;
			} else {
			 	$count = $_SESSION['attempt'];
			}
			$count = $count+1;
			echo "string".$count;
			$_SESSION['attempt'] = $count;
				// die();
			// $_SESSION["attempt"] = $count;
			if ($_SESSION["attempt"] == 5) {
				header('Location: fail.php');
			}
		}
	}
?>
<html>
<head>
    <title>Simple CAPTCHA Script in PHP</title>
</head>
  <body>
    <form action="" method="post">
    	<input type="text" name="name" /><br/>
    	<input type="email" name="email" /><br/>
    	<img src="captcha2.php" /><input type="text" name="captcha" /><br/>
        <input type="submit" value="submit" />
    </form>
  </body>
</html>