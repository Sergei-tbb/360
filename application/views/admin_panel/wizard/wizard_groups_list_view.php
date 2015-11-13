<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table-groups">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Группа</th>
                    <th>Параметры</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($groups as $data):?>
                <tr data-id_group="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name;?></td>
                    <td>
                        <?foreach($groups_parameters as $value):
                            echo $value->parameter_name;
                        endforeach;?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success parameters" value="Параметры">
                        <input type="button" class="btn btn-warning edit-group" value="Изменить">
                        <input type="button" class="btn btn-danger delete-group" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>