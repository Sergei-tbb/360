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

    $('.edit_page').on('click', function(){
        var id = $(this).parents('tr').data('id_page');
        alert(id);
    });

    $('.delete_page').on('click', function(){
        var id = $(this).parents('tr').data('id_page');
        alert(id)    });

    $('input[name="is_published"]').on('change', function(){

        if($('input[name="is_published"]').prop('checked')==true)
        {
            alert('is published true');
        }
        else if($('input[name="is_published"]').prop('checked')==false)
        {
            alert('is published false');
        }

    })


});

