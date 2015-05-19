function manualBetForm() {
    var form = $('#manubetform-add');
    var form_string = '#manubetform-add';

    form.find('#tipstersinputdashboard').select2({
        allowClear: true,
        placeholder: "Choisir un tipster",
        cache: true,
        ajax: {
            url: 'tipsters',
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });

    form.find('#tipstersinputdashboard').change(function () {
        var tipster_id = $(form_string + ' #tipstersinputdashboard').val();
        var followtype = $(form_string + ' #followtypeinputdashboard');
        var montant_par_unite = $(form_string + ' #amountperunit');

        // remise a zero des champs liés.
        $(form_string + ' #stakeunitinputdashboard').val('');
        $(form_string + ' #amountperunit').val('');
        $(form_string + ' #amountconversion').val('0');
        $(form_string + ' #amountinputdashboard').val('');
        $(form_string + ' #flattounitconversion').val('0');
        $.ajax({
            url: 'infosTipster',
            data: 'tipster_id=' + tipster_id,
            dataType: 'json',
            success: function (data) {
                form.find('#bookinputdashboard').val(null).trigger("change");
                form.find('#accountsinputdashboard').val(null).trigger("change");
                followtype.val('');
                if (data.followtype == 'n') {
                    followtype.val('normal');
                    form.find("#bookinputdashboard").prop("disabled", false);
                    form.find("#accountsinputdashboard").prop("disabled", false);
                } else if (data.followtype == 'b') {
                    followtype.val('à blanc');
                    form.find("#bookinputdashboard").prop("disabled", true);
                    form.find("#accountsinputdashboard").prop("disabled", true);
                }
                var mt = Number(data.montant_par_unite);
                isNaN(mt) ?  montant_par_unite.val('') : montant_par_unite.val(mt);
            },
            error: function (data) {
            }
        });
    });

    form.find('#bookinputdashboard').select2({
        allowClear: true,
        placeholder: "Choisir un bookmaker",
        cache: true,
        ajax: {
            url: 'bookmakers',
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                /* var newData = [];
                 $.each(data, function (index,value) {
                 newData.push({
                 id:value.id,  //id part present in data
                 text: value.text  //string to be displayed
                 });
                 });*/
                return {
                    results: data
                };
            }
        }
    });

    form.find('#accountsinputdashboard').select2({
        allowClear: true,
        placeholder: "Choisir un compte",
        cache: true,
        minimumResultsForSearch: Infinity,
        ajax: {
            url: 'accounts',
            dataType: 'json',
            data: function (params) {
                return {
                    book_id: $(form_string + ' #bookinputdashboard').val(),
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                /* var newData = [];
                 $.each(data, function (index,value) {
                 newData.push({
                 id:value.id,  //id part present in data
                 text: value.text  //string to be displayed
                 });
                 });*/
                return {
                    results: data
                };
            }
        }
    });

    // chargements des paris abcd dans le select input.
    form.find('#serieinputdashboard').select2({
        allowClear: true,
        placeholder: "Choisir une serie",
        tags: true,
        cache: true,
        ajax: {
            url: 'parisabcd',
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                /* var newData = [];
                 $.each(data, function (index,value) {
                 newData.push({
                 id:value.id,  //id part present in data
                 text: value.text  //string to be displayed
                 });
                 });*/
                return {
                    results: data
                };
            }
        }
    });

    form.find('#letterinputdashboard').select2({
        allowClear: true,
        placeholder: "Choisir une lettre",
        cache: true,
        minimumResultsForSearch: Infinity,
        ajax: {
            url: 'lettreabcd',
            dataType: 'json',
            data: function (params) {
                return {
                    serie_nom: $(form_string + ' #serieinputdashboard').val(),
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                console.log(data);
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                var newData = [];
                $.each(data, function (index, value) {
                    newData.push({
                        id: value,  //id part present in data
                        text: value  //string to be displayed
                    });
                });
                return {
                    results: newData
                };
            }
        }
    });

    form.find("#serieinputdashboard").change(function () {
        var nom = $(form_string + "#serieinputdashboard option:selected").text();
        nom = encodeURIComponent(nom);
        form.find("#letterinputdashboard").val(null).trigger("change");
    });

    form.find('#stakeunitinputdashboard').keyup(function () {
        var montant_par_unite = $(form_string + ' #amountperunit').val();
        var unites = Number($(form_string + ' #stakeunitinputdashboard').val());
        var res = Number(montant_par_unite) * Number(unites);
        var res_final = Math.round(res * 100) / 100;
        isNaN(res_final) || res_final < 0 ? $(form_string + '#amountconversion').val('0') : $(form_string + ' #amountconversion').val(res_final);
    });

    form.find('#amountinputdashboard').keyup(function () {
        var montant_par_unite = $(form_string + ' #amountperunit').val();
        var montant = $(form_string + ' #amountinputdashboard').val();
        var res = Number(montant) / Number(montant_par_unite);
        var res_final = Math.round(res * 100) / 100;
        isNaN(res_final) || res_final < 0 || montant_par_unite == '' ? $(form_string + ' #flattounitconversion').val('0') : $(form_string + ' #flattounitconversion').val(res_final);
    });


}