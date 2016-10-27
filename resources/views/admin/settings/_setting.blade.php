<div class="form-group">
    <label for="{{ $setting->form_name }}">{{ $setting->name }}</label>

    @if($setting->value_options !== null)
        @include("admin.settings._setting_selection", ["setting" => $setting])
    @else
        @include("admin.settings._setting_".$setting->type, ["setting" => $setting])
    @endif

    @include("admin.settings._setting_help", ["setting" => $setting])
</div>