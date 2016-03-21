$(document).ready(function(){

window.Quic = window.Quic || {};

    //show an element
    Quic.showElement = function(el){
        $(el).fadeIn('slow').show();
    }

    //hide an element
    Quic.hideElement = function(el){
        $(el).fadeOut('slow').hide();
    }


    window.UserDetails = window.UserDetails || {};
//@TODO
//send in this detail from the $currentUser->userdetails->phone
    UserDetails.phone = "08038154606";

    UserDetails.updateInputValue = function($el, $value)
    {
        return $($el).val($value);
    }

    UserDetails.clearInputValue = function($el)
    {
        return $($el).val('');
    }




    $('.ui.radio.checkbox.box2').checkbox({
        onChecked: function(){
            $('#sender').prop('maxlength', 11);
        },
        onUnchecked: function(){}
    });

    $('.ui.radio.checkbox.box3').checkbox({
        onChecked: function(){
            $('#sender').prop('maxlength', 14);
        },
        onUnchecked: function(){}
    });

    $('.ui.radio.checkbox.box2').trigger("click");
    $('#sender_type2').trigger('click');


    /**
     * RECIPIENTS
     * @type {number}
     */
    var $contactMax = 1000;
        //check recipients and limit to 50 comma separated values
    $('#recipients').on('keyup blur keydown focus', function(e){

        if ( true )
        {
            $(this).val ( $(this).val().replace(/[^\d(,)]/g,'') );
            $val = $(this).val().trim();

            //split textarea input with comma
            $arrayNumbers = $val.split(',');
            if ( $arrayNumbers.length > 50 ) {
                $(this).val ( recipientsCopy );
                return;
            }

            //internal length
            $length = 0;
            $.each($arrayNumbers, function(index, value){
                if ( value ){
                    $length++;
                }
            });
            recipientsCopy = $(this).val();
            $globalLength = $length;
            $('#noOfRecipients').html($length + '/' + $contactMax);
        }
    });


    /**
     * MESSAGE
     */
    $('#message').simplyCountable({
        counter: '#counter',
        countType: 'characters',
        maxCount: 320,
        countDirection: 'up',
        strictMax: true,
        pageCountId: '#pages',
        pageCount1: 160,
        pageCount2: 320,
        onCount: function(count, countable, counter){
            if ( count == 0 ){
                $('#pages').html('0');
            }
            else if ( count > 0 && count <= 160 ){
                $('#pages').html('1 page');
            } else if (count > 160 && count <= 320){
                $('#pages').html('2 pages');
            }
        }
    });


    /**
     * SCHEDULE
     */
    $("#schedule").kendoDateTimePicker({
        value: new Date(),
        min: new Date(),
        format: "yyyy-MM-dd HH:mm"
    });

    var datetimepicker = $("#schedule").data("kendoDateTimePicker");
    Quic.hideElement('#schedule-div');
    datetimepicker.enable(false);

    $('.ui.checkbox.scheduleControl').checkbox({
        onChecked: function(){
                Quic.showElement('#schedule-div');
                datetimepicker.enable(true);
        },
        onUnchecked: function(){
            //disable kendoui datetime select
            Quic.hideElement('#schedule-div');
            datetimepicker.enable(false);
        }
    });

    /**
     * DRAFT
     */
    $('.ui.checkbox.flash').checkbox();



});