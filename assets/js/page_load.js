/**
 * Created by sasha on 13.10.15.
 */

$(document).ready(function(){
    $('#side-menu li a').on('click', function() {
        var page_name = $(this).attr('id');

        var page_data = getPageData("admin",page_name,"html");

        $("#page-wrapper").html(page_data);

        $("#side-menu li").removeClass("active");
        $(this).parent().addClass("active");
    });
});

function getPageData(page_method, page_name, page_type) {
    var page_data ="";

    $.ajax({
        url: "/index.php/ajax/View_load/"+page_method+"/"+page_name,
        dataType: page_type,
        type: "get",
        async: false,
        success: function(data) {
            page_data = data;
        }
    });

    return page_data;
}

/**
 *
 * @param title
 * @param pageData
 * @param size
 * @param formId
 * @param controllerName
 * @param methodName
 */
function add_object_modal(title, pageData, size, formId, controllerName, methodName) {
    bootbox.dialog({
        title: title,
        message: pageData,
        size: size,
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success pull-left",
                callback: function() {
                    var form_data = $(formId).serialize();
                    $.ajax({
                        url : "/index.php/ajax/"+controllerName+"/"+methodName,
                        type: "post",
                        data: form_data,
                        dataType: "json",
                        success: function(data) {
                            bootbox.alert(data.message);
                        }
                    });
                }
            },
            close: {
                label: "Закрыть",
                className: "btn-default pull-right",
                callback: function() {
                }
            }
        }
    });
}