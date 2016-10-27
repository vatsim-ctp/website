<input type="text" class="form-control" id="{{ $setting->form_name }}"
       name="{{ $setting->form_name }}"
       value="{{ old($setting->form_name_reference, $setting->value) }}"/>