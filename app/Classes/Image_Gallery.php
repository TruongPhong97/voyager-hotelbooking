<?php

namespace App\Classes;

use TCG\Voyager\FormFields\AbstractHandler;

class Image_Gallery extends AbstractHandler
{
    protected $codename = 'image_gallery';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin.formfields.image_gallery', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}