window.loader = null;

jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        //$('#main-loader').show();
        window.loader = $('#request-loading');
        window.loader.show();
    },
    complete: function () {
        //$('#main-loader').hide();
        window.loader.hide();
    },
    success: function () {
        //$('#main-loader').hide();
        window.loader.hide();
    },
    error: function () {
        //$('#main-loader').hide();
        window.loader.hide();
    }
});