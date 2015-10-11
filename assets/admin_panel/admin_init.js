/**
 * Created by zoltarrr on 10.10.15.
 */



$('#side-menu li a').on('click', function() {
    var page_name = $(this).attr('id');

    var page_data = getPageData("admin",page_name,"html");

    $("#page-wrapper").html(page_data);

    $("#side-menu li").removeClass("active");
    $(this).parent().addClass("active");
});