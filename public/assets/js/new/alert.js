var Alert = function(message, sticky){

    sticky = typeof sticky !== 'undefined' ? true : false;

    if (sticky === true) {
        return UIkit.notify(message, {timeout: 0});
    }

    return UIkit.notify(message);
}