<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 14.10.15
 * Time: 9:46
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Роли</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="role-add">
    Создать новую роль
</button>
    </div>
</div>
<br>
<div class="panel panel-default">
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive" id="roles-list">

        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<script>
$('#role-add').on("click", function() {
    var page_data = getPageData("admin", "create_role", "html");

    add_object_modal("Создать новую роль", page_data, "small", "create-role", "Roles", "add_new_role");

    });
</script>