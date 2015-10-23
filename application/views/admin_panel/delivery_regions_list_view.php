<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_delivery_regions">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Регион</th>
                    <th>Страна</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?foreach($regions as $data):?>
            <tr data-id_region="<?=$data->id;?>">
                <td><?=$data->id;?></td>
                <td><?=$data->name?></td>
                <td><?
                    foreach($countries as $value):
                    if($data->id_country==$value->id)
                        echo $value->name;
                    else
                        echo '';
                    endforeach;
                    ?>
                </td>
                <td>
                    <input type="button" class="btn btn-success region-city" value="Города">
                    <input type="button" class="btn btn-warning region-edit" value="Изменить">
                    <input type="button" class="btn btn-danger region-delete" value="Удалить">
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#table_delivery_regions').DataTable();
</script>