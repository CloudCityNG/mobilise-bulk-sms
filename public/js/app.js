var upload = new Dropzone("div#contactsUpload", {url: "/a/contacts-upload"});
var vm = new Vue({
    el: '#app',
    data: {
        message: '',
        recipients: '',
        sender: '',
        messageCounter: 0,
        recipientCounter: 0,
        displayMessage: '',
    },

    methods: {
        countCharacters: function () {
            var message = this.message
            this.displayMessage = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
            this.messageCounter = this.message.length;
        },
    },

    ready: function () {

        var form = $('form#quick-sms');

        $('button#draft').click(function () {
            form.prop('action', '/messaging/draft-sms');
            form.submit();
        });

        $('button#send').click(function () {
            form.prop('action', '/messaging/quick-sms');
            form.submit();
        });


        $('.ui.radio.checkbox.box2').checkbox({
            onChecked: function () {
                var $sender = $("#sender");
                var $length = $sender.val().length;
                $sender.prop('maxlength', 11);
                //if value is greater than 11 chop it.
                if ( $length > 11 ){
//                    var $j = $sender.val().substring(0, 11);
                    $sender.val( chop($sender.val(), 11) );
                }
            },
            onUnchecked: function () {
            }
        });

        $('.ui.radio.checkbox.box3').checkbox({
            onChecked: function () {
                $('#sender').prop('maxlength', 14);
            },
            onUnchecked: function () {
            }
        });

        $('.ui.radio.checkbox.box2').trigger("click");
        $('#sender_type2').trigger('click');

        //initialize checkbox for flash message
        $('.ui.checkbox.flash').checkbox();

        $('.menu .item').tab();

        function chop($val, $chopLength){
            return $val.substring(0, $chopLength);
        }
    }
});