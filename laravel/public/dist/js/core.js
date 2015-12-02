    
$(document).ready(function() {




    $.ajaxSetup({
        // Disable caching of AJAX responses
        cache: false,
        headers: { 'X-CSRF-TOKEN' : CSRF_TOKEN }
    });



});