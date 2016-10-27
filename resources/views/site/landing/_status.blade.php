<div class="status-content">
    <h3 class="status" id="statusMsg">Please wait...</h3>
</div>

<script>
    var status_message = "#statusMsg";
    var voting_timestamp_diff_in_seconds = null;

    function updateStatus() {
        $.get("{{ route("api.status") }}", function (data, status) {
            switch (data.status) {
                case "voting":
                    redirectToVotingPage();
                    setTimeout(updateStatus, 5000);
                    break;

                case "awaiting_vote":
                    voting_timestamp_diff_in_seconds = (data.timestamp_diff) * -1;
                    setTimeout(updateStatus, 7000);
                    break;

                default:
                    $(status_message).html(data.verbose);
                    setTimeout(updateStatus, 5000);
                    break;
            }
        });
    }

    function votingCountdown() {
        if (voting_timestamp_diff_in_seconds == null) {
            return;
        }

        if (voting_timestamp_diff_in_seconds < 0) {
            return redirectToVotingPage();
        }

        if(voting_timestamp_diff_in_seconds < 10){
            $(status_message).html("Voting opens soon - do not refresh!");
            return;
        }

        var tmp_seconds = voting_timestamp_diff_in_seconds;

        var days = Math.floor(tmp_seconds / 86400);
        tmp_seconds -= days * 86400;

        var hours = Math.floor(tmp_seconds / 3600);
        tmp_seconds -= hours * 3600;

        var minutes = Math.floor(tmp_seconds / 60);
        tmp_seconds -= minutes * 60;

        var seconds = tmp_seconds;

        msg = "Voting opens in ";
        msg += days > 0 ? days + " " + (days > 0 ? "days" : "day") + ", " : "";
        msg += hours > 0 ? hours + " " + (hours > 0 ? "hours" : "hour") + ", " : "";
        msg += minutes > 0 ? minutes + " " + (minutes > 0 ? "minutes" : "minute") + ", " : "";
        msg += seconds > 0 ? seconds + " " + (seconds > 0 ? "seconds" : "second") + "" : "";
        msg += "."; // Grammar must be on point!

        msg = $.trim(msg);
        msg = msg.replace(/,+$/g, '');

        $(status_message).html(msg);

        voting_timestamp_diff_in_seconds--;
    }

    function redirectToVotingPage() {
        window.location.replace("{{ route("voting.list") }}");
    }

    $(window).on('load', function () {
        updateStatus();
        setInterval(votingCountdown, 1000);
    });
</script>