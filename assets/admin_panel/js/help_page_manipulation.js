/**
 * Created by ubuntu on 07.08.15.
 */

$(document).ready(function()
{
    //load create_help_page_view
    $('#create_page').on('click',function()
    {
        $.ajax({
            url: '/core/index.php/admin_panel/help_page_admin/display_create_help_page_view',
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                $("#page-wrapper").html(data);
            }
        });
    });

    //create new help_page
    $('#add_new_page').on('click',function()
    {
        var title =  $(this).parent("#create_help_page").find("#title").val();
        var content=tinyMCE.activeEditor.getContent();
        console.log(title);
        console.log(content);
        $.ajax({
            type: "POST",
            url: '/core/index.php/admin_panel/help_page_admin/add_new_page',
            data: {title : title, content : content},
            datatype : "json",
            cache : false,
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                var calback = $.parseJSON(data);
                $("#alert").addClass("alert alert-"+calback.alert);
                $("#alert").text(calback.text);
            }

        });

    })

    //load update_help_page_view
    $('.update_page_view').on('click',function(){
       var id_page =  $(this).data("id");
        $.ajax({
            url : '/core/index.php/admin_panel/help_page_admin/display_update_page_view/'+id_page,
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                $("#page-wrapper").html(data);
            }

        })
    });

//update help page
    $('#update_page').on('click',function()
    {
        var id_page = $(this).siblings('#id_page').val();
        var title =  $(this).parent("#update_help_page").find("#title").val();
        var content=tinyMCE.activeEditor.getContent();
        console.log(title);
        console.log(content);
        $.ajax({
            type: "POST",
            url: '/core/index.php/admin_panel/help_page_admin/update_page',
            data: {title : title, content : content, id : id_page},
            datatype : "json",
            cache : false,
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                var calback = $.parseJSON(data);
                $("#alert").addClass("alert alert-"+calback.alert);
                $("#alert").text(calback.text);
            }

        });

    });

    $('.delete_page').on("click",function()
    {
        var id_page = $(this).data('id');
        $(this).closest(".page_list").hide();
        $.ajax({
            url: '/core/index.php/admin_panel/help_page_admin/delete_page/'+id_page,
            error: function(xhr, status, error) {
                alert(xhr.responseText + '|\n' + status + '|\n' +error);
            },
            success : function(data) {
                $("#alert").html(data);
            }

        });

    })


});