<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Район</th>
                    <th>Город</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($areas as $area):?>
                <tr data-id_area="<?=$area->id;?>">
                    <td><?=$area->id;?></td>
                    <td><?=$area->name;?></td>
                    <td>
                        <?foreach($cities as $city):
                            foreach($cities_areas as $data):
                                if($area->id==$data->id_area):
                                    echo $city->name;
                                else:
                                    echo '';
                                endif;
                            endforeach;
                        endforeach;?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success area-city" value="Город">
                        <input type="button" class="btn btn-warning area-edit" value="Изменить">
                        <input type="button" class="btn btn-danger area-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>