function tipsterUpdate() {
    $('#tipsterform-edit').submit(function (e) {
        e.preventDefault();
        var id = $(this).find("#idTipsterEditInput").val();
        var data = $(this).serialize();
        $.ajax({
            url: 'tipster/'+id,
            method: 'PUT',
            data: data,
            dataType: 'json',
            success: function (json) {
                if (json.success) {
                    loadTipstersWithPage();
                    $('#nameTipsterEditSmall').text('');
                    $('#indiceTipsterEditSmall').text('');
                    $('#mtTipsterEditSmall').text('');
                    $('#suiviTipsterEditSmall').text('');
                    toastr.success(json.tipster.name + ' a été modifié avec <strong>succès</strong>!', 'Tipster');
                    $('#tipsterEditModal').modal('hide');

                } else {
                    if (json.errors.nameTipsterEditInput) {
                        $('#nameTipsterEditSmall').text(json.errors.nameTipsterEditInput);
                    } else {
                        $('#nameTipsterEditSmall').text('');
                    }

                    if (json.errors.indiceTipsterEditSelect) {
                        $('#indiceTipsterEditSmall').text(json.errors.indiceTipsterEditSelect);
                    } else {
                        $('#indiceTipsterEditSmall').text('');
                    }

                    if (json.errors.mtTipsterEditInput) {
                        $('#mtTipsterEditSmall').text(json.errors.mtTipsterEditInput);
                    } else {
                        $('#mtTipsterEditSmall').text('');
                    }

                    if (json.errors.suiviTipsterEditSelect) {
                        $('#suiviTipsterEditSmall').text(json.errors.suiviTipsterEditSelect);
                    } else {
                        $('#suiviTipsterEditSmall').text('');
                    }

                    toastr.error('Remplissez les <strong>champs</strong> correctement!', 'Tipster');
                }
            },
            fail: function (json) {
                console.log('fail !');
            }
        });
    });

}