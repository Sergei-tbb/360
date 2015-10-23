<? if(empty($statuses)) : ?>
    Ни одно статуса не было создано.
    Ни одного статуса не было создано.
<? else:  ?>
    <? $count = 1;?>
    <table class="table">
        <tr>
            <th style="max-width: 0.5em;">#</th>
            <th>Название</th>
            <th></th>
            <th></th>

        </tr>
        <? foreach($statuses as $data):?>
            <tr data-id="<? if(!empty($data->id)) echo $data->id ;?>">
                <td style="max-width: 0.5em;"><?= $count ;?></td>
                <td><? if(!empty($data->name)) echo $data->name ;?></td>
                <td>
                    <img class="img-rounded center-block" style="max-height: 50px;" src="<?= base_url() ;?>download/statuses_image/<?  if(!empty($data->picture)) echo $data->picture."?".time() ;?>"/>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-statuses">Изменить</button>
                    <button type="button" class="btn btn-sm btn-danger remove-statuses">Удалить</button>
                </td>
            </tr>
            <? $count++ ;?>
        <? endforeach ;?>
    </table>
    <script>
        $(".remove-statuses").on("click", function() {
            var id = $(this).parents("tr").data("id");
            deleteObjectModal(id, "роль", "statuses", "delete_statuses", "statuses");
        });

        $(".edit-statuses").on("click", function() {
            var id = $(this).parents("tr").data("id");
            var pageData = getEditForm(id, "statuses", "get_one_statuses");
            addObjectModal("Изменить статус", pageData, "small", "create-statuses", "statuses", "edit_statuses", "Изменить", id, "file");
        });
    </script>
<? endif;?>