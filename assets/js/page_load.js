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