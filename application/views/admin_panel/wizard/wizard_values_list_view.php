<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table-values">
            <thead>
            <tr>
                <th>#</th>
                <th>Значение</th>
                <th>Параметр</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?foreach($values as $data):?>
                <tr data-id_value="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->value;?></td>
                    <td></td>
                    <td>
                        <input type="button" class="btn btn-success parameter-value" value="Параметр">
                        <input type="button" class="btn btn-warning edit-value" value="Изменить">
                        <input type="button" class="btn btn-danger delete-value" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>