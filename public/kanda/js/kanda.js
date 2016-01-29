$(document).ready(function() {

    //initialize dropdwon on navbar
    $('.row .column .menu .dropdown')
        .dropdown({
            transition: 'drop',
            on: 'hover'
        });
    //initialize menu sidebar
    $('.ui.sidebar').sidebar('attach events', '.toc.item');

    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade');
    });


    $('.small.modal').modal('show');
    $('.ui.modal').modal('show');
});