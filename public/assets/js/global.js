jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        $('#main-loader').show();
    },
    complete: function () {
        $('#main-loader').hide();
    },
    success: function () {
        $('#main-loader').hide();
    },
    error: function () {
        $('#main-loader').hide();
    }
});


/**
 * UIKit alert style
 * @param msg
 * @private
 */
function alert_(msg) {
    UIkit.notify(msg);
}


/**
 * UIKit Sticky alert
 * @param msg
 */
function alert_sticky(msg) {
    UIkit.notify(msg, {timeout: 0});
}

//register modal closer
function registerCloseModal($el, $modalEl) {
    $($el).bind("click", function (e) {
        e.preventDefault();
        if ($modalEl.isActive()) {
            $($el).attr('data-id', 0);
            $modalEl.hide();
        }
    });
}


//modalcloser
function modalCloser($modalEl) {
    if ($modalEl.isActive()) {
        $modalEl.hide();
    }
}


//reset form
function resetForm($formID) {
    $($formID)[0].reset();
}


/**
 * Empty the error parent container
 * parent<div>
 *     child <ul> run empty on the parent so the child gets emptied.
 * @param $el
 */
function emptyErrorContainer($el) {
    $($el).empty();
}

/**
 * Empty hide the child error container
 * @param $el
 */
function hideChildError(parentContainer) {
    var parent = parentContainer;
    $(parent).hide();
}


/**
 * Simulate a kind of event on an element
 * @param $event
 * @param eventElement
 */
function simulateEvent($event, eventElement) {
    $(eventElement).trigger($event);
}


function disableInput(element) {
    $(element).prop("disabled", true);
}


function enableInput(element) {
    if ($(element).prop('disabled')) {
        $(element).prop("disabled", false);
    }
}


function showElement(el) {
    $(el).fadeIn('slow').show();
}

function hideElement(el) {
    $(el).fadeOut('slow').hide();
}


function checkScheduleControl() {
    if ($('#schedule_control').prop("checked")) {
        showElement('#schedule-div');
        enableInput('#schedule');
    } else {
        hideElement('#schedule-div');
        disableInput('#schedule');
    }
}


function processAjaxError(dataError, errorParentContainer, errorMainContainer) {//'.errors', '.errors #error-ul'

    $(errorMainContainer).empty();//'.errors #error-ul'
    $(errorParentContainer).show();//'.errors'

    $.each(dataError, function (idx, el) {
        //el is an array. run through it
        $.each(el, function (idx1, el1) {
            //try to split the errors response with a comma
            var out = el1.split(",");

            //if an array is returned, then there is more than one error for the index. spit all out
            //if ( $.isArray(out) ) {

            $.each(out, function (index, element) {
                $(errorMainContainer).append(
                    "<li>" + element + "</li>"
                );
            });
        });
    });
    //return false;
}


function processError2(response, errorParentContainer) {
    if (response.status === 404) {
        alert_("Server error: Not found")
    } else if (response.status === 401) {
        $(location).prop('pathname', 'user/login');
    } else if (response.status === 422) {
        var error = $.parseJSON(response.responseText);

        processAjaxError(error, errorParentContainer, errorParentContainer + ' ul#error-ul');
    }
    if (response.status === 500) {
        alert_("Unknown error. Please try later");
    }
}


function processError(response) {
    if (response.status === 404) {
        alert_("Server error: Not found")
    } else if (response.status === 401) {
        $(location).prop('pathname', 'user/login');
    } else if (response.status === 422) {
        var error = $.parseJSON(response.responseText);

        processAjaxError(error, '.errors', '.errors #error-ul');
    }
    if (response.status === 500) {
        alert_("Unknown error. Please try later");
    }
}

function handleError(status) {
    if (status === 404) {
        alert_("Server error: Not found");
        return false;
    }
    else if (status === 401) {
        $(location).prop('pathname', 'user/login');
        return false;
    }
    else if (status === 422) {
        alert_("Operation failed");
        return false;
    }

    if (status === 500) {
        alert_("Unknown error. Please try later");
        return false;
    }
}

// '#new-contact-modal div.error'
// '#new-contact-modal div.error ul#error-ul'

function processFormError(response, parentContainer)
{
    if ( response.status === 404 )
    {
        alert_("Server error: Not found");
    }
    else if ( response.status === 401 )
    {
        $(location).prop('pathname', 'user/login');
    }
    else if ( response.status === 422 )
    {
        var error = $.parseJSON(response.responseText);
        var parent = parentContainer;
        var child = parent + ' ul#error-ul';
        processAjaxError(error, parent, child);
    }
    if ( response.status === 500 )
    {
        alert_("Unknown error. Please try later");
    }
}