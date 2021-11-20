<?php

use MakechTec\ImageConverter\Converters\Webp;
use MakechTec\ImageConverter\ImgFile;

require_once('vendor/autoload.php');

$name = __DIR__ . '/img/p.png';

$image = new ImgFile($name);
$webpConverter = new Webp();

$result = $webpConverter->convert($image->readContent())
;

header('Content-Type: image/webp');

echo($result);