<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table-parameters">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Параметр</th>
                    <th>Значение</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($parameters as $data):?>
                <tr data-id_parameter="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name;?></td>
                    <td>
                        <?foreach($values as $value):
                            echo $value->value_name;
                        endforeach;?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success group-parameter" value="Значение">
                        <input type="button" class="btn btn-warning edit-parameter" value="Изменить">
                        <input type="button" class="btn btn-danger delete-parameter" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
