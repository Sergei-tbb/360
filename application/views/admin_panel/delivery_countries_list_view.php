<div class="row">
    <div class="col-lg-12">
        <table class="table table-hove">
            <tr>
                <th>#</th>
                <th>Страна</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($country as $data):?>
                <td><?=$data->id;?></td>
                <td><?=$data->name;?></td>
                <td>
                    <input type="button" class="btn btn-success country-regions" value="Регионы">
                    <input type="button" class="btn btn-success country-edit" value="Изменить">
                    <input type="button" class="btn btn-success country-delete" value="Удалить">
                </td>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>