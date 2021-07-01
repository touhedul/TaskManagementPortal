<?php

namespace App\Services;

use App\Models\Setting;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class SettingService
{
    public static function uploadLogoOrIcon($request, $key)
    {
        if ($request->hasFile($key)) {
            $setting = Setting::where('name', $key)->first();
            if (File::exists('images/' . $setting->value)) {
                File::delete('images/' . $setting->value);
            }
            $image = $request->file($key);
            $imageName = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            if ($key == "site_favicon") {
                $height = 33;
                $width = 33;
            } else {
                $height = 50;
                $width = 100;
            }
            Image::make($image)->resize($width, $height)->save('images/' . $imageName, 50);
            $setting->value = $imageName;
            $setting->save();
        }
    }

    public static function setEnv($request)
    {

        Artisan::call("env:set APP_NAME='" . $request->site_title . "'");

        Artisan::call("env:set MAIL_MAILER='" . $request->mail_mailer . "'");
        Artisan::call("env:set MAIL_HOST='" . $request->mail_host . "'");
        Artisan::call("env:set MAIL_PORT='" . $request->mail_port . "'");
        Artisan::call("env:set MAIL_USERNAME='" . $request->mail_username . "'");
        Artisan::call("env:set MAIL_PASSWORD='" . $request->mail_password . "'");
        Artisan::call("env:set MAIL_ENCRYPTION='" . $request->mail_encryption . "'");
        Artisan::call("env:set MAIL_FROM_ADDRESS='" . $request->mail_from_address . "'");

        Artisan::call("env:set MAIL_FROM_NAME='". $request->mail_from_name ."'");

        Artisan::call("env:set FACEBOOK_CLIENT_ID='". $request->facebook_client_id ."'");
        Artisan::call("env:set FACEBOOK_CLIENT_SECRET='". $request->facebook_client_secret ."'");
        Artisan::call("env:set GOOGLE_CLIENT_ID='". $request->google_client_id ."'");
        Artisan::call("env:set GOOGLE_CLIENT_SECRET='". $request->google_client_secret ."'");
    }
}
