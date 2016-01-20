<nav id="mainmenu" class="mainmenu">
                    <ul>
                        <li class="logo-wrapper"><a href="index.html">
                                {!! Html::image("assets/img/logo-eastbound.png", "CTP logo", ["width" => "200"]) !!}
                            </a></li>
                        <li class="active">
                            <li>{!! link_to("home", "Home") !!}</li>
                        </li>
                        <li>
                            <li>{!! link_to("history", "History") !!}</li>
                        </li>
                        <li class="active">
                            <li>{!! link_to("news", "News & Updates") !!}</li>
                        </li>
                        <li class="has-submenu">
                            <a href="#">EB 2015</a>
                            <div class="mainmenu-submenu">
                                <div class="mainmenu-submenu-inner">
                                    <div>
                                        <h4>Flights</h4>
                                        <ul>
                                            <li>{!! link_to("flightslist", "View All Flights") !!}</li>
                                            <li>{!! link_to("bookinglist", "View Booked Flights") !!}</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4>My Booking</h4>
                                        <ul>
                                            <li>{!! link_to("#", "View My Booking") !!}</li>
                                            <li>{!! link_to("#", "Modify my booking") !!}</li>
                                            <li>{!! link_to("#", "Swap booking") !!}</li>
                                            <li>{!! link_to("#", "Transfer booking") !!}</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4>Guides/Documents</h4>
                                        <ul>
                                            <li>{!! link_to("faq", "FAQ") !!}</li>
                                            <li>{!! link_to("#", "Beginner's Guide") !!}</li>
                                            <li>{!! link_to("#", "Departure Information (Heathrow)") !!}</li>
                                            <li>{!! link_to("#", "Oceanic Checklist") !!}</li>
                                            <li>{!! link_to("#", "Arrival Information (Boston)") !!}</li>
                                        </ul>
                                    </div>
                                </div><!-- /mainmenu-submenu-inner -->
                            </div><!-- /mainmenu-submenu -->
                        </li>
                    </ul>
                </nav>