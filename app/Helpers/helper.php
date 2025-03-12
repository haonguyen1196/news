<?php

use App\Models\Language;
use App\Models\Setting;

function formatTags($tags) {
    return implode(',', $tags);
}

function getLanguage(): string
{
    if(session()->has('language')){
        return session('language');
    }else {
        try{
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);

            return session('language');
        }catch(Exception $e){
            setLanguage('en');

            return session('language');
        }
    }
}

if (! function_exists('setLanguage'))
{
    function setLanguage(string $code): void
    {
        session()->put('language', $code);
    }
}

if (! function_exists('truncateText'))
{
    function truncateText(string $text, int $limit = 100): string
    {
        if (strlen($text) <= $limit) {
            return $text;
        }
        return substr($text,  0, $limit) . '...';
    }
}


//hàm để định dạng số view
if (! function_exists('convertToKFormat'))
{
    function convertToKFormat(int $number): string
    {
        if ($number >= 1000000) {
            // Chuyển đổi thành định dạng M (triệu)
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            // Chuyển đổi thành định dạng K (nghìn)
            return round($number / 1000, 1) . 'K';
        } else {
            // Trả về số gốc nếu nhỏ hơn 1000
            return (string)$number;
        }
    }
}

//hàm active sidebar
if (! function_exists('sidebarActive')) {
    function sidebarActive(array $routes): ?string {
        foreach($routes as $route){
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return '';
    }
}

//hàm lay thong tin setting
if (! function_exists('getSetting')) {
    function getSetting(string $key): ?string {
        $data = Setting::where('key', $key)->first();

        return $data->value;
    }
}

//check permission
if (! function_exists('canAccess')) {
    function canAccess($permissions){
        $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
        $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

        if($permission || $superAdmin){
            return true;
        }else{
            return false;
        }
    }
}