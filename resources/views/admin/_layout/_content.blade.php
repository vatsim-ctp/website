<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">
                    @section("title")
                        No Title Specified
                    @show
                </h4>

            </div>

        </div>

        @include("flash::message")

        @yield("content")
    </div>
</div>