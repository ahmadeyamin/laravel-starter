<?php

if (!function_exists('datetime')) {


    /**
     * datetime
     *
     * @param  mixed $date
     * @return void
     */
    function datetime($date)
    {
        return $date->format('m/d/Y h:iA');
    }
}
