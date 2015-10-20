<? if(empty($roles)) : ?>
    Ни одной роли не было создано.
<? else:  ?>
    <? $count = 1;?>
    <table class="table">
        <tr>
            <th style="max-width: 0.5em;">#</th>
            <th>Название</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <? foreach($roles as $data):?>
            <tr data-id="<?= $data->id ;?>">
                <td style="max-width: 0.5em;"><?= $count ;?></td>
                <td><?= $data->name ;?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary edit-statuses-rols">Статусы</button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-role">Изменить</button>
                    <button type="button" class="btn btn-sm btn-danger remove-role">Удалить</button>
                </td>
            </tr>
            <? $count++ ;?>
        <? endforeach ;?>
    </table>
    <script>
        $(".remove-role").on("click", function() {
            var id = $(this).parents("tr").data("id");
            deleteObjectModal(id, "роль", "roles", "delete_role", "roles");

        });


        $(".edit-statuses-rols").on("click", function() {
            var id = $(this).parents("tr").data("id");
            var pageData = getEditForm(id, "statuses_rols", "display_statuses_rols");
            addObjectModal("Выбрать статус", pageData, "large", "manipulation-statuses-rols", "statuses-rols", "display_statuses_rols", "Изменить", id);
        });

        $(".edit-role").on("click", function() {
            var id = $(this).parents("tr").data("id");
            var pageData = getEditForm(id, "Roles", "get_one_role");
            addObjectModal("Изменить роль", pageData, "small", "create-role", "roles", "edit_role", "Изменить", id);
        });
    </script>
<? endif;?>