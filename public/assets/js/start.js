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

//$('#newContactSave').bind("click", function(e){
//    e.preventDefault();
//    $('#loading').show();
//
//    var jqXHR = $.get("address-book/new-contact", $('form.newContactForm').serialize())
//    jqXHR.done(function(data){
//        alert_("Contact Added.");
//        modalCloser(newModal);
//        resetForm('form.newContactForm');
//        $('#table-container').html(data.html);
//        $('#loading').hide();
//    });
//    jqXHR.fail(function(data){
//        $('#loading').hide();
//
//        if (data.status === 401 ){//user not authenticated.
//            $(location).prop('pathname', 'user/login');
//        }
//        if (data.status === 422){
//
//            var error = $.parseJSON(data.responseText);
//
//            processAjaxError(error, '.errors', '.errors #error-ul');
////            $('.errors #error-ul').empty();
////            $('.errors').show();
//        }
//        if (data.status === 500){
//            alert_("Unknown error. Please try later");
//        }
//    });
//
//});
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
        //get form values
        var $el = $this.closest('td').prev()[0]
        var gsm = $($el).html()
        var $id = $this.prop('class');
        $id = $id.split("-")

        console.log( $id[1] )
    });


$('table a#delete').bind('click', function(e){
    e.preventDefault();
    alert_( $(this).prop('class') );
});

});