<?php

namespace CTP\Http\Controllers\Admin;

use Artisan;
use Cache;
use CTP\Models\Setting;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Settings extends BaseController
{
    public function getIndex(Request $request)
    {
        if (is_setup_complete()) {
            $settings = Setting::editable()->get();
        } else {
            $settings = Setting::all();
        }

        $groups = $settings->pluck('aspect')->unique();

        $settings_grouped = collect();

        $settings->each(function ($item, $key) use ($settings_grouped) {
            if (! $settings_grouped->has($item->aspect)) {
                $settings_grouped->put($item->aspect, collect());
            }

            $settings_grouped->get($item->aspect)->push($item);
        });

        return view('admin.settings.index')
            ->with('groups', $groups)
            ->with('settings', $settings_grouped);
    }

    public function postUpdate(Request $request)
    {
        if (is_setup_complete()) {
            $settings = Setting::editable()->get();
        } else {
            $settings = Setting::all();
        }

        $validator = \Validator::make($request->all(), Setting::buildValidatorRules(is_setup_complete()));

        if ($validator->fails()) {
            flash('There were some errors with your input.  Your settings were <strong>not saved</strong>.', 'danger');

            return redirect()->back()->withInput()->withErrors($validator);
        }

        foreach ($settings as $setting) {
            $key = $setting->aspect.'.'.$setting->code;

            if (! $request->has($key)) {
                continue;
            }

            if ($request->input($key) == $setting->value_default) {
                continue;
            }

            $setting->value = $request->input($key);
            $setting->save();

            Cache::forget('setting_'.$setting->aspect.'_'.$setting->code);
        }

        flash('Settings have been saved!', 'success');

        return redirect()->route('admin.settings.index');
    }

    public function postReset(Request $request)
    {
        if (! Hash::check($request->input('authorisation_code'), setting('system', 'authorisation_code'))) {
            flash('You did not enter the correct authorisation code.', 'danger');

            return redirect()->back();
        }

        Artisan::call('down');

        return redirect()->back();
    }
}
