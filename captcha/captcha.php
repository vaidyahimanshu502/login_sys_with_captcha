<?php
session_start();

$randomString = '';

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_SESSION['captcha']) && !empty($_SESSION['captcha'])) {
    $randomString = $_SESSION['captcha'];
} else {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    for ($i = 0; $i < 7; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $_SESSION['captcha'] = $randomString;
}

header('Content-Type: image/png');

$image = imagecreatetruecolor(100, 40);
$bgColor = imagecolorallocate($image, 165, 177, 120);
$textColor = imagecolorallocate($image, 0, 0, 0);

imagefill($image, 0, 0, $bgColor);
imagestring($image, 5, 5, 10, $randomString, $textColor);

imagepng($image);

imagedestroy($image);
?>
