<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_pages">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Заголовок</th>
                    <th>Опубликовано</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($pages as $data):?>
                <tr data-id_page="<?= $data->id;?>">
                    <td><?echo $data->id;?></td>
                    <td><?= $data->title;?></td>
                    <td><input type="checkbox" name="is_published" <?if($data->is_published==1) echo 'checked="checked"';?> ></td>
                    <td>
                        <input type="button" class="btn btn-success page-menu" value="Меню">
                        <input type="button" class="btn btn-warning page-edit" value="Редактировать">
                        <input type="button" class="btn btn-danger page-del" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('table[id="table_pages"]').dataTable({});
</script>