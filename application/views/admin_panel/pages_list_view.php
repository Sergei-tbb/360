<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Заголовок</th>
                <th>Опубликовано</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($pages as $data):?>
                <tr>
                    <td><?echo $data->id;?></td>
                    <td><?= $data->title;?></td>
                    <td><input type="checkbox" name="is_published" <?if($data->is_published==1) echo 'checked="checked"';?> ></td>
                    <td>
                        <input type="button" class="btn btn-warning page-edit" value="Редактировать">
                        <input type="button" class="btn btn-danger page-del" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>