/**
 * Created by sasha on 13.10.15.
 */
$(document).ready(function()
{
   $('#page-add').on('click',function()
   {
       alert('lol');
   })
});

$(document).on("click", "#page-add", function() {

    var modal_body = getPageData('admin', 'pages_new', 'html');

    bootbox.dialog({
        message: modal_body,
        title: "Создание новой страницы",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function() {
                    Example.show("great success");
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function() {
                    Example.show("uh oh, look out!");
                }
            }
        }
    });
});