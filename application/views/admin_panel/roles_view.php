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
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="role-add">Создать новую роль</button>
    </div>
</div>
<br>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive roles-body">

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        displayListData("roles", "display_all", "roles");
    });

    $('#role-add').on("click", function() {
       var page_data = getPageData("admin", "roles_create", "html");
       addObjectModal("Создать новую роль", page_data, "small", "create-role", "roles", "add_new_role", "Создать");
    });
</script>