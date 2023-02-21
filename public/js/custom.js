//Flash message disappear
$(document).ready(function($){
    if('.fadeout-message'){
        setTimeout(function() {
            $('.mainAlert').slideUp(1200);
        }, 5000);
    }
});

/* Delete Confirm */
$(document).ready(function(){
    $(".delete, .confirm").on("click", null, function(){
        return confirm("Are you sure?");
    });
});

//bootstrap tables
$(function() {
    $('#table').bootstrapTable();
})
