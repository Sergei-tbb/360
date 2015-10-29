<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table_faq">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Страница</th>
                    <th>Опубликована</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($faq as $data):?>
                <tr data-id_faq="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->title;?></td>
                    <td>
                        <input type="checkbox" class="is_published_faq" <?if($data->is_published==1): echo 'checked="checked"'; else: echo ''; endif;?>>
                    </td>
                    <td>
                        <input type="button" class="btn btn-warning faq-edit" value="Изменить">
                        <input type="button" class="btn btn-danger faq-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#table_faq').DataTable();
</script>