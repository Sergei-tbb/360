<script>tinymce.init({selector: '.page_data'});</script>
<?foreach($pages as $data):?>
<div class="row">
    <div class="col-lg-12">
        <label for="title">Заголовок страницы</label>
        <input type="text" name="title" class="form-control" value="<?= $data->title;?>">
        <label for="keywords">Ключевые слова</label>
        <input type="text" name="keywords" class="form-control" value="<?= $data->keywords;?>">
        <label for="description">Описание страницы</label>
        <textarea name="description" class="form-control" rows="2" cols="2"><?= $data->description;?></textarea>
        <label for="page_data">Текст страницы</label>
        <textarea class="page_data" class="form-control" rows="5" cols="5"><?= $data->page_data;?></textarea>
        <input type="hidden" name="id" value="<?= $data->id;?>">
    </div>
</div>
<?endforeach;?>