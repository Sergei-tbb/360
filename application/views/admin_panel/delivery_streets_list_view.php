<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Улица</th>
                <th></th>
            </tr>
            <tr>
                <?foreach($streets as $data):?>
            <tr data-id_street="<?=$data->id;?>">
                <td><?=$data->id;?></td>
                <td><?=$data->name?></td>
                <td>
                    <input type="button" class="btn btn-warning street-edit" value="Изменить">
                    <input type="button" class="btn btn-danger street-delete" value="Удалить">
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>