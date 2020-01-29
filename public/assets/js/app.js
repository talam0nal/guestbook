$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {

    $('#logout').click(function(e) {
        e.preventDefault();
        el = $(this);
        destination = el.data('destination');
        $.post(destination, function() {
            window.location.href = '/';
        });
    });

    $(document).on('click', '.send-message', function(event) {
        event.preventDefault();

        el = $(this);
        form = el.parent('form');
        notification = form.find('.notification');
        destination = form.find('.validate-destination').val();
        text = form.find('.form-control.text').val();

        var formData = new FormData();
        formData.append('text', form.find('textarea').val());
        formData.append('image', form.find('input[type=file]')[0].files[0]); 

        $.ajax({
            url: destination,
            data: formData,
            type: 'POST',
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            cache: false,
            datatype: 'JSON',
            success: function(data) {
                if (text !== '') {
                    form.submit();
                } else {
                    notificate('Введите текст сообщения');
                }
            },
            error: function(data) {
                if (data.responseJSON.errors.image) {
                    notificate('Размер картинки не должен превышать 100 Кб');
                }
                if (data.responseJSON.errors.text) {
                    notificate('Количество символов в сообщении не должно превышать 1000 символов');
                }
                if (data.message == 'Large') {
                    notificate('Высота или ширина картинки не должна превышать 500px');
                }
                if (data.message == 'Small') {
                    notificate('Высота или ширина картинки должна быть больше 100px');
                }
            }
        });
    });

    $('.reply-btn').click(function(e) {
        e.preventDefault();
        el = $(this);
        id = el.data('id');
        $('.reply-form').hide();
        $('.reply'+id).show();
    });

    function notificate(text) {
        notification.show().text(text);
    }

});