<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_menus">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($menus as $data):?>
                <tr data-id_menu="<?= $data->id;?>">
                    <td><?echo $data->id;?></td>
                    <td><?= $data->name;?></td>
                    <td>
                        <input type="button" class="btn btn-success menu-pages" value="Страницы">
                        <input type="button" class="btn btn-warning menu-edit" value="Редактировать">
                        <input type="button" class="btn btn-danger menu-del" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('table[id="table_menus"]').dataTable({});

    $(document).on('click', '.page-menu-delete', function()
    {
        bootbox.hideAll();
    });
</script>
