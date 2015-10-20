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
 * @param handler - if file used method sendFormDataWithFile()
 */
function addObjectModal(title, pageData, size, formId, controllerName, methodName, buttonName, id, heandler) {
    bootbox.dialog({
        title: title,
        message: pageData,
        size: size,
        buttons: {
            success: {
                label: buttonName,
                className: "btn-success pull-left",
                callback: function() {
                    if(heandler == "file") {
                        sendFormDataWithFile(controllerName, methodName, id, formId);
                    }else{
                        sendFormData(controllerName, methodName, id, formId);
                    }
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
function deleteObjectModal(id, objectName, controllerName, methodName, idName) {
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
                        displayListData(controllerName, "display_all", idName);
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
        url:"/index.php/ajax/"+controllerName+"/"+methodName,
        type:"POST",
        data: "id="+id,
        async: false,
        success: function(data) {
            pageData = data;
        }
    });
    return pageData;
}

/**
 * Display preview of select image
 * @param input - used input
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

/**
 *
 * @param controllerName
 * @param methodName
 * @param id
 * @param formId
 * @returns {boolean}
 */
function sendFormDataWithFile(controllerName, methodName, id, formId) {
        var formData = new FormData($("#"+formId)[0]);
        if(id) {
            formData.append("id", id);
        }

        $.ajax({
            url:"/index.php/ajax/"+controllerName+"/"+methodName,
            type:"POST",
            cache:false,
            contentType:false,
            processData:false,
            dataType:"json",
            data:formData,
            success:function(data) {
                bootbox.alert(data.message);
                displayListData(controllerName, "display_all", controllerName);
            },
            error:function() {
                alert("Error!");
            }
        });
    return false;
}

/**
 *
 * @param controllerName
 * @param methodName
 * @param id
 * @param formId
 */
function sendFormData(controllerName, methodName, id, formId) {
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

function updateList(name_module, name_method, inId)
{
    $.ajax({
        url: '/index.php/ajax/'+name_module+'/'+name_method,
        success: function(data)
        {
            $('.'+inId+'-body').empty();
            $('.'+inId+'-body').html(data);
        },
        error: function(data)
        {
            $('.'+inId+'-body').html(data);
        }
    });
}

function loadView(module_name, method_name, type, modal_title)
{
    $.ajax({
        url: '/index.php/ajax/'+module_name+'/'+method_name,
        success: function(data)
        {
            //page_data = data;
            if(type=='add')
            {add_new(data, modal_title);}
        }
    });
}


function add_new(data, title)
{
    bootbox.dialog({
        message: data,
        title: title,
        buttons: {
            success: {
                label: 'Создать',
                className: 'btn-success',
                callback: function()
                {
                    //if(isArray(data_callback)===true)
                    //{
                    //    bootbox.alert('Массив');
                    //}
                    //else
                    //{
                    //    bootbox.alert('Строка');
                    //}
                }
            },
            danger: {
                label: 'Закрыть',
                className: 'btn-danger',
                callback: {}
            }
        }
    });
}
