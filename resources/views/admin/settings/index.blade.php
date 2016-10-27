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
                        @include("admin.settings._group", ["settings" => $settings, "group" => $group, "isFirst" => $loop->first, "isLast" => $loop->last])
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

        @if(is_setup_complete())
            {{ Form::open(["route" => "admin.settings.reset", "method" => "POST"]) }}
            <div class="panel panel-default panel-danger">
                <div class="panel-heading">
                    Reset Website
                </div>
                <div class="panel-body">
                    <p>
                        Resetting the website will carry out the following actions <strong class="text-danger">specific
                            to {{ setting("event", "name") }} and cannot be undone:</strong>
                    </p>
                    <ul>
                        <li>Remove flight data</li>
                        <li>Aggregate flight statistics</li>
                        <li>Remove booking details</li>
                        <li>Aggregate booking statistics</li>
                        <li>Remove route data</li>
                        <li>Remove all airfields</li>
                        <li>Archive all feedback</li>
                    </ul>
                    <p>
                        This process <strong class="text-danger">is not instant and may take up to 60 minutes to
                            complete</strong>.
                    </p>
                    <div class="form-group">
                        <label for="auth_code">Authorisation Code</label>

                        <input type="password" class="form-control" name="authorisation_code"/>
                    </div>
                </div>
                <div class="panel-footer clearfix">
                    <div class="btn-group pull-right">
                        <input type="submit" class="btn btn-danger" value="Reset Website"/>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        @endif
    </div>
@stop