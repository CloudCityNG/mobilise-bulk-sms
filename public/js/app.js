$(document).ready(function(){

window.Quic = window.Quic || {};

    Quic.countCharacters = function(el){
        var length = $(el).value.length;
        console.log(length);
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


    $('.ui.radio.checkbox').checkbox();

    //activate radio buttons and attach appropriate events to them.
    $('.ui.checkbox').checkbox({
        onChecked: function(){
            var $this = $(this);
            if ($this.val() == 1){
                //update select to show mobile number as readonly
                UserDetails.updateInputValue('#sender', UserDetails.phone);
            }else if ($this.val() == 2){
                //update input length not to take more than 11
                UserDetails.clearInputValue('#sender');
            } else if ($this.val() == 3){
                //update input length not to take more than 14 numbers
            }
        }
    });


    var selectBoxValue = function(value) {
        return $('#recipients').val(value);
    }

    var $contactMax = 50;

        //check recipients and limit to 50 comma separated values
    $('#recipients').on('keyup', function(e){

        $val = $(this).val();

        $(this).val ( $(this).val().replace(/[^\d,\s]/g,'') );

        $arrayNumbers = $val.split(',');

        $arrayNumbers = $arrayNumbers.removeSpace();
        $arrayNumbersLength = $arrayNumbers.length;

        if( $arrayNumbersLength > $contactMax )
        {
            $(this).val( recipientsCopy )
        } else {

        }

        recipientsCopy = $(this).val();

        $('#noOfRecipients').html($arrayNumbersLength + " / " + $contactMax.toString());

    });

    $('#message').keyup(function(){
        Quic.countCharacters(this)
    });

});