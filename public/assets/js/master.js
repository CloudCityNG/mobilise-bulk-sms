//@require UIkit.js, UIkit.notify
var QUIC = QUIC || {};

QUIC.ajax = {

    result: null,

    send: function(url, form_fields){

        if ( typeof form_fields === 'undefined'){
            this.result = $.get(url)
        } else {
            this.result = $.get(url, form_fields);
        }
    },


    done: function(callback){
        this.result.done(callback);
    },


    fail: function(){
        this.result.fail(callback);
    }

}



QUIC.jqXHR = {
    jqXHR: '',
    send: function(){
        return $.get('/user/profile-get');
    }
}

QUIC.profile = {

    username: null,
    email: null,
    firstname: null,
    lastname: null,
    phone: null,
    dob: null,
    url: '/user/profile-get',
    result: null,

    init: function(){
        QUIC.ajax.send(this.url);
        QUIC.ajax.done(this.success);
    },


    success: function(data){
        console.log(data.out.firstname);
        if ( data.success ){
            this.firstname = data.out.firstname;
            this.lastname = data.out.lastname
        }
    },

    console_log: function(data){
        console.log(data);
    }
}



QUIC.modal = {

    _name: '',

    _id: '',

    data_id: function(){
        return $(this._id).data('id');
    },

    is_open: function(){
        return this._name.isActive();
    },

    make_id: function (id) {
        return '#' + id;
    },
    make_class: function (_class) {
        return '.' + _class;
    },

    init: function (id) {
        this._id = this.make_id(id);
        this._name = UIkit.modal(this._id);

        //register modal
        $(id).bind('click', function (e) {
            e.preventDefault();
        })
    },

    open: function () {
        if ( ! this.is_open() ){
            this._name.show();
        }
    },

    close: function () {
        if ( this.is_open() ){
            this._name.hide();
        }
        $(this._id).data('id', '0');
    }


}


QUIC.reset_form = function (form_id) {
    $('#' + form_id)[0].reset();
}


QUIC.alert = function (message, sticky) {

    sticky = typeof sticky !== 'undefined' ? true : false;

    if (sticky === true) {
        return UIkit.notify(message, {timeout: 0});
    }

    return UIkit.notify(message);
}