/**
 * Created by sasha on 16.10.15.
 */
$(document).on('click', '.edit_user', function(){

    var id = $('input[name="id"]').val();
    $.ajax({
        url: '/index.php/Users/load_user_data/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение данных пользователя',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-succcess',
                        callback: function()
                        {
                            var name = $('input[name="name_m"]').val();
                            var middlename = $('input[name="middlename_m"]').val();
                            var surname = $('input[name="surname_m"]').val();
                            var email = $('input[name="email_m"]').val();
                            var id = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/Users/update_user_data/'+id,
                                type: 'POST',
                                data: {name: name, surname: surname, middlename: middlename, email: email},
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
                    },
                    danger: {
                        label: 'Закрыть',
                        className: 'btn-danger',
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.add_contractor', function(){
    var user_id = $('input[name="id"]').val();

    $.ajax({
        url: '/index.php/Users/new_contractor_view/'+user_id,
        success: function(data) {
            bootbox.dialog({
                message: data,
                title: 'Новый подрядчик',
                buttons: {
                    success: {
                        label: 'Добавить',
                        className: 'btn-success',
                        callback: function () {
                            var name = $('input[name="name_c"]').val();
                            var middlename = $('input[name="middlename_c"]').val();
                            var surname = $('input[name="surname_c"]').val();
                            var email = $('input[name="email_c"]').val();
                            var phone = $('input[name="phone_c"]').val();
                            var id = $('input[name="id_c"]').val();

                            $.ajax({
                                url: '/index.php/Users/add_contractor/'+id,
                                type: 'POST',
                                data: {name: name, middlename: middlename, surname: surname, email: email, phone: phone},
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
                    },
                    danger: {
                        label: 'Отмена',
                        className: 'btn-danger',
                        callback: function () {

                        }
                    }
                }

            });
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });
});

$(document).on('click', '.update_password', function(){

    var user_id = $('input[name="id"]').val();

    $.ajax({
        url: '/index.php/Users/update_password_view/'+user_id,
        success: function(data) {
            bootbox.dialog({
                message: data,
                title: 'Изменение пароля пользователя',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function () {
                            var new_password = $('input[name="new_password"]').val();
                            var new_password2 = $('input[name="new_password2"]').val();
                            var old_password = $('input[name="old_password"]').val();
                            var id = $('input[name="id_p"]').val();

                            if(new_password==new_password2)
                            {
                                $.ajax({
                                    url: '/index.php/Users/update_password/'+id,
                                    type: 'POST',
                                    data: {new_password: new_password, old_password: old_password},
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
                            else
                            {
                                bootbox.alert('Пароли не совпадают', function(){});
                            }



                        }
                    },
                    danger: {
                        label: 'Отмена',
                        className: 'btn-danger',
                        callback: function () {

                        }
                    }
                }

            });
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });
});

