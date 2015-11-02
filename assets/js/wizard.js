/**
 * Created by sasha on 29.10.15.
 */
$(document).on('click', '.wizard-add', function(){

    var modal_body = getPageData('wizard', 'new_wizard', 'html');

    bootbox.dialog({
        message: modal_body,
        title: 'Новый мастер заказов',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var formData = new FormData($("#new_wizard")[0]);

                    $.ajax({
                        url:"/index.php/ajax/wizard/Wizard/add_new_wizard",
                        type:"POST",
                        cache:false,
                        contentType:false,
                        processData:false,
                        //dataType:"json",
                        data:formData,
                        success:function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Wizard', 'master_orders_list', 'master-orders');
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
                callback: function(){

                }
            }

        }

    });

});

$(document).on('click', '.delete-wizard', function(){

    var id = $(this).parent().parent('tr').data('id_wizard');

    bootbox.confirm('Вы действительно хотите удалить выбранный мастер заказов?', function(result) {
            if(result==true)
            {
                $.ajax({
                    url: '/index.php/ajax/wizard/Wizard/delete_wizard/',
                    type: 'POST',
                    data: {id: id},
                    success: function(data)
                    {
                        bootbox.alert(data, function(){});
                        updateListWithDirectory('wizard', 'Wizard', 'master_orders_list', 'master-orders');
                    },
                    error: function(data)
                    {
                        bootbox.alert(data, function(){});
                    }
                });
            }
    });
});

