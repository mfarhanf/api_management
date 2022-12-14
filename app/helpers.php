<?php

if (! function_exists('transform_array')) {
    function transform_array($data) {
        $newArray = [];

        foreach ($data as $value) {
            $newArray[$value] = ucfirst($value);
        }
        
        return $newArray;
    }
}