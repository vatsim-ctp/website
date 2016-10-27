<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="dashboard-div-wrapper bk-clr-one">
            <i class="fa fa-plane dashboard-div-icon"></i>
            <div class="progress progress-striped active">
            </div>
            <h5>0 Flights Available</h5>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="dashboard-div-wrapper bk-clr-two">
            <i class="fa fa-paper-plane dashboard-div-icon"></i>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                     aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                </div>

            </div>
            <h5>0 Flights Booked</h5>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="dashboard-div-wrapper bk-clr-three">
            <i class="fa fa-envelope dashboard-div-icon"></i>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $percentage_users_on_mailing_list }}"
                     aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage_users_on_mailing_list }}%">
                </div>

            </div>
            <h5>{{ $total_users_on_mailing_list }} {{ str_plural("User", $total_users_on_mailing_list) }} on mailing list</h5>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="dashboard-div-wrapper bk-clr-four">
            <i class="fa fa-users dashboard-div-icon"></i>
            <div class="progress progress-striped active">
            </div>
            <h5>{{ $total_users }} Total {{ str_plural("user", $total_users) }}</h5>
        </div>
    </div>

</div>