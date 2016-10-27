<p class="help-block">
    @if($setting->value_default !== null)
        Default: {{ $setting->value_default }}<br/>
    @endif

    {{ $setting->description }}

    @if($setting->required)
        <strong>This is a mandatory setting.</strong>
    @endif

</p>