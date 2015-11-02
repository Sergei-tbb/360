<div class="row">
    <div class="col-lg-12 cat-wiz">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Категория</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?foreach($categories as $data):?>
                    <tr data-id_wizard="<?=$id['id'];?>" data-id_category="<?=$data->id;?>">
                        <td><?=$data->id;?></td>
                        <td><?=$data->name;?></td>
                        <td>
                            <input type="button" class="btn btn-danger delete-wizard-category" value="Удалить">
                        </td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>