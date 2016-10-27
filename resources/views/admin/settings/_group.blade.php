<div class="tab-pane fade {{ $isFirst ? "active in" : "" }}" id="{{ $group }}">
    @foreach($settings->get($group) as $setting)
        @include("admin.settings._setting", ["setting" => $setting])
    @endforeach
</div>