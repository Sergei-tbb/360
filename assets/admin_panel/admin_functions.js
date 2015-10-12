/**
 * Created by zoltarrr on 10.10.15.
 */

/**
 * Get html for display
 * @param page_method - page method
 * @param page_name - page name
 * @param page_type - type of page
 * @returns {string}
 */
function getPageData(page_method, page_name, page_type) {
    var page_data ="";

    $.ajax({
        url: "/index.php/AJAX/Page_load/"+page_method+"/"+page_name,
        dataType: page_type,
        type: "get",
        async: false,
        success: function(data) {
            page_data = data;
        }
    });

    return page_data;
}

function remove(id, pageName, objectDelete) {
    bootbox.confirm({
        message: 'Вы действительн охотите удалить '+objectDelete+'?',
        buttons: {
            confirm: {
                label: 'Удалить',
                className: 'btn-danger pull-left',
                callback: function() {
                    $.ajax({
                        url:"/index.php/AJAX/"+pageName+"/remove",
                        type:"POST",
                        dataType:"json",
                        data: id,
                        error:function(data) {
                            alert("Error");
                            console.log(data);
                        },
                        success: function(data) {
                            alert("Success");
                            console.log(data);
                        },
                        complete: function() {
                            alert("Complete");
                        }
                    })
                }
            },
            cancel: {
                label: 'Отмена',
                className: 'btn-default'
            }
        },
        callback: function() {

        }
    });
}