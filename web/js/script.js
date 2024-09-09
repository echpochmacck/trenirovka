$(() => {
    $('#registerform-password').on('keyup', function (e) {
        const el = $(this),
            val = el.val(),
            info = $('.password-info');

        let message = '',
            color = 'text-danger'

        if (val.length > 5) {
            message = 'Слабый пароль'
            color = 'text-danger'

            if (val.match('^(?=.*[a-z])(?=.*[A-Z]).+$')) {
                message = 'СРедний пароль'
                color = 'textt-warning'
                if (val.match('^(?=.*[0-9]).+$')) {
                    message = 'хороший пароль'
                    color = 'textt-success'
                    if (val.match('^(?=.*[\!\@\#\$]).+$')) {
                        message = 'отличный пароль'
                        color = 'textt-success'
        
                    }
    
                }

            }

        } else {
            if (val.length > 3) {
                el.parent('.password-block').find('.feedback-invalid').html('');
                el.removeClass('is-invalid');
                el.addClass('is-valid');

                message = 'Слабый пароль'
                color = 'text-danger'

            }
        }
        info.removeClass('text-danger');
        info.removeClass('text-warning');
        info.removeClass('text-success');

        info.html(message);
        info.addClass(color);

    })
})