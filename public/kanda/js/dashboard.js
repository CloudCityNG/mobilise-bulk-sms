$(document).ready(function(){


    $("#dashboard").on("click", "div.center",  function(e){
        e.preventDefault();
        window.location.href = $(this).data("url");
    });

});