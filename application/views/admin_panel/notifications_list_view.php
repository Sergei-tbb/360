<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_notifications">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Уведомление</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($notification as $data):?>
                <tr data-id_notification="<?if(!empty($data->id)) echo $data->id; else echo '';?>">
                    <td><?if(!empty($data->id)) echo $data->id; else echo '';?></td>
                    <td><?if(!empty($data->title)) echo $data->title; else echo '';?></td>
                    <td>
                        <input type="button" class="btn btn-primary notification-roles" value="Роли">
                        <input type="button" class="btn btn-warning notification-edit" value="Редактировать">
                        <input type="button" class="btn btn-danger notification-del" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('table[id="table_notifications"]').dataTable({});
</script>