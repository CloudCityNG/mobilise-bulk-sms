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