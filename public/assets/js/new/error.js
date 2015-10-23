var Error = function(parent, child, parentType, childType) {

    //if u supply nothing for parentType

    var parent = typeof parentType === 'undefined' ? '#' + parent : '.' + parent;
    var child = typeof childType === 'undefined' ? '#' + child : '.' + child;


    this.errorContainer = $(parent + ' ' + child);
}