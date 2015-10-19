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
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Статусы<span class="caret"></span></button>
                        <ul class="dropdown-menu scrollable-menu" style="height: auto; max-height: 200px; overflow-x: hidden;" role="menu">
                    <? if(empty($roles['statuses'])) : ?>
                        <li><a href="#">Нет выбраных статусов</a></li>
                    <? else : ?>
                        <? foreach($roles['statuses'] as $status) : ?>
                            <li><a href="#"><?= $status->name ;?></a></li>
                        <? endforeach ;?>
                    <? endif ;?>
                        </ul>
                    </div>
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

        $(".edit-role").on("click", function() {
            var id = $(this).parents("tr").data("id");
            var pageData = getEditForm(id, "Roles", "get_one_role");
            addObjectModal("Изменить роль", pageData, "small", "create-role", "roles", "edit_role", "Изменить", id);
        });
    </script>
<? endif;?>