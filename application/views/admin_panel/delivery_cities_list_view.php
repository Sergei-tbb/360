<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Город</th>
                <th>Регион</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($cities as $data):?>
                <tr data-id_city="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name?></td>
                    <td><?
                        foreach($regions as $val):
                            if($data->id_region==$val->id)
                            echo $val->name;
                        else
                            echo '';
                        endforeach;

                        ?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success city-streets" value="Улицы">
                        <input type="button" class="btn btn-warning city-edit" value="Изменить">
                        <input type="button" class="btn btn-danger city-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>