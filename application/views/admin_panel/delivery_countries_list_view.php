<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Страна</th>
                <th></th>
            </tr>
            <tr>
            <?foreach($country as $data):?>
                <tr data-id_country="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name;?></td>
                    <td>
                        <input type="button" class="btn btn-success country-region" value="Регионы">
                        <input type="button" class="btn btn-warning country-edit" value="Изменить">
                        <input type="button" class="btn btn-danger country-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>