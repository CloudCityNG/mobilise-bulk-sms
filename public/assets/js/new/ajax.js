var Ajax = function(url, formElements){
    this.formElements = typeof formElements === 'undefined' ? null : formElements ;
    this.url = url;


}

Ajax.prototype.call = function(){
    if (this.formElements === null){
        this.jqXHR = $.get(this.url);
    } else {
        this.jqXHR = $.get(this.url, this.formElements);
    }

}

Ajax.prototype.handleError = function(callback)
{
    this.jqXHR.fail(callback);
}


Ajax.prototype.handleSuccess = function(callback)
{
    this.jqXHR.done(callback);
}


//var ajax = new Ajax();
//ajax.url('/user/profile');
//ajax.formElements(form.serialize());