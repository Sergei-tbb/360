<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Уведомление</th>
                <th></th>
            </tr>
            <?foreach($notifications as $data):?>
                <tbody>
                    <tr data-id_notification_roles="<?=$data->nr_id;?>">
                        <td><?=$data->not_id;?></td>
                        <td><?=$data->notification?></td>
                        <td><input type="button" name="role" class="btn btn-danger del-not-roles" value="Удалить"></td>
                    </tr>
                </tbody>
            <?endforeach;?>
        </table>
    </div>
</div>