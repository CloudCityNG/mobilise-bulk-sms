jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        $('#main-loader').show();
    },
    complete: function(){
        $('#main-loader').hide();
    },
    success: function() {
        $('#main-loader').hide();
    },
    error: function() {
        $('#main-loader').hide();
    }
});

function alert_(msg){
    UIkit.notify( msg );
}

function alert_sticky(msg){
    UIkit.notify(msg, {timeout: 0});
}

//register modal closer
function registerCloseModal($el, $modalEl){
    $($el).bind("click", function(e){
        if ($modalEl.isActive()) {
            $modalEl.hide();
        }
    });
}

//modalcloser
function modalCloser($modalEl){
    if ($modalEl.isActive()) {
        $modalEl.hide();
    }
}

//reset form
function resetForm($formID){
    $($formID)[0].reset();
}

function emptyErrorContainer($el)
{
    $($el).empty();
}

function processAjaxError(dataError, errorParentContainer, errorMainContainer){//'.errors', '.errors #error-ul'

    $(errorMainContainer).empty();//'.errors #error-ul'
    $(errorParentContainer).show();//'.errors'

    $.each(dataError, function(idx, el){
        //el is an array. run through it
        $.each(el, function(idx1, el1){
            //try to split the errors response with a comma
            var out = el1.split(",");

            //if an array is returned, then there is more than one error for the index. spit all out
            //if ( $.isArray(out) ) {

            $.each(out, function(index, element){
                $(errorMainContainer).append(
                    "<li>" + element + "</li>"
                );
            });
            //                } else {
            //                //else its just one error returned for the associated index. show it
            //                    $('.errors #error-ul').append(
            //                        "<li>" + el + "</li>"
            //                    );
            //
            //                }
        });
    });

}