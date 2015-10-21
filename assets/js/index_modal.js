$(document).on('click', '.registration', function() {

    $.ajax({
        url: '/index.php/Users/registration_view/',
        success: function (data) {

            bootbox.dialog({
                message: data,
                title: "Регистрация",
                buttons: {
                    success: {
                        label: 'Регистрация',
                        className: 'btn-success',
                        callback: function () {
                            var email = $('input[name="email"]').val();
                            var password = $('input[name="password"]').val();
                            var name = $('input[name="name"]').val();
                            var phone = $('input[name="phone"]').val();
                            var token = $('input[name="token"]').val();
                            if ($('input[name="i_agree"]').prop('checked')) {
                                $.ajax({
                                    url: '/index.php/Users/add_user/',
                                    type: 'POST',
                                    data: {email: email, password: password, name: name, token: token},
                                    success: function (data) {
                                        bootbox.alert(data, function () {
                                        });
                                    },
                                    error: function (data) {
                                        bootbox.alert(data, function () {
                                        });
                                    }
                                });
                            }
                            else {
                                bootbox.alert('Для продолжения регистрации Вы должны ознакомится с Правилами сайта и подтвердить соглашение', function () {
                                });
                            }

                        }
                    }
                }

            });

        }
    });
});

$(document).on('click', '.authorization', function(){

        var modal_body = getPageData('index_page', 'login', 'html');

        bootbox.dialog({
            message: modal_body,
            title: "Авторизация",
            buttons: {
                success: {
                    label: 'Войти',
                    className: 'btn-success',
                    callback: function ()
                    {
                        var email = $('input[name="email"]').val();
                        var password = $('input[name="password"]').val();
                        $.ajax({
                            url: '/index.php/Users/authorization/',
                            type: 'POST',
                            data: {email: email, password: password},
                            success: function(data)
                            {
                                bootbox.alert(data, function(){});
                                location.reload();
                            },
                            error: function(data)
                            {
                                bootbox.alert(data, function(){});
                            }
                        });
                    }
                }
            }
        });
});

$(document).on('click', '.logout', function() {
    bootbox.confirm("Вы действительно хотите выйти из своей учетной записи?", function(result)
    {
        var res = '';
        if(result==true)
        {
            $.ajax({
                url: '/index.php/Users/logout/',
                success: function()
                {
                    bootbox.alert('ok', function(){});
                    location.reload();
                },
                error: function()
                {
                    bootbox.alert('error', function(){});
                }
            });
        }
        return res;
    });

});

$(document).on('click', '.reset_password', function(){
    var password = $('input[name="new_password"]').val();
    var confirm_password = $('input[name="confirm_password"]').val();
    var id = $('input[name="id"]').val();
    if(password==confirm_password)
    {
        $.ajax({
            url: '/index.php/Users/save_new_password/' + id,
            type: 'POST',
            data: {password: password},
            success: function (data)
            {
                bootbox.alert(data, function(){});
            },
            error: function (data)
            {
                bootbox.alert(data, function(){});
            }
        });
    }
    else if(password!=confirm_password)
    {
        bootbox.alert('Пароли не совпадают!', function(){});
    }
});


$(document).on('click', '.forgot-password', function(){

    bootbox.hideAll();
    var modal_body = getPageData('index_page', 'forgot_password', 'html');

    bootbox.dialog({
        message: modal_body,
        title: "Восстановление пароля",
        buttons: {
            success: {
                label: 'Восстановить',
                className: 'btn-success',
                callback: function ()
                {
                    var email = $('input[name="email"]').val();

                    $.ajax({
                        url: '/index.php/Users/send_reset/',
                        type: 'POST',
                        data: {email: email},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }

                    });
                }
            }
        }
    });
});

