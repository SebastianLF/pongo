/**
 * Created by sebs on 11/09/2015.
 */

function selectUserTimezoneOnPageLoad(){
    $.getJSON( "timezone", function( data ) {
        $('#update-preferences').find('#timezone').val(data);
    });
}

$('#update-preferences').submit(function (){

});

selectUserTimezoneOnPageLoad();
