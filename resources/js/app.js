require('./bootstrap');

$( document ).ready(function() {
    $( "[data-api-import='']" ).click(function() {
        $( "[data-api-import-loading='']" ).show();
    });
});
