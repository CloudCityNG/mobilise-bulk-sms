$(function(){

//set SMS modal
var smsModal = UIkit.modal('#send-sms-modal');
var editModal = UIkit.modal('#edit-contact-modal');
var newModal = UIkit.modal('#new-contact-modal');
var newGroup = UIkit.modal('#new-group-modal');

//register modal closers when cancel button is clicked
registerCloseModal('#sendSmsModalCancel', smsModal);
registerCloseModal('#editContactCancel', editModal);
registerCloseModal('#newContactCancel', newModal);
registerCloseModal('#newGroupCancel', newGroup);

    var newContactModalErrorContainer = '#new-contact-modal .errors';
    var editContactModalErrorContainer = '#edit-contact-modal .errors';
    var sendSmsModalErrorContainer = '#send-sms-modal .errors';
    var newGroupModalErrorContainer = '#new-group-modal .errors';

    //method to save edited contact
    $('body').on('click', '#editContactSave', function(e){
        e.preventDefault();
        var $id = $('#edit-contact-modal').attr('data-id');

        var jqXHR = $.get("address-book/contact/" + $id + "/edit", $('form.modal-edit-contact').serialize());

        jqXHR.done(function(data){
            alert_("Contact Edited");
            $('#table-container').html(data.html);
            modalCloser(editModal);
            resetForm('form.modal-edit-contact');
            hideChildError(editContactModalErrorContainer);
        });

        jqXHR.fail(function(response){
            hideChildError(editContactModalErrorContainer);
            processFormError(response, editContactModalErrorContainer);
        });
    });

    //method to save new contact
    $('body').on('click', '#newContactSave', function(e){
        e.preventDefault();

        var jqXHR = $.get("address-book/new-contact", $('form.newContactForm').serialize())

        jqXHR.done(function(data){
            alert_("Contact Added.");
            $('#table-container').html(data.html);
            modalCloser(newModal);
            resetForm('form.newContactForm');
            hideChildError(newContactModalErrorContainer);
        });
        jqXHR.fail(function(response){

            processFormError(response, newContactModalErrorContainer);
        });
    })

    //method to send sms modal with msisdn
    $('#table-container').on('click', 'a#send', function(e){
        e.preventDefault();
        var modalDiv = $('#send-sms-modal');
        var modalMsisdn = $('#send-sms-modal #recipients');
        //search fro mobile number
        var $mobile = $(this).attr('data-send-msisdn');

        //set it on form
        modalMsisdn.val($mobile);

        if ( smsModal.isActive() ){
            smsModal.hide();
        } else {
            smsModal.show();
        }
    });

    //method to bring out edit modal with data
    $('#table-container').on('click', 'a#edit', function(e){
        e.preventDefault();

        var $this = $(this);
        var $id = $this.attr('data-edit-id');
        $('#edit-contact-modal').attr('data-id', $id);
        //fetch values over ajax
        var jqXHR = $.get('/address-book/contact/'+ $id + '/get');

        //get form values
        jqXHR.done( function(data){
            //hide existing form errors
            hideChildError(editContactModalErrorContainer);

            var values = data.values;
            //firstname
            $('#firstname').val(values.firstname);
            $('#lastname').val(values.lastname);
            $('#email').val(values.email);
            $('#gsm').val(values.gsm);

            //open modal
            editModal.show();
        });

        jqXHR.fail( function(data){
            handleError(data.status);
        });
    });

//method to delete
    $('#table-container').on('click', 'a#delete', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-delete-id');

        UIkit.modal.confirm("Are you sure you want to delete?", function() {

            var jqXHR = $.get('address-book/contact/' + $id + '/del');

            jqXHR.done(function () {
                $this.closest('tr').slideUp("slow", function () {
                    $(this).remove();
                });
            });

            jqXHR.fail(function (data) {
                handleError(data.status);
            });
        });

    });

});