/**
 * Created by seb on 12/07/2015.
 */


// fonction de calcul du profit dans le titre.
function totalProfits(){
    $.getJSON( "totalprofit", function(data) {

        var montant_profit = data.montantprofit;

        // how many decimal places allows
        var decimal_places = 2;
        var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);

        $('#overall-profit')
            .animateNumber(
            {
                number: montant_profit * decimal_factor,

                numberStep: function (now, tween) {
                    var floored_number = Math.floor(now) / decimal_factor,
                        target = $(tween.elem);

                    if (decimal_places > 0) {
                        // force decimal places even if they are 0
                        floored_number = floored_number.toFixed(decimal_places);

                        // replace '.' separator with ','
                        // floored_number = floored_number.toString().replace('.', ',');
                    }

                    target
                        .prop('number', now)
                        .text(parseFloat(floored_number));
                }
            },
            'normal',
            function () {
                if(montant_profit > 0){$('#overall-profit-sign').text('+'); $('#overall-profit-container').addClass('font-green-sharp').removeClass('red-lose');}
                else if(montant_profit < 0){$('#overall-profit-sign').text(''); $('#overall-profit-container').removeClass('font-green-sharp').addClass('red-lose');}
                else{$('#overall-profit-sign').text(''); $('#overall-profit-container').removeClass('font-green-sharp').removeClass('red-lose');}
            }
        );
    })
}