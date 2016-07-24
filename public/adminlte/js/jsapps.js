jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        ajaxindicatorstart("loading...")
    },
    complete: function () {
        ajaxindicatorstop();
    },
    success: function () {
        ajaxindicatorstop();
    },
    error: function () {
        ajaxindicatorstop();
    }
});
var upload = new Dropzone("div#contactsUpload", {url: "/a/contacts-upload"});

var vm = new Vue({
    el: '#app',
    data: {
        sender: '',
        recipients: '',
        message: '',
        schedule: '',
        date: '',
        time: '',
        flash: 0,
        recipientsCounter: 0,
        messageCounter: 0,
        messagePreview: '',
        numberOfMessages: 0,
        totalSms: 0,
        totalUnits: 0,
        modalTableBody: '',
    },

    methods: {
        countRecipients: function(){
            var arrayOfRecipients = this.recipients.split(",");
            var arrayOfRecipients = arrayOfRecipients.filter(function(str){
                if ( str.trim() == "" ){
                    return false;
                }
                return true;
            });
            this.recipientsCounter = arrayOfRecipients.length;
        },
        countMessageCharacters: function () {
            var message = this.message;
            this.messagePreview = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
            this.messageCounter = this.message.length;
        }
    },
    /** READY FUNCTION **/
    ready: function () {
        this.countMessageCharacters();

        var $this = this;
        var form = $("form#quick-sms");

        //Click preview button
        $("button#preview").click(function (e) {
            e.preventDefault();
            var $recipients = $this.recipients;
            var $message = $this.message;

            if ($recipients == "")
                return;

            var jqXHR = $.post('/a/confirm-job', {recipients: $recipients, message: $message, sender: $this.sender});

            jqXHR.done(function (data) {
                clearModalValues();
                populateModal(data);
                showModal();
                //process data
                //show modal
                //console.log(data);
            });

            jqXHR.fail(function (data) {
                if (data.status == 422){
                    //form validation error
                    return;
                }

                if (data.status == 401 ){
                    //unauthorized, redirect to login
                    return;
                }
                //403 forbidden
                //404 not found
                //405 method not allowed
                //408 request timed out

                console.log(data.status);


            });
        });
        /** FUNCTION TO HANDLE RETURN DATA **/
        function populateModal(data) {
            var dataSet = data.out;
            var out = '';
            $this.numberOfMessages = data.others.sms_count;
            $.each(dataSet, function (index, value) {
                var $total_sms = data.others.sms_count * value.total_recipients;
                $this.totalSms += $total_sms;
                $this.totalUnits += value.unit_per_sms * $total_sms;
                out += "<tr>"
                    +"<td>" + value.country + "</td>"
                    +"<td>" + value.network + "</td>"
                    +"<td>" + value.total_recipients + "</td>"
                    +"<td>" + value.unit_per_sms +"</td>"
                    +"<td>" + $total_sms +"</td></tr>";
                $this.modalTableBody = out;
                $('#myModal tbody#update').html( $this.modalTableBody );
            });
        }

        function showModal()
        {
            $('#myModal').modal('show');
        }

        function hideModal()
        {
            $('#myModal').modal('hide');
        }

        /** CLEAR MODAL VALUES **/
        function clearModalValues() {
            $this.numberOfMessages = 0;
            $this.totalSms = 0;
            $this.totalUnits = 0;
            $this.modalTableBody = '';
            $('#myModal tbody#update').html( $this.modalTableBody );
        }

        $("button#send").click(function(e){
            form.prop('action', '/messaging/send-sms');
            form.submit();
        });

        $("button#draft").click(function (e) {
            form.prop('action', '/messaging/draft-sms');
            form.submit();
        });

        $("button#cancel").click(function (e) {

            if (confirm("Sure you want to cancel?")) {
                window.location = '/dashboard';
            }
        });

        var myDate = new Date();
        var month = myDate.getMonth() + 1;
        var today = myDate.getFullYear() + '-' + month + '-' + myDate.getDate();
        $('#date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            //startDate: today,
            todayHighlight: true
        });

        $("#time").timepicker();
        $('#timezone').select2();
    }
});


function ajaxindicatorstart(text) {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="/img/mm-spinner.gif"><div>' + text + '</div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}