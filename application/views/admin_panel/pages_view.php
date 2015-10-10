<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Страницы</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-primary create_page" data-toggle="modal" data-target="#pages_modal">
            Создать новую страницу
        </button>
    </div>
</div>
<br>
<div class="panel panel-default">
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Страница</th>
                    <th>Дата создания</th>
                    <th>Опубликована</th>
                    <th></th>
                </tr>
                </thead>
                <?foreach($pages as $data):
                    $date = new DateTime($data['date_time']);
                    $date_result = $date->format('d.m.Y');
                ?>
                    <tr data-id_page="<?=$data['id'];?>">
                        <td><?if(empty($data['title'])) echo ''; else echo $data['title']; ?></td>
                        <td><?if(empty($data['date_time'])) echo ''; else echo $date_result;?></td>
                        <td><input type="checkbox" name="is_published" class="checkbox" <?if($data['is_published']==1) echo 'checked="checked"'; else echo '';?>></td>
                        <td>
                            <button type="button" class="btn btn-warning edit_page" data-toggle="modal" data-target="#pages_modal">Изменить</button>
                            <button type="button" class="btn btn-danger delete_page">Удалить</button>
                        </td>
                    </tr>
                <?endforeach; ?>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>


<!-- Modal -->
<div class="modal fade" id="pages_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url();?>assets/admin_panel/admin_panel.js"></script>
