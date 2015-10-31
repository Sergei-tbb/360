<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_master_orders">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Мастер</th>
                    <th>Изображение</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($master_orders as $data):?>
                <tr data-id_wizard="<?=$data->id;?>">
                    <td><?if(!empty($data->id)) echo $data->id; else echo '';?></td>
                    <td><?if(!empty($data->name)) echo $data->name; else echo '';?></td>
                    <td><img class="img-rounded center-block" style="max-height: 50px;" src="<?= base_url() ;?>download/wizard_images/<?  if(!empty($data->picture)) echo $data->picture."?".time() ;?>"/>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success wizard-step" value="Шаги">
                        <input type="button" class="btn btn-warning edit-wizard" value="Изменить">
                        <input type="button" class="btn btn-danger delete-wizard" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#table_master_orders').DataTable();
</script>

