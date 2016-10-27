<select class="form-control selectpicker" name="{{ $setting->form_name }}" id="{{ $setting->form_name }}">
    <option value="">Select A Value</option>
    @foreach($setting->value_options as $option)
        <option value="{{ $option }}" {{ old($setting->form_name, "x") == $option ? "selected='selected'" : "" }}>{{ $option }}</option>
    @endforeach
</select>