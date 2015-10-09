/**
 * Created by sasha on 09.10.15.
 */
$(document).ready(function () {

    $('a[id="pages"]').on('click', function(){
        $.ajax({
            url: '/index.php/Admin_panel/pages/',
            success: function(data)
            {
                $('div[id="page-wrapper"]').html(data);
            },
            error: function(data)
            {
                $('div[id="page-wrapper"]').html(data);
            }
        })
    });

    $('.edit_page').on('click', function()
    {
        var modal_title = "Изменение страницы - ";
        var id = $(this).parents('tr').data('id_page');
        $.ajax({
            url: '/index.php/AJAX/Pages/edit_page/',
            type: 'POST',
            data: {id: id},
            success: function(data)
            {
                //modal_title + data['title'];
                $('.modal-body').html(data);
            },
            error: function()
            {
                alert('error');
            }
        });
    });

    $('.delete_page').on('click', function(){
        var id = $(this).parents('tr').data('id_page');
//alert(id);
        $.ajax({
            url:"AJAX/Pages/remove",
            type:"POST",
            //dataType:"json",
            data: id,
            error:function() {
                alert("error");
            },
            success: function() {
                alert("success")
            }
        });
    });

    $('input[name="is_published"]').on('change', function()
    {
        var id = $(this).parents('tr').data('id_page');
        var state;
        if($('input[name="is_published"]').prop('checked')==true) state = 1;
        else if($('input[name="is_published"]').prop('checked')==false) state = 0;

        $.ajax({
            url: '/index.php/AJAX/Pages/publish_page/',
            type: 'POST',
            data: {id: id, state: state},
            error: function ()
            {
                alert('Произошла ошибка при опубликовании страницы');
            }
        });
    })

    $('.create_page').on('click', function()
    {
        $.ajax({
            url: '/index.php/AJAX/Pages/create_page/',
            success: function(data)
            {
                $('.modal-header').html('<h4 class="modal-title" id="myModalLabel">Создание новой страницы</h4>');
                $('.modal-body').html(data);
            },
            error: function()
            {
                alert('error create page');
            }
        })
    });


});

