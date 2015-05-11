/**
 * Created by sebs on 08/05/2015.
 */

$('#automaticform-add .methodeabcdcontainer').addClass("hide");
$('#automaticform-add #systemeABCD').click(function () {
    $('#automaticform-add .methodeabcdcontainer').removeClass("hide");
});
$('#automaticform-add #parislongterme ').click(function () {
    $('#automaticform-add .methodeabcdcontainer').addClass("hide");
    $('#automaticform-add #letterinputdashboard').empty();
    $('#automaticform-add #serieinputdashboard').val(null).trigger("change");
});
$('#automaticform-add #aucun').click(function () {
    $('#automaticform-add .methodeabcdcontainer').addClass("hide");
    $('#automaticform-add #letterinputdashboard').empty();
    $('#automaticform-add #serieinputdashboard').val(null).trigger("change");
});