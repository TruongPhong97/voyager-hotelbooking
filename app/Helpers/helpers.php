<?php

/**
 * @param Attribute $row Which DataRow be use for field name
 * @param ModelData $dataType Which DataType the DataRow belong to
 * @param Model $dataTypeContent Which is the DataType name
 * @return formfield
 */

use PhpParser\ErrorHandler\Collecting;

if (!function_exists('VoyagerFormFields')) {
    function VoyagerFormFields(Object $row, Object $dataType, Object $dataTypeContent, string $class = null)
    {
        // dd($dataTypeContent);
        $field = '';
        $classes[] = $class;
        $display_options = $row->details->display ?? NULL;

        if ($row->type == ' hidden') {
            $classes[] = 'hidden';
        }

        if (isset($display_options->width)) {
            $classes[] = 'col-md-' . $display_options->width;
        }

        if (isset($row->details->formfields_custom)) :
            $field .= View('voyager::formfields.custom.' . $row->details->formfields_custom);
        else :
            $field .= '<div class="form-group ' . implode(' ', $classes) . '"' . (isset($display_options->id) ? 'id="' . $display_options->id . '"' : '') . '>';
            $field .= $row->slugify;
            $field .= '<label for="name">' . $row->getTranslatedAttribute("display_name") . '</label>';
            // $field .= Voyager::view('voyager::multilingual.input-hidden-bread-edit-add', ['row' => $row, 'dataTypeContent' => $dataTypeContent]);
            $field .= View('voyager::multilingual.input-hidden-bread-edit-add', ['row' => $row, 'dataTypeContent' => $dataTypeContent]);

            if ($row->type == 'relationship') :
                $field .= View('voyager::formfields.relationship', ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'options' => $row->details]);
            else :
                $field .= app('voyager')->formField($row, $dataType, $dataTypeContent);
            endif;

            foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after) :
                $field .= $after->handle($row, $dataType, $dataTypeContent);
            endforeach;
            $field .= '</div>';
        endif;

        return $field;
    }
}

/**
 * @param Model $room to display bed number
 * @return bed with singular or plural string
 */
if (!function_exists('get_bed')) {
    function get_bed(Object $room)
    {
        return $room->bed > 1 ? $room->bed . ' ' . __('beds') : $room->bed . ' ' . __('bed');
    }
}

/**
 * @param Model $room to display price
 * @return price formated price with currency symbol
 */
if (!function_exists('get_price')) {
    function get_price($price)
    {
        $price = number_format(
            $price,
            setting('currency.num_decimals'),
            setting('currency.decimal_sep'),
            setting('currency.thousand_sep')
        );

        // default currency position is left
        $price = setting('currency.symbol') . $price;

        // if currency position is right
        if (setting('currency.position') == 'right') {
            $price = $price . setting('currency.symbol');
        }

        return $price;
    }
}

/**
 * @param Model $room to display price per night
 * @return price
 */
if (!function_exists('price_per_night')) {
    function price_per_night(Object $room)
    {
        $is_fixed_price = $room->is_fixed_price == false ? __('From ') : '';
        return $is_fixed_price . get_price($room->price) . '/' . __('night');
    }
}

/**
 * @param Model $room to display people
 * @return people numbers of max adult and max children
 */
if (!function_exists('get_people')) {
    function get_people(Object $room)
    {
        $adult = $room->max_adult > 1 ? $room->max_adult . ' ' . __('adults') : $room->max_adult . ' ' . __('adult');
        $children = $room->max_children > 1 ? $room->max_children . ' ' . __('childs') : $room->max_children . ' ' . __('child');
        $people = $adult . ', ' . $children;

        return $people;
    }
}
