<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_delivery_streets">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Улица</th>
                    <th>Район</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($streets as $data):?>
            <tr data-id_street="<?=$data->id;?>">
                <td><?=$data->id;?></td>
                <td><?=$data->name?></td>
                <td>
                <?foreach($areas_streets as $value):?>
                    <?if($value->id_street==$data->id):
                        echo $value->area_name;
                    else:
                        echo '';
                    endif;?>
                <?endforeach;?>
                </td>
                <td>
                    <input type="button" class="btn btn-success street-area" value="Район">
                    <input type="button" class="btn btn-warning street-edit" value="Изменить">
                    <input type="button" class="btn btn-danger street-delete" value="Удалить">
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#table_delivery_streets').DataTable();
</script>