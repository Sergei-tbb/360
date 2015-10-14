<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($menus as $data):?>
                <tr data-id_menu="<?= $data->id;?>">
                    <td><?echo $data->id;?></td>
                    <td><?= $data->name;?></td>
                    <td>
                        <input type="button" class="btn btn-warning menu-edit" value="Редактировать">
                        <input type="button" class="btn btn-danger menu-del" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>