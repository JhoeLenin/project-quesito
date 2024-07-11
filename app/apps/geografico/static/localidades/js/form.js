$(function () {
    $('.select2').select2({
        theme: "bootstrap4",
        language: 'es'
    })
    var select_provincias = $('select[name="provincia"]');
    $('select[name="pais"]').on('change', function () {
        var id = $(this).val();
        //console.log(id);
        var options = '<option value="">---------</option>';
        if (id === '') {
            select_provincias.html(options);
            return false;
        }
        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            data: {
                'action': 'search_provincia_id',
                'id': id
            },
            dataType: 'json',

        }).done(function (data) {
            if (!data.hasOwnProperty('error')) {
                select_provincias.html('').select2({
                    theme: "bootstrap4",
                    language: 'es',
                    data: data
                });
                return false;
            }
            message_error(data.error);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //alert(textStatus + ': ' + errorThrown);
        }).always(function (data) {
        });
    });

    select_provincias.on('change', function () {
        var value = $(this).val();
        //var value = select_provincias.select2('data')[0];
        console.log(value);
    });
});