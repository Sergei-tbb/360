<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Страницы</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Изменить</th>
                    <th>Страница</th>
                    <th>Дата создания</th>
                    <th>Опубликована</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <?foreach($pages as $data): ?>
                    <tr data-id_page="<?=$data['id'];?>">
                        <td><span class="edit_page" ><i class="glyphicon glyphicon-pencil" title="Изменить"></i></span></td>
                        <td><?if(empty($data['page'])) echo 'пусто'; else echo $data['page']; ?></td>
                        <td><?if(empty($data['date_time'])) echo 'пусто'; else echo $data['date_time'];?></td>
                        <td><input type="checkbox" name="is_published" class="checkbox" <?if($data['is_published']==1) echo 'checked="checked"'; else echo '';?>></td>
                        <td><span class="delete_page"><i class="glyphicon glyphicon-remove" title="Удалить"></i></span></td>
                    </tr>
                <?endforeach; ?>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<script src="<?=base_url();?>assets/admin_panel/admin_panel.js"></script>