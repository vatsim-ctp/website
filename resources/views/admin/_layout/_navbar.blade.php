<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <h1 style="text-align: center; color: #FFFFFF;">
            {{ setting("event", "code") }} :: {{ setting("event", "name") }} - {{ setting("event", "date")->format("D jS M Y") }}
        </h1>
    </div>
</div>

<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li>
                            <a class="{{ Request::is("admin") ? "menu-top-active" : "" }}" href="{{ route("admin.dashboard") }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/airports*") ? "menu-top-active" : "" }}" href="{{ route("admin.airports.index") }}">
                                Airports
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/flights*") ? "menu-top-active" : "" }}" href="{{ route("admin.flights.index") }}">
                                Flights
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/bookings*") ? "menu-top-active" : "" }}" href="{{ route("admin.bookings.index") }}">
                                Bookings
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/routes*") ? "menu-top-active" : "" }}" href="{{ route("admin.routes.index") }}">
                                Routes
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/users*") ? "menu-top-active" : "" }}" href="{{ route("admin.users.index") }}">
                                Users
                            </a>
                        </li>
                        <li>
                            <a class="{{ Request::is("admin/settings*") ? "menu-top-active" : "" }}" href="{{ route("admin.settings.index") }}">
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>