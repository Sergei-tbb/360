/**
 * Created by sasha on 21.10.15.
 */
$(document).on('click', '.static_page', function(){
    var id = $(this).parent('li').data('id_page');
    $.ajax({
        url: '/index.php/ajax/Pages/display_page/'+id,
        success: function(data)
        {
            $('.container').html(data);
        }
    });
});