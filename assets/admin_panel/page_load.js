/**
 * Created by sasha on 12.10.15.
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
        url: "/index.php/ajax/Page_load/"+page_method+"/"+page_name,
        dataType: page_type,
        type: "get",
        async: false,
        success: function(data) {
            page_data = data;
        }
    });

    return page_data;
}

function getTableContent(pageName, pastIn) {+
    -

    $.ajax({
        url: "/index.php/ajax/View/"+pageName+"_list",
        dataType: "html",
        success: function(data)
        {
            $(pastIn).html(data);
        },
        error: function()
        {
            bootbox.alert("Data not found.");
        }
    });
}