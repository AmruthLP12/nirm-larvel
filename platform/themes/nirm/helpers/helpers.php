<?php

if (!function_exists('showSTT')) {
    function showSTT($modal, $stt = 0)
    {
        $tmp   = \Request::has('page') ? \Request::input('page') : 1;
        $count = \Request::has('page') ? (($tmp * $modal->perPage()) - $modal->perPage()) + 1 : 1;
        return $count + $stt;
    }
}