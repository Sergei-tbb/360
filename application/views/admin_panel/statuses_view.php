<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Статусы</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="statuses-add">Создать новый статус</button>
    </div>
</div>
<br>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive statuses-body">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        displayListData("statuses", "display_all", "statuses")
    });
    $('#statuses-add').on("click", function() {
        var pageData = getPageData("admin", "statuses_create", "html");
        addObjectModal("Создать новый статус", pageData, "small", "create-statuses", "statuses", "add_new_statuses", "Создать", "", "file");
    });
</script>
