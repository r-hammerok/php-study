<?php
require_once 'vendor/autoload.php';
const IMG_DIR =  __DIR__ . '/image/';
const IMG_MODIFIED = IMG_DIR . 'modified/';

use Intervention\Image\ImageManagerStatic as Image;

Image::configure(['driver' => 'imagick']);

$source = IMG_DIR . '01.jpg';
$result = IMG_MODIFIED . '01.jpg';

$img = Image::make($source);

$img->resize(200, null, function ($img) {
    $img->aspectRatio();
});
$img->text(
    "Бородатый\nдядька",
    10,
    10,
    function ($font) {
        $font->file(IMG_DIR .'arial.ttf');
        $font->size('24');
        $font->color([0, 0, 0, 0.3]);
        $font->align('left');
        $font->valign('top');
    }
);
$img->save($result, 80);
echo $img->response('png');
