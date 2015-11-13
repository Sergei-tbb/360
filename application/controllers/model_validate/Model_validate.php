<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Model_validate extends CI_Controller
{
    private $width;
    private $height;
    private $quality_print;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_image_data()
    {
        $image = new Imagick("./users_files/1/KVBwtxt_cmyk.tif");
        $data = $image->identifyImage();

        //check image format
//        $image_resolution = $image->getImageFormat();
        if(!in_array($image->getImageFormat(), array('TIFF', 'JPEG', 'PSD', 'PDF', 'EPS')))
        {
            $message = "Ручная проверка";
        }

        //check and change color space
        if(stripos($data['colorSpace'], 'rgb') !== FALSE)
        {
            $image->setImageColorspace(imagick::COLORSPACE_CMYK);
        }

        $data = $image->identifyImage();

        //check channel depth
        $channel_depth = $this->_get_chanel_depth($image);
        foreach($channel_depth as $index => $value)
        {
            if($value != 8)
            {
                $message =  "Канал {$index}  равен {$value}";
            }
        }
    }

    private function _get_chanel_depth($image)
    {
        $data['cyan'] = $image->getImageChannelDepth(imagick::COLOR_CYAN);
        $data['magenta'] = $image->getImageChannelDepth(imagick::COLOR_MAGENTA);
        $data['yellow'] = $image->getImageChannelDepth(imagick::COLOR_YELLOW);
        $data['black'] = $image->getImageChannelDepth(imagick::COLOR_BLACK);

        return $data;
    }

    private function _get_quality_print()
    {

    }
}



