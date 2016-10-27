<div class="landing-page-subscribe container">
    <div class="row">
        <button id="subBtn" class="btn btn-lg" onclick="javascript: subscribe();" style="display: none;">Subscribe to
            updates
        </button>
        <p id="subThanks" class="" style="display: none;">
            Thanks for subscribing {{ Auth::user()->email }}! <small><a href="#" onclick="javascript: unsubscribe();">Unsubscribe?</a></small>
        </p>
        <a id="subLogin" class="btn btn-sm" href="{{ route("login") }}" style="display: none;">Login to enhance your
            experience</a>

        <p>
            <a href="https://twitter.com/vatsimctp" class="twitter-follow-button"
               data-show-count="false">Follow @vatsimctp</a>
            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </p>
    </div>
</div>

<!-- Subscribe Success -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="subscribeSuccessLabel"
     id="subscribeSuccess">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="subscribeFailureLabel">Thanks for subscribing!</h4>
            </div>
            <div class="modal-body" style="color: #000000;">
                <p style="color: #000000;">
                    Thank you for subscribing {{ Auth::user()->name_first }} - we will send email updates
                    to {{ Auth::user()->email }}.
                </p>
                <p style="color: #000000;">
                    Please remember that for the most up-to-date news, you should
                    <a href="https://twitter.com/vatsimctp" class="twitter-follow-button"
                       data-show-count="false">Follow @vatsimctp</a>
                    as email notifications can be slightly delayed.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Subscribe Failure -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="subscribeFailureLabel"
     id="subscribeFailure">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="subscribeFailureLabel">Unable to subscribe!</h4>
            </div>
            <div class="modal-body">
                <p style="color: #000000;">
                    Unfortunately there was an error subscribing you to our mailing list at this time!
                    Please try again later.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Unubscribe Success -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="unsubscribeSuccessLabel"
     id="unsubscribeSuccess">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="unsubscribeFailureLabel">We're sorry to lose you...</h4>
            </div>
            <div class="modal-body" style="color: #000000;">
                <p style="color: #000000;">
                    We've now unsubscribed {{ Auth::user()->email }} from our mailing list {{ Auth::user()->name_first }}.
                </p>
                <p style="color: #000000;">
                    Please remember that for the most up-to-date news, you should
                    <a href="https://twitter.com/vatsimctp" class="twitter-follow-button"
                       data-show-count="false">Follow @vatsimctp</a>.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Unubscribe Failure -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="unsubscribeFailureLabel"
     id="unsubscribeFailure">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="unsubscribeFailureLabel">Unable to unsubscribe!</h4>
            </div>
            <div class="modal-body">
                <p style="color: #000000;">
                    Unfortunately there was an error unsubscribing you from our mailing list at this time!
                    Please try again later.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    var is_auth = ("{{ Auth::check() }}" == "1");
    var is_sub = ("{{ Auth::user()->is_subscribed }}" == "1");

    function subscribe() {
        $.post("{{ route("account.subscribe") }}", function (data, status) {
            $('#subscribeSuccess').modal("show");
            is_sub = true;
            subscriberDisplay();
        }).fail(function () {
            $('#subscribeFailure').modal("show");
            is_sub = false;
            subscriberDisplay();
        });
    }

    function unsubscribe() {
        $.post("{{ route("account.unsubscribe") }}", function (data, status) {
            $('#unsubscribeSuccess').modal("show");
            is_sub = false;
            subscriberDisplay();
        }).fail(function () {
            $('#unsubscribeFailure').modal("show");
            is_sub = false;
            subscriberDisplay();
        });
    }

    function subscriberDisplay() {
        if (is_auth && is_sub == false) {
            $("#subBtn").show();
            $("#subThanks").hide();
            $("#subLogin").hide();
            return;
        }

        if (is_auth && is_sub) {
            $("#subBtn").hide();
            $("#subThanks").show();
            $("#subLogin").hide();
            return;
        }

        if (!is_auth) {
            $("#subBtn").hide();
            $("#subThanks").hide();
            $("#subLogin").show();
            return;
        }

        alert("Uh oh");
    }

    $(window).on('load', function () {
        subscriberDisplay();
    });
</script>