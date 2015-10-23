//======================================================================================================================
// MODAL
//======================================================================================================================
var Modal = function start(id, type){
    this.id = '#' + id;
    this.name = UIkit.modal(this.id);
}

Modal.prototype.show = function() {
    if (!this.name.isActive()){
        this.name.show()
    }
}

Modal.prototype.hide = function() {
    if (this.name.isActive()){
        this.name.hide()
    }
}

Modal.prototype.isActive = function() {
    return this.name.isActive();
}

Modal.prototype.showId = function() {
    return this.id;
}

Modal.prototype.setErrorContainer = function(parent, child, parentType, childType) {

    var parent = typeof parentType === 'undefined' ? '#' + parent : '.' + parent;
    var child = typeof childType === 'undefined' ? '#' + child : '.' + child;


    this.errorContainer = $(parent + ' ' + child);
}


Modal.prototype.showErrorContainer = function(){
    return this.errorContainer;
}


//======================================================================================================================
// AJAX
//======================================================================================================================

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

//======================================================================================================================
// ALERT
//======================================================================================================================

var Alert = function(message, sticky){

    sticky = typeof sticky !== 'undefined' ? true : false;

    if (sticky === true) {
        return UIkit.notify(message, {timeout: 0});
    }

    return UIkit.notify(message);
}


//======================================================================================================================
// ERROR
//======================================================================================================================

var Error = function(parent, child, parentType, childType) {

    //if u supply nothing for parentType

    var parent = typeof parentType === 'undefined' ? '#' + parent : '.' + parent;
    var child = typeof childType === 'undefined' ? '#' + child : '.' + child;


    this.errorContainer = $(parent + ' ' + child);
}

//======================================================================================================================
// FORM
//======================================================================================================================

var Form = function(form, elementType){

    switch (true) {
        case elementType === 'id':
            this.form = $('#' + form);
            break;
        case elementType === 'class':
            this.form = $('.' + form);
            break;
        case elementType === 'undefined':
            this.form = $('#' + form);
            break;
    }
    this.formElements = [];

}


Form.prototype.setFormElement = function(elementId, elementValue){
    $('#' + elementId).val(elementValue);
}


Form.prototype.getFormElement = function(elementId){
    var val = $('#' + elementId).val();
    return val;
}

Form.prototype.serialize = function(){
    return this.form.serialize();
}


Form.prototype.reset = function(){
    this.form.find('input:text, input:password, input:file, select, textarea').val('');
    this.form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}