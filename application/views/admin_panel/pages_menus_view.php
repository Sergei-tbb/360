<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th></th>
            </tr>
            <?foreach($pages as $data):?>
            <tbody>
                <tr data-menu_page="<?=$data->mp_id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->title;?></td>
                    <td><input type="button" class="btn btn-danger page-menu-delete" name="del-page-menu" value="Удалить из меню"></td>
                </tr>
            </tbody>
            <?endforeach;?>
        </table>
    </div>
</div>