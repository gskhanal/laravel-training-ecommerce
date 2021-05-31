<?php
use Intervention\Image\Facades\Image;

if(!function_exists('image_crop')){
    function image_crop( $image_name, $width = 550, $height = 750 ){
        return Image::make($image_name)->resize($width, $height);
    }
}