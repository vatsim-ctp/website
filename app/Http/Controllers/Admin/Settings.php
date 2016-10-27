<?php

namespace CTP\Http\Controllers\Admin;

use Cache;
use CTP\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Settings extends BaseController
{
    public function getIndex(Request $request)
    {
        $settings = Setting::all();
        $groups = Setting::getGroups();

        $settings_grouped = collect();

        $settings->each(function ($item, $key) use ($settings_grouped) {
            if (!$settings_grouped->has($item->aspect)) {
                $settings_grouped->put($item->aspect, collect());
            }

            $settings_grouped->get($item->aspect)->push($item);
        });

        return view('admin.settings.index')
            ->with("groups", $groups)
            ->with("settings", $settings_grouped);
    }

    public function postUpdate(Request $request)
    {
        $validator = \Validator::make($request->all(), Setting::buildValidatorRules());

        if($validator->fails()){
            flash("There were some errors with your input.  Your settings were <strong>not saved</strong>.", "danger");

            return redirect()->back()->withErrors($validator);
        }

        foreach(Setting::all() as $setting){
            $key = $setting->aspect.".".$setting->code;

            if(!$request->has($key)){
                continue;
            }

            if($request->input($key) == $setting->value_default){
                continue;
            }

            $setting->value = $request->input($key);
            $setting->save();

            Cache::forget("setting_".$setting->aspect."_".$setting->code);
        }

        flash("Settings have been saved!", "success");

        return redirect()->route("admin.settings.index");
    }
}
