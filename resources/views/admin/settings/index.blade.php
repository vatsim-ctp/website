@extends("admin._layout._master")

@section("title")
    Settings
@stop

@section("content")
    <div class="col-md-12 col-sm-12">
        {{ Form::open(["route" => "admin.settings.update", "method" => "POST"]) }}
        <div class="panel panel-default">
            <div class="panel-heading">
                Modify Settings
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    @foreach($groups as $group)
                        <li class="{{ $loop->first ? "active" : "" }}">
                            <a href="#{{ $group }}" data-toggle="tab">
                                {{ ucwords($group) }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach($groups as $group)
                        <div class="tab-pane fade {{ $loop->first ? "active in" : "" }}" id="{{ $group }}">
                            @foreach($settings->get($group) as $setting)
                                <div class="form-group">
                                    <label for="{{ $setting->form_name }}">{{ $setting->name }}</label>
                                    <input type="text" class="form-control" id="{{ $setting->form_name }}"
                                           name="{{ $setting->form_name }}"
                                           value="{{ old($setting->form_name, $setting->value) }}"/>
                                    <p class="help-block">
                                        Default: {{ $setting->value_default }}<br/>
                                        {{ $setting->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-success" value="Save Settings"/>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@stop