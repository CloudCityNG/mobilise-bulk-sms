$(function() {

    //set SMS modal
    var newGroup = UIkit.modal('#new-group-modal');

    //form class or id

    //register modal closers when cancel button is clicked
    registerCloseModal('#newGroupCancel', newGroup);

    //method to save new group
    $('body').on('click', '#newGroupSave', function(e){
        e.preventDefault()

        //disable the clicked button.

        //send the ajax request.
        var jqXHR = $.get("/address-book/new-group", $('form.newGroupForm').serialize());

        //process the success result.
        jqXHR.done(function(data){
            $('.table-container').html(data.html);
            alert_("Group Added.");
            modalCloser(newGroup);
            resetForm('form.newGroupForm');
            emptyErrorContainer('.errors');

        });

        //process the failure/error message.
        jqXHR.fail(function(data){
            if (data.status === 404){
                alert_("Server error: Not found")
            } else if (data.status === 401) {
                $(location).prop('pathname', 'user/login');
            } else if (data.status === 422) {
                var error = $.parseJSON(data.responseText);

                processAjaxError(error, '.errors', '.errors #error-ul');
            }
            if (data.status === 500){
                alert_("Unknown error. Please try later");
            }
        });
    });


});
