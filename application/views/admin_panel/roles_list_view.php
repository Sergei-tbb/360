

<? if(empty($roles)) : ?>
    Ни одной роли не было создано.
<? else: ?>

    <table class="table">
        <tr>
            <th>Название</th>
            <th></th>
        </tr>
        <? foreach($roles as $data) :?>
            <tr data-role-id="<?= $data['id'] ;?>">
                <td><?= $data['name'] ;?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-role">Изменить</button>
                    <button type="button" class="btn btn-sm btn-danger remove-role">Удалить</button>
                </td>
            </tr>
        <? endforeach ?>
    </table>
<? endif ?>

<!--<script>-->
<!--    $('.remove-role').on('click', function() {-->
<!--        var id = $(this).parents('tr').data('role-id');-->
<!--        remove(id, "Roles", "роль");-->
<!--    });-->
<!--</script>-->