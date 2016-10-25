<?php

function setting($aspect, $code, $default = null)
{
    $cacheKey = "setting_" . $aspect . "_" . $code;

    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }

    $setting = \CTP\Models\Setting::findFull($aspect, $code)->first();

    if (!$setting) {
        return $default;
    }

    $settingValue = $setting->value_or_default;

    switch ($setting->type) {
        case "boolean":
            $settingValue = (bool)$settingValue;
            break;

        case "date":
        case "time":
        case "timestamp":
            $settingValue = \Carbon\Carbon::parse($settingValue);
            break;
    }

    Cache::put($cacheKey, $settingValue, 60 * 24); // 24 hour cache, 60 minutes per hour.

    return $settingValue;
}

function voting_available()
{
    $votingStart = setting("voting", "open");

    if (!$votingStart || !($votingStart instanceof \Carbon\Carbon)) {
        return false;
    }

    $votingFinish = setting("voting", "close");

    if (!$votingFinish || !($votingFinish instanceof \Carbon\Carbon)) {
        return false;
    }

    return $votingStart->lt(\Carbon\Carbon::now()) && $votingFinish->gt(\Carbon\Carbon::now());
}