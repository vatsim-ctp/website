window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');
require('bootstrap-select');

$( document ).ready(function() {
    $('.show-tooltip').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
