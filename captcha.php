<?php
	session_start();
	$captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
	$captcha_num = substr(str_shuffle($captcha_num), 0, 5);
	$_SESSION['code'] = $captcha_num;
	// $_SESSION['user'] = $user;

	//specify the path where the font exists
	$font = 'fonts/Roboto-Regular.ttf';

	$image = imagecreatetruecolor(170, 60);
	$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 200, 100, 90); // red
	$white = imagecolorallocate($image, 255, 255, 255);

	imagefilledrectangle($image,0,0,399,99,$white);
	imagettftext ($image, 30, 0, 10, 40, $color, $font, $_SESSION['code']);
	// imagettftext ($image, 30, 0, 10, 40, $color, $dir."arial.ttf", $_SESSION['code']);

	header("Content-type: image/png");
	imagepng($image);

?>