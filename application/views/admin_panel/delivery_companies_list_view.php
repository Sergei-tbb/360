<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Компания</th>
                <th>Сайт</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($companies as $data):?>
                <tr data-id_company="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name?></td>
                    <td><?=$data->website;?></td>
                    <td>
                        <input type="button" class="btn btn-success add-department" value="Новое отделение">
                        <input type="button" class="btn btn-warning edit-delivery" value="Изменить">
                        <input type="button" class="btn btn-danger delete-delivery" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>