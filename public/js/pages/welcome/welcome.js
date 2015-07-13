/**
 * Created by seb on 12/07/2015.
 */



var data_devise = [{id: 0, text: 'US Dollar'}, {id: 2, text: 'Euro'}, {id: 3, text: 'British Po'}];

$('#form-devise select[name="devise"]').select2({
    minimumResultsForSearch: Infinity,
    placeholder: "Choisir une devise",
    cache: true,
    data: data_devise
});
