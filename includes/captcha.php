<?php
// ##############################################################################||
// #   PowerBB Version 2.0.0
// #   http://www.pbboard.info
// #   Copyright (c) 2009 by Abu.Rakan
// #   filename : captcha.php
// ##############################################################################||
		//Start the session so we can store what the code actually is.
		session_start();

	// Check for GD library
	if( !function_exists('gd_info') ) {
		throw new Exception('Required GD library is missing');
	}

		//Now lets use md5 to generate a totally random string
		 $md5 = md5(time());

		/*
		We dont need a 32 character long string so we trim it down to 5
		*/
		$string = substr($md5,0,5);
		/*
		Now for the GD stuff, for ease of use lets create
		 the image from a background image.
		*/

		$captcha = imagecreatefrompng("../look/images/captcha.png");
		/*
		Lets set the colours, the colour $line is used to generate lines.
		 Using a blue misty colours. The colour codes are in RGB
		*/
		$black = imagecolorallocate($captcha, 153, 153, 153);

		/*
		Now for the all important writing of the randomly generated string to the image.
		*/
		imagestring($captcha,5, 20, 0,$string,$black);

		/*
		Encrypt and store the key inside of a session
		*/

		$_SESSION['key'] = md5($string);

		/*
		Output the image
		*/
		@header("Content-type: image/png");
		imagepng($captcha);

?>