$(function () {
    $.ajaxSetup({
        data: {
            'YII_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.digitFormat').digitFormat();
    $('.numberFormat').numericFormat();

    $("body").on("keyup", '.digitFormat', function () {
        $(this).digitFormat();
    }).on("change", '.digitFormat', function () {
        $(this).digitFormat();
    }).on("keyup", '.numberFormat', function () {
        $(this).numericFormat();
    }).on("change", '.numberFormat', function () {
        $(this).numericFormat();
    });

    if ($('.select-picker').length && $.fn.selectpicker)
        $('.select-picker').selectpicker({
            dropupAuto: false,
            size: 7
        });

    setInterval(function () {
        $(".callout:not(.message)").fadeOut('fast', function () {
            $(this).remove();
        });
    },5000);
});

$.fn.digitFormat = function () {
    return this.each(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        $(this).val(function (index, value) {
            if (parseInt(value) === 0)
                return value;
            else if (value.indexOf(".") >=0) {
                return value;
                var arr = value.split('.');
                console.log(arr);
                value = arr[0]
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"."+arr[1];
                return value;
            }
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
};

$.fn.numericFormat = function () {
    return this.each(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "");
        });
    });
};

function submitAjaxForm(form ,url ,loading ,callback) {
    loading = typeof loading !== 'undefined' ? loading : null;
    callback = typeof callback !== 'undefined' ? callback : null;
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        dataType: "json",
        beforeSend: function () {
            if(loading)
                loading.show();
        },
        success: function (html) {
            if(loading)
                loading.hide();
            if (typeof html === "object" && typeof html.status === 'undefined') {
                $.each(html, function (key, value) {
                    $("#" + key + "_em_").show().html(value.toString()).parent().removeClass('success').addClass('error');
                });
            }else
                eval(callback);
        }
    });
}