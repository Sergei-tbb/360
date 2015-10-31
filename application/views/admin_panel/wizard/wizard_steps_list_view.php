<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table-steps">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Шаг</th>
                    <th>Группа параметров</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($steps as $data):?>
                <tr data-id_step="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name;?></td>
                    <td>
                        <?foreach($wizard_steps as $value):
                            echo $value->group_name;
                        endforeach;?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success wizard-group-parameters" value="Группа параметров">
                        <input type="button" class="btn btn-warning edit-step" value="Изменить">
                        <input type="button" class="btn btn-danger delete-step" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>