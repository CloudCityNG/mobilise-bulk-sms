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

//method to save new contact
    $('body').on('click', '#newContactSave', function(e){
        e.preventDefault();

        var jqXHR = $.get("address-book/new-contact", $('form.newContactForm').serialize())

        jqXHR.done(function(data){
            alert_("Contact Added.");
            $('#table-container').html(data.html);
            modalCloser(newModal);
            resetForm('form.newContactForm');
            emptyErrorContainer('.errors');

        });
        jqXHR.fail(function(data){

            if (data.status === 401 ){//user not authenticated.
                $(location).prop('pathname', 'user/login');
            }
            if (data.status === 422){

                var error = $.parseJSON(data.responseText);

                processAjaxError(error, '.errors', '.errors #error-ul');
                //emptyErrorContainer('.errors');
        }
            if (data.status === 500){
                alert_("Unknown error. Please try later");
            }
        });
    })

    $('#table-container').on('click', 'a#send', function(e){

        e.preventDefault();
        var modalDiv = $('#send-sms-modal');
        var modalMsisdn = $('#send-sms-modal #msisdn');
        //search fro mobile number
        var $mobile = $(this).parent().parent().parent().parent().parent().prev().html();

        //set it on form
        modalMsisdn.val($mobile);

        if ( smsModal.isActive() ){
            smsModal.hide();
        } else {
            smsModal.show();
        }
    })

    $('#table-container').on('click', 'a#edit', function(e){
        e.preventDefault();
        var $this = $(this)
        var $id = $this.attr('data-id-edit');
        //fetch values over ajax
        var jqXHR = $.get('address-book/contact/'+ $id + '/get');

        //get form values
        jqXHR.done( function(data){

            var values = data.values;
            //firstname
            $('#firstname').val()
            //lastname
            //email
            //gsm
            //birthdate
            console.log(values[0].gsm);
        });

        jqXHR.fail( function(data){
            handleError(data.status);
        });
    });


    $('#table-container').on('click', 'a#delete', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-id-delete');

        var jqXHR = $.get('address-book/contact/'+ $id +'/del');

        jqXHR.done( function(){
            $this.closest('tr').slideUp("slow", function(){
                $(this).remove();
            });
        } );

        jqXHR.fail( function(data){
            handleError(data.status);
        } );

    });

});