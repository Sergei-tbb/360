/**
 * Created by ubuntu on 06.08.15.
 */

$(document).ready(function()
{
    $('.page').on('click',function()
    {
        var page = $(this).data("page");
        $.ajax({
            url: '/core/index.php/admin_panel/admin_panel/display_admin_page/'+page,
            //dataType: 'json',
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                    $("#page-wrapper").html(data);
            }
        });
    })
});