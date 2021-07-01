<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    /**
     * get the setting from database
     *
     * @param  string $name
     * @return string
     */
    function setting($name)
    {
        $setting = Setting::where('name',$name)->first();
        return $setting->value ?? NULL;
    }
}
