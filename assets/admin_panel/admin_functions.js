/**
 * Created by zoltarrr on 10.10.15.
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