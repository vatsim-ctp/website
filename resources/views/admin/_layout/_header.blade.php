<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left" id="currentStatus"></div>

                Hello, <strong>{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</strong>
                &nbsp;&nbsp;&#x7c;&nbsp;&nbsp;
                {{ link_to_route("landing", "Main Site", [], ["style" => "color: #FFFFFF; text-decoration: underline;"]) }}
                &nbsp;&nbsp;&#x7c;&nbsp;&nbsp;
                {{ link_to_route("logout", "Logout?", [], ["style" => "color: #FFFFFF; text-decoration: underline;"]) }}
            </div>
        </div>
    </div>
</header>