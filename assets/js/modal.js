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