$(function() {

    //set SMS modal
    var newGroup = UIkit.modal('#new-group-modal');                             //new group modal
    var showGroupContacts = UIkit.modal('#show-group-contacts-modal');          //show group contacts modal
    var addContact = UIkit.modal('#new-contact-modal');
    var uploadContacts;

    //form class or id

    //register modal closers when cancel button is clicked
    registerCloseModal('#newGroupCancel', newGroup);
    registerCloseModal('#showGroupContactsOkButton', showGroupContacts);
    registerCloseModal('#newContactCancel', addContact);

    $('body').on('click', '#newContactSave', function(e){
        e.preventDefault();
        var $this = $(this);
        var $group_id = $('#new-contact-modal').attr('data-id')

        var jqXHR = $.get('/address-book/group/'+ $group_id +'/new-contact', $('form.newContactForm').serialize())

        jqXHR.done(function(data){
            alert_("Contact Added.");
            $('#table-container').html(data.html);
            modalCloser(addContact);
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

    $('body').on('click', 'a#add', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-add-id');

        //set the modal data-id to $id
        $('#new-contact-modal').attr('data-id', $id);
        //pop the modal up
        addContact.show();
    });

    /**
     * View group contacts
     */
    $('body').on('click', 'a#view', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-view-id');
        var $count = $this.closest('tr').find('td#count').attr('data-count');

        if ( $count == 0 ) {
            alert_("No contact yet");
            return false;
        }

        var jqXHR = $.get("/address-book/group/"+ $id + '/view-contacts');

        jqXHR.done(function(data){
            //get data from response
            var res = data.out;
            //put data in DOM
            $('#show-group-contacts-modal #result-container').html( res );
            //pop up modal
            showGroupContacts.show();
        });
        jqXHR.fail(function(data){
            handleError(data.status);
        });
    });

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

    //delete group
    $('body').on('click', 'a#delete', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-delete-id');

        UIkit.modal.confirm("Are you sure you want to delete?", function(){
            //send ajax to delete group and corresponding contacts
            var jqXHR = $.get('/address-book/group/'+ $id +'/del');

            jqXHR.done(function(data){
                $this.closest('tr').slideUp("slow", function(){
                    $(this).remove();
                });
            });
            jqXHR.fail( function(data){
                handleError(data.status);
            } );
        });
    });


});
