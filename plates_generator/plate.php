<?php

$BLANK_PLATE_WIDTH = 572;
$BLANK_PLATE_HEIGHT = 126;
$SYMBOL_WIDTH = 25;
$SYMBOL_HEIGHT = 126;

$im = imagecreatefrompng('assets/blank_plate.png');
$symbol = imagecreatefrompng('assets/middle_symbol.png');
imagesavealpha($im, true);

$bg = imagecolorallocate($im, 0, 0, 0);
$textcolor = imagecolorallocate($im, 0, 0, 0);

$font =  'assets/din1451alt.ttf';

$type_space = imagettfbbox(81, 0, $font, strtoupper($_GET["plate"]));

$type_space_firsttwo = imagettfbbox(81, 0, $font, substr(strtoupper($_GET["plate"]), 0, 2));
$type_space_lasttwo = imagettfbbox(81, 0, $font, substr(strtoupper($_GET["plate"]), 2, 5));

imagettftext($im, 81, 0, abs($BLANK_PLATE_WIDTH-($type_space[4] + $SYMBOL_WIDTH))/2, abs($BLANK_PLATE_HEIGHT-$type_space[5])/2, $textcolor, $font, substr(strtoupper($_GET["plate"]), 0, 2));

imagecopy($im, $symbol, abs($BLANK_PLATE_WIDTH-($type_space[4] + $SYMBOL_WIDTH))/2+$type_space_firsttwo[4], 0, 0, 0, $SYMBOL_WIDTH, $BLANK_PLATE_HEIGHT);

imagettftext($im, 81, 0, abs($BLANK_PLATE_WIDTH-($type_space[4] + $SYMBOL_WIDTH))/2 + $type_space_firsttwo[4] + $SYMBOL_WIDTH, abs($BLANK_PLATE_HEIGHT-$type_space[5])/2, $textcolor, $font, substr(strtoupper($_GET["plate"]), 2, 5));

header('Content-type: image/png');

imagepng($im);
imagedestroy($im);