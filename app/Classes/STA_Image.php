<?php

namespace App\Classes;

use TCG\Voyager\FormFields\AbstractHandler;

class STA_Image extends AbstractHandler
{
    protected $codename = 'sta_image';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin.formfields.sta_image', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}