<?php

function rotatetransparentimg($imageSource, $angle) {
	$transp = imagecolorallocatealpha($imageSource, 0, 0, 0, 127);

	imagefill($imageSource, 0, 0, $transp);

	$result = imagerotate($imageSource, $angle, $transp);

	imagealphablending($result, false);
	imagesavealpha($result, true);

	return $result;
}



// Create a 1200*600 image
$im = imagecreatetruecolor(1200, 600);

// Create some colors
$red = imagecolorallocate($im, 255, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$darkRed = imagecolorallocate($im, 100, 100, 100);


// Draw the frame:
imagefilledrectangle($im, 0, 0, 1200, 600, $white);
imagefilledrectangle($im, 10, 130, 1190, 400, $red);
imagefilledrectangle($im, 30, 150, 1170, 380, $white);


// Draw the text:
// The text to draw
$text = "Sold out!";

// Replace path by your own font path
$font = "./arial.ttf";

// Add some shadow to the text
imagettftext($im, 190, 0, 100, 355, $darkRed, $font, $text);

// Add the text
imagettftext($im, 190, 0, 100, 350, $red, $font, $text);

// Add the transparency
imagecolortransparent($im, $white);

// Rotate the image
$im = rotatetransparentimg($im, 20);



// Output and free memory
header("Content-type: image/png");
imagepng($im);
imagedestroy($im);

?>