$(document).on('click', '.edit-wizard', function(){
    var id = $(this).parent().parent('tr').data('id_wizard');

    $.ajax({
        url: '/index.php/ajax/wizard/Wizard/get_one_wizard/',
        type: 'POST',
        data: {id:id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение мастера заказов',
                size: 'small',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var formData = new FormData($("#wizard_edit")[0]);
                            $.ajax({
                                url: '/index.php/ajax/wizard/Wizard/edit_wizard/',
                                type: 'POST',
                                cache:false,
                                contentType:false,
                                processData:false,
                                //dataType: 'json',
                                data: formData,
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Wizard', 'master_orders_list', 'master-orders');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '#add-category', function() {
    var modal_body = getPageData('wizard', 'wizard_categories_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: 'Новая категория',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var formData = new FormData($("#new_category")[0]);

                    $.ajax({
                        url:"/index.php/ajax/wizard/Categories/add_new_category",
                        type:"POST",
                        cache:false,
                        contentType:false,
                        processData:false,
                        //dataType:"json",
                        data:formData,
                        success:function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Categories', 'display_all', 'categories');

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
                callback: function(){

                }
            }

            }
    });
});

$(document).on('click', '.category-edit', function(){

    var id = $(this).parent().parent('tr').data('id_category');

    $.ajax({
        url: '/index.php/ajax/wizard/Categories/get_one_category/',
        type: 'POST',
        data: {id:id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение категории',
                size: 'small',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var formData = new FormData($("#edit_category")[0]);
                            $.ajax({
                                url: '/index.php/ajax/wizard/Categories/edit_category/',
                                type: 'POST',
                                cache:false,
                                contentType:false,
                                processData:false,
                                //dataType: 'json',
                                data: formData,
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Categories', 'display_all', 'categories');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.category-delete', function(){
    var id = $(this).parent().parent('tr').data('id_category');

    bootbox.confirm('Вы действительно хотите удалить выбранную категорию?', function(result){
       if(result==true)
       {
           $.ajax({
               url: '/index.php/ajax/wizard/Categories/delete_category/',
               type: 'POST',
               data: {id: id},
               success: function(data)
               {
                   bootbox.alert(data, function(){});
                   updateListWithDirectory('wizard', 'Categories', 'display_all', 'categories');
               },
               error: function(data)
               {
                   bootbox.alert(data, function(){});
               }
           });
       }
    });
});

$(document).on('click', '.add-parameter', function(){

    var modal_body = getPageData('wizard', 'wizard_parameter_new', 'html')

    bootbox.dialog({
        message: modal_body,
        title: 'Новый параметр',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var name = $('input[name="name"]').val();

                    $.ajax({
                        url: '/index.php/ajax/wizard/Parameters/add_parameter/',
                        type: 'POST',
                        data: {name: name},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Parameters', 'display_all', 'parameters');
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
                callback: function()
                {

                }
            }
        }
    });

});

$(document).on('click', '.delete-parameter', function(){
    var id = $(this).parent().parent('tr').data('id_parameter');

    bootbox.confirm('Вы действительно хотите удалить выбранный параметр?', function(result){
       if(result==true)
       {
           $.ajax({
               url: '/index.php/ajax/wizard/Parameters/delete_parameter/',
               type: 'POST',
               data: {id: id},
               success: function(data)
               {
                   bootbox.alert(data, function(){});
                   updateListWithDirectory('wizard', 'Parameters', 'display_all', 'parameters');
               },
               error: function(data)
               {
                   bootbox.alert(data, function(){});
               }
           });
       }
    });
});

$(document).on('click', '.edit-parameter', function() {
    var id = $(this).parent().parent('tr').data('id_parameter');

    $.ajax({
        url: '/index.php/ajax/wizard/Parameters/get_one_parameter/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение параметра',
                size: 'small',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var name = $('input[name="name"]').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Parameters/update_parameter/',
                                type: 'POST',
                                data: {id: id, name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Parameters', 'display_all', 'parameters');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger:{
                        label: 'Отмена',
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

$(document).on('click', '.add-group', function() {
   var modal_body = getPageData('wizard', 'wizard_group_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: 'Новая группа параметров',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var name = $('input[name="name"]').val();

                    $.ajax({
                        url: '/index.php/ajax/wizard/Groups/add_group/',
                        type: 'POST',
                        data: {name: name},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Groups', 'display_all', 'groups');
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger:{
                label: 'Отмена',
                className: 'btn-danger',
                callback: function()
                {

                }
            }
        }
    });
});

$(document).on('click', '.delete-group', function() {
    var id = $(this).parent().parent('tr').data('id_group');

    bootbox.confirm('Вы действительно хотите удалить выбранную группу параметров?', function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/wizard/Groups/delete_group/',
                type: 'POST',
                data: {id: id},
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateListWithDirectory('wizard', 'Groups', 'display_all', 'groups');
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    })
});

$(document).on('click', '.edit-group', function(){

    var id = $(this).parent().parent('tr').data('id_group');

    $.ajax({
        url: '/index.php/ajax/wizard/Groups/get_one_group/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение группы параметров',
                buttons:{
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var name = $('input[name="name"]').val();
                            var id = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Groups/update_group/',
                                type: 'POST',
                                data: {id: id, name: name},
                                success: function (data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Groups', 'display_all', 'groups');
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
                        callback: function()
                        {

                        }
                    }
                }

            });
        }
    });


});

$(document).on('click', '.add-step', function() {
    var modal_body = getPageData('wizard', 'wizard_steps_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: 'Создание нового шага',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var name = $('input[name="name"]').val();

                    $.ajax({
                        url: '/index.php/ajax/wizard/Steps/add_step/',
                        type: 'POST',
                        data: {name: name},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Steps', 'display_all', 'steps');
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
                callback: function()
                {

                }
            }
        }
    });
});

$(document).on('click', '.delete-step', function() {

    var id = $(this).parent().parent('tr').data('id_step');

    bootbox.confirm('Вы действительно хотите удалить выбранный шаг?', function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/wizard/Steps/delete_step/',
                type: 'POST',
                data: {id: id},
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateListWithDirectory('wizard', 'Steps', 'display_all', 'steps');
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.edit-step', function(){

    var id = $(this).parent().parent('tr').data('id_step');

    $.ajax({
        url: '/index.php/ajax/wizard/Steps/get_one_step/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение шага',
                size: 'small',
                buttons: {
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var name = $('input[name="name"]').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Steps/update_step/',
                                type: 'POST',
                                data: {id: id, name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Steps', 'display_all', 'steps');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.add-value', function(){

    var modal_body = getPageData('wizard', 'wizard_values_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: 'Создание нового значения',
        size: 'small',
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    var value = $('input[name="value"]').val();

                    $.ajax({
                        url: '/index.php/ajax/wizard/Types_values/add_value/',
                        type: 'POST',
                        data: {value: value},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateListWithDirectory('wizard', 'Types_values', 'display_all', 'values');
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
                callback: function()
                {

                }
            }
        }
    });
});

$(document).on('click', '.delete-value', function() {

    var id = $(this).parent().parent('tr').data('id_value');

    bootbox.confirm('Вы действительно хотите удалить выбранное значение?', function(result)
    {
        if(result==true)
        {
            $.ajax({
                url: '/index.php/ajax/wizard/Types_values/delete_value/',
                type: 'POST',
                data: {id: id},
                success: function(data)
                {
                    bootbox.alert(data, function(){});
                    updateListWithDirectory('wizard', 'Types_values', 'display_all', 'values');
                },
                error: function(data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.edit-value', function(){
    var id = $(this).parent().parent('tr').data('id_value');

    $.ajax({
        url: '/index.php/ajax/wizard/Types_values/get_one_value/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Изменение данных значения',
                size: 'small',
                buttons:{
                    success: {
                        label: 'Изменить',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var value = $('input[name="value"]').val();
                            $.ajax({
                                url: '/index.php/ajax/wizard/Types_values/update_value/',
                                type: 'POST',
                                data: {id: id, value: value},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Types_values', 'display_all', 'values');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});


/**
 * many to many
 */


$(document).on('click', '.wizard-category', function(){
    var id = $(this).parent().parent('tr').data('id_category');

    $.ajax({
        url: '/index.php/ajax/wizard/Wizard_categories/display_wizards/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Привязка категории в мастер заказов',
                size: 'small',
                buttons: {
                    success: {
                        label: 'Привязать',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var wizard = $('select[name="wizards"] option:selected').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Wizard_categories/add_wizard_category/',
                                type: 'POST',
                                data: {id: id, wizard: wizard},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Categories', 'display_all', 'categories');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    })

});

$(document).on('click', '.wizard-step', function(){
    var id = $(this).parent().parent('tr').data('id_wizard');

    $.ajax({
        url: '/index.php/ajax/wizard/Wizard_steps/display_steps/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Привязка шага к мастеру заказов',
                buttons: {
                    success: {
                        label: 'Привязать',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var step = $('select[name="steps"] option:selected').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Wizard_steps/add_wizard_step/',
                                type: 'POST',
                                data: {id: id, step:step},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Steps', 'display_all', 'steps');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.wizard-group-parameters', function(){
    var id = $(this).parent().parent('tr').data('id_step');

    $.ajax({
        url: '/index.php/ajax/wizard/Steps_groups_parametrs/display_groups/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Привязка групп параметров к шагам',
                buttons: {
                    success: {
                        label: 'Привязать',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var group = $('select[name="groups"] option:selected').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Steps_groups_parametrs/add_step_group/',
                                type: 'POST',
                                data: {id: id, group:group},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Steps', 'display_all', 'steps');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.parameters', function(){
    var id = $(this).parent().parent('tr').data('id_group');

    $.ajax({
        url: '/index.php/ajax/wizard/Groups_parametrs/display_groups_parameters/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: 'Привязка параметров к группа параметров',
                buttons: {
                    success: {
                        label: 'Привязать',
                        className: 'btn-success',
                        callback: function()
                        {
                            var id = $('input[name="id"]').val();
                            var parameter = $('select[name="parameter"] option:selected').val();

                            $.ajax({
                                url: '/index.php/ajax/wizard/Groups_parametrs/add_groups_parameter/',
                                type: 'POST',
                                data: {id: id, parameter:parameter},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateListWithDirectory('wizard', 'Groups', 'display_all', 'groups');
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
                        callback: function()
                        {

                        }
                    }
                }
            });
        }
    });
});

$(document).on('click', '.is_published_wizard', function(){
   var id = $(this).parent().parent('tr').data('id_wizard');

    $.ajax({
        url: '/index.php/ajax/wizard/Wizard/publish_wizard/',
        type: 'POST',
        data: {id: id},
        success: function(data)
        {
            bootbox.alert(data, function(){});
            updateListWithDirectory('wizard', 'Wizard', 'master_orders_list', 'master-orders');
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }

    });
});



