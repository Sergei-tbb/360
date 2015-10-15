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

/**
 * Get data of page
 * @param pageMethod
 * @param pageName
 * @param pageType
 * @returns {string}
 */
function getPageData(pageMethod, pageName, pageType) {
    var pageData ="";

    $.ajax({
        url: "/index.php/ajax/View_load/"+pageMethod+"/"+pageName,
        dataType: pageType,
        type: "get",
        async: false,
        success: function(data) {
            pageData = data;
        }
    });
    return pageData;
}

/**
 * Display modal window of create and edit
 * @param title - title of modal
 * @param pageData - content data
 * @param size - modal size
 * @param formId - id name of form
 * @param controllerName(lowercase) - name of controller
 * @param methodName - name of method
 */
function addObjectModal(title, pageData, size, formId, controllerName, methodName, buttonName, id) {
    bootbox.dialog({
        title: title,
        message: pageData,
        size: size,
        buttons: {
            success: {
                label: buttonName,
                className: "btn-success pull-left",
                callback: function() {
                    var form_data = $("#"+formId).serialize();
                    $.ajax({
                        url : "/index.php/ajax/"+controllerName+"/"+methodName+"/"+id,
                        type: "POST",
                        data: form_data,
                        dataType: "json",
                        success: function(data) {
                            bootbox.alert(data.message);
                            displayListData(controllerName, "display_all", controllerName);
                        },
                        error:function() {
                            alert("Error!");
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

/**
 * Display list of data
 * @param controllerName - name of controller
 * @param methodName - name of method
 * @param idName - id name of insert tag
 */
function displayListData(controllerName, methodName, idName) {
    $.ajax({
        url:"ajax/"+controllerName+"/"+methodName,
        success: function(data) {
            $("."+idName+"-body").html(data);
        }
    });
}

/**
 * Display delete modal
 * @param id - id number of selected object
 * @param objectName - name of deleted object
 * @param controllerName - name of controller
 * @param methodName - name of method
 */
function deleteObjectModal(id, objectName, controllerName, methodName) {
    bootbox.confirm({
        message: "Вы действительно хотите удалить "+objectName,
        buttons: {
            confirm: {
                label: 'Удалить',
                className: 'btn-danger pull-left'
            },
            cancel: {
                label: 'Закрыть',
                className: 'btn-default'
            }
        },
        callback: function(result){
            if(result) {
                $.ajax({
                    url:"ajax/"+controllerName+"/"+methodName,
                    type:"POST",
                    dataType:"json",
                    data: "id="+id,
                    success: function(data) {
                        bootbox.alert(data.message);
                        $("tr[data-id="+id+"]").remove();
                    }
                });
            }
        }
    });
}

/**
 * Display edit form
 * @param id - id number of selected object
 * @param controllerName - name of controller
 * @param methodName - name of method
 * @returns {string}
 */
function getEditForm(id, controllerName, methodName) {
    var pageData = "";
    $.ajax({
        url:"ajax/"+controllerName+"/"+methodName,
        type:"POST",
        data: "id="+id,
        async: false,
        success: function(data) {
            pageData = data;
        }
    });
    return pageData;
}