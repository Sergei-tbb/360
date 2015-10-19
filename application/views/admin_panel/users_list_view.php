<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>E-mail</th>
                <th>Роль</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($users as $data):?>
                <tr data-id_user="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?echo $data->surname.' '; echo $data->name.' '; echo $data->middlename;?></td>
                    <td><?=$data->email;?></td>
                    <td>
                        <?
                        foreach($roles as $role):
                            if($role->id==$data->id_user_role) echo $role->name;
                            else echo '';
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-warning edit-user" value="Изменить">
                        <input type="button" class="btn btn-danger delete-user" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>

        </table>
    </div>
</div>