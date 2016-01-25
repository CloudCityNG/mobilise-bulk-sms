$(window).load(function () {
    return $(".hero nav").addClass("animatable");
})

Array.prototype.clean = function() {
    var $length = this.length;
    for ( var i = 0; i < $length; i++ ) {
        if ( this[i] === undefined && this[i].trim() == null && this[i].trim() == "" ) {
            this.splice(i, 1);
        }
    }
    return this;
}

Array.prototype.removeSpace = function() {
    var $array = [];
    $.each(this, function(index, value){
        if ( value.trim() !== "" && value.trim() !== null && value !== 'undefined' )
            $array.push(value.replace(/\s+/g, ""));
    })
    return $array;
}

Array.prototype.makeString = function() {
    var $string = '';
    comma = ",";
    $.each(this, function(index, value){


        if ( index == 0 )
        {
            $string += value + comma ;
        } else {
            $string += value + comma;
        }

    })
    return $string;
}