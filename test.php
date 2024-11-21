<?php
include 'Base32.php';
$a = new Base32();
$encode = $a->base32_encode('test123');
$base32 = $a->base32_decode($encode);
echo 'ini adalah hasil encrypt : '.$encode.'<br>';
echo 'ini adalah hasil decrypt : '.$base32;
?>