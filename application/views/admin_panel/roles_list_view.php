<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 11.10.15
 * Time: 16:14
 */
?>

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

<script>
    $('.remove-role').on('click', function() {
        var id = $(this).parents('tr').data('role-id');

        remove(id, "Roles", "remove", "роль");
    });

    function remove(id, pageName, methodName, objectDelete) {
        bootbox.confirm({
            message: 'Вы действительн охотите удалить '+objectDelete+'?',
            size: "small",
            buttons: {
                cancel: {
                    label: 'Отмена',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Удалить',
                    className: 'btn-danger pull-right',
                    callback: function () {
                        $.ajax({
                            url:"AJAX/"+pageName+"/"+methodName+"",
                            type:"POST",
                            dataType:'json',
                            async: true,
                            data: id,
                            error:function(data) {
                                console.log(data);
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        })
                    }
                }
            },
            callback: function() {

            }
        });
    }
</script>