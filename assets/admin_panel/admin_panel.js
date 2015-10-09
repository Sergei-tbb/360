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
        alert(id);
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


        $('#pages_modal').modal('toggle');

        //$.ajax({
        //    url:"AJAX/Pages/remove",
        //    type:"POST",
        //    //dataType:"json",
        //    data: id,
        //    error:function() {
        //        alert("error");
        //    },
        //    success: function() {
        //        alert("success")
        //    }
        //});
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
    });

    $('.create_page').on('click', function()
    {
        $.ajax({
            url: '/index.php/AJAX/Pages/create_page_modal/',
            success: function(data)
            {
                $('.modal-header').html('<h4 class="modal-title" id="myModalLabel">Создание новой страницы</h4>');
                $('.modal-body').html(data);
                $('.modal-footer').append('<button type="button" class="btn btn-primary page_btn">Сохранить</button>');
            },
            error: function()
            {
                alert('error create page');
            }
        })
    });


    $('.modal-footer').on('click', '.page_btn', function()
    {
        var title = $('input[name="title"]').val();
        var page = $('input[name="page"]').val();
        var date_time = $('input[name="date_time"]').val();
        var keywords = $('textarea[name="keywords"]').val();
        var description = $('textarea[name="description"]').val();
        //var page_data = $('textarea[name="page_data"]').val();
        var page_data = tinymce.get('page_data').getContent();
        $.ajax({
            url: '/index.php/AJAX/Pages/create_page',
            type: 'POST',
            data: {title: title, page: page, date_time: date_time, keywords: keywords, description: description, page_data: page_data},
            success: function()
            {
                alert('success');
            },
            error: function()
            {
                alert('error');
            }
        });
    });
});

