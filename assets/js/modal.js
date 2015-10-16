/**
 * Created by sasha on 13.10.15.
 */

$(document).on("click", "#page-add", function() {

    var modal_body = getPageData('admin', 'pages_new', 'html');
    bootbox.dialog({
        message: modal_body,
        title: "Создание новой страницы",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function()
                {
                    var title = $('input[name="title"]').val();
                    var date_time = $('input[name="date_time"]').val();
                    var keywords = $('input[name="keywords"]').val();
                    var description = $('textarea[name="description"]').val();
                    var page_data = tinyMCE.activeEditor.getContent();
                    $.ajax({
                        url: '/index.php/ajax/Pages/new_page/',
                        type: 'POST',
                        data: {title: title, date_time: date_time, keywords: keywords, description: description, page_data: page_data},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateList('Pages', 'pages_list', 'pages')
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function() {}
            }
        }
    });
});

$(document).on("click", ".page-del", function() {

    var id = $(this).parent().parent('tr').data('id_page');

    bootbox.confirm("Вы действительно хотите удалить выбранную страницу?", function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/Pages/delete_page/',
                type: 'POST',
                data: {id: id},
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateList('Pages', 'pages_list', 'pages')
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }

    })
});

$(document).on('click', 'input[name="is_published"]', function()
{
    var is_published;
    var id = $(this).parent().parent('tr').data('id_page');
    if($('input[name="is_published"]').prop('checked'))
    {
        is_published = 1;
    }
    else
    {
        is_published = 0;
    }

    $.ajax({
        url: '/index.php/ajax/Pages/publish_page/'+id,
        type: 'POST',
        data: {is_published: is_published},
        success: function(data)
        {
            bootbox.alert(data, function() {});
        },
        error: function(data)
        {
            bootbox.alert(data, function() {});
        }
    });
});

$(document).on('click', '.page-edit', function()
{
    var id = $(this).parent().parent('tr').data('id_page');

    $.ajax({
        url: '/index.php/ajax/Pages/get_page/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Редактирование страницы",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var title = $('input[name="title"]').val();
                            var date_time = $('input[name="date_time"]').val();
                            var keywords = $('input[name="keywords"]').val();
                            var description = $('textarea[name="description"]').val();
                            var page_data = tinyMCE.activeEditor.getContent();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/Pages/update_page/'+id,
                                type: 'POST',
                                data: {title: title, date_time: date_time, keywords: keywords, description: description, page_data: page_data},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('Pages', 'pages_list', 'pages')
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on("click", "#menu-add", function() {

    var modal_body = getPageData('admin', 'menus_new', 'html');
    bootbox.dialog({
        message: modal_body,
        title: "Создание нового меню",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function()
                {
                    var name = $('input[name="name"]').val();

                    $.ajax({
                        url: '/index.php/ajax/Menus/new_menu/',
                        type: 'POST',
                        data: {name: name},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateList('Menus', 'menu_list', 'menus')
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function() {}
            }
        }
    });
});


$(document).on('click', '.menu-edit', function()
{
    var id = $(this).parent().parent('tr').data('id_menu');

    $.ajax({
        url: '/index.php/ajax/Menus/get_menu/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Редактирование меню",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="name"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/Menus/update_menu/'+id,
                                type: 'POST',
                                data: {name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('Menus', 'menu_list', 'menus')
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on("click", ".menu-del", function() {

    var id = $(this).parent().parent('tr').data('id_menu');

    bootbox.confirm("Вы действительно хотите удалить выбранное меню?", function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/Menus/delete_menu/'+id,
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateList('Menus', 'menu_list', 'menus')
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }

    })
});


$(document).on('click', '.page-menu', function()
{
    var id = $(this).parent().parent('tr').data('id_page');

    $.ajax({
        url: '/index.php/ajax/Menus/get_pages_menu/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Меню",
                buttons: {
                    success: {
                        label: "Обновить",
                        className: "btn-success",
                        callback: function()
                        {
                            var id_menu = $('select[name="menu"] option:selected').val();
                            var id_page = $('select[name="menu"] option:selected').data('id_page');


                            $.ajax({
                                url: '/index.php/ajax/Menus_pages/add_pages_menu/',
                                type: 'POST',
                                data: {id_page: id_page, id_menu: id_menu},
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
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});


$(document).on('click', '.menu-pages', function()
{
    var id = $(this).parent().parent('tr').data('id_menu');
    $.ajax({
        url: '/index.php/ajax/Menus_pages/get_menu_pages/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Меню",
                buttons: {
                    danger: {
                        label: "Закрыть",
                        className: "btn-success",
                        callback: function()
                        {

                        }
                    }
                }
            });        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });


});


$(document).on('click', '.page-menu-delete', function()
{
    var id = $(this).parent().parent('tr').data('menu_page');

    $.ajax({
        url: '/index.php/ajax/Menus_pages/delete_menu_page/'+id,
        success: function(data)
        {
            bootbox.alert(data, function(){});
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });


});


$(document).on('click', '#notifications-add', function()
{
    var modal_body = getPageData('admin', 'notifications_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: "Создать новое уведомление",
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var title = $('input[name="title"]').val();
                    var notification = $('textarea[name="notification"]').val();

                    $.ajax({
                        url: '/index.php/ajax/Notifications/new_notification/',
                        type: 'POST',
                        data: {title: title, notification: notification},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateList('Notifications', 'get_list_notifications', 'notifications');
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function()
                {

                }
            }
        }
    });
});


$(document).on('click', '.notification-edit', function()
{
    var id_notification = $(this).parent().parent('tr').data('id_notification');

    $.ajax({
        url: '/index.php/ajax/Notifications/get_one_notification/'+id_notification,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Редактирование уведомлений",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var title = $('input[name="title"]').val();
                            var notification = $('textarea[name="notification"]').val();

                            $.ajax({
                                url: '/index.php/ajax/Notifications/update_notification/'+id,
                                type: 'POST',
                                data: {title: title, notification: notification},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('Notifications', 'get_list_notifications', 'notifications')
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on("click", ".notification-del", function() {

    var id = $(this).parent().parent('tr').data('id_notification');

    bootbox.confirm("Вы действительно хотите удалить выбранное уведомление?", function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/Notifications/delete_notification/'+id,
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateList('Notifications', 'get_list_notifications', 'notifications')
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }

    })
});


$(document).on('click', '.notification-roles', function()
{
    var id_notification = $(this).parent().parent('tr').data('id_notification');

    $.ajax({
        url: '/index.php/ajax/Notifications/notifications_roles/',
        type: 'POST',
        data: {id: id_notification},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Роли уведомлений",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var roles = $('select[name="roles_name"]').val();
                            var id = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/ajax/Notifications_roles/new_notification_role/',
                                type: 'POST',
                                data: {id_notification: id, id_role: roles},
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
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.edit-notifications', function()
{
    var id_role = $(this).parent().parent('tr').data('id');

    $.ajax({
        url: '/index.php/ajax/Roles/get_list_notifications/'+id_role,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Уведомления роли",
                buttons: {
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.del-not-roles', function()
{

    var id = $(this).parent().parent('tr').data('id_notification_roles');

    $.ajax({
        url: '/index.php/ajax/Notifications_roles/delete_notification_roles/'+id,
        success: function(data)
        {
            bootbox.hideAll();
            bootbox.alert(data, function(){});
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });
});


