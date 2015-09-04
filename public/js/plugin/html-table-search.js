/**
 **options to have following keys:
 **searchText: this should hold the value of search text
 **searchPlaceHolder: this should hold the value of search input box placeholder
 **/


(function($){
    $.fn.tableSearch = function(options){
        if(!$(this).is('table')){
            return;
        }
        var tableObj = $(this),
            inputObj = $('#paris-termine-search-input'),
            caseSensitive = (options.caseSensitive===true)?true:false,
            searchFieldVal = '',
            pattern = '';
        inputObj.off('keyup').on('keyup', function(){
            searchFieldVal = $(this).val();
            pattern = (caseSensitive)?RegExp(searchFieldVal):RegExp(searchFieldVal, 'i');
            tableObj.find('tbody tr').hide().each(function(){
                var currentRow = $(this);
                if(currentRow.next('tr').hasClass('subrow')) {
                    currentRow.next('tr').show();
                    currentRow.next('tr').find('thead tr').show();
                    currentRow.next('tr').find('tbody tr').each(function () {
                        $(this).css('display', 'table-row');
                    });
                }
                currentRow.find('td').each(function(){
                    if(pattern.test($(this).html())){
                        currentRow.show();
                        return false;
                    }
                });
            });
        });

        return tableObj;
    }
}(jQuery));