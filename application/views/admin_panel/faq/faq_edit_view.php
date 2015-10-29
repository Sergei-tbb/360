<div class="row">
    <div class="col-lg-12">
        <?foreach($faq as $data):?>
        <label for="title">Заголовок страницы</label>
        <input type="text" class="form-control" name="title" value="<?=$data->title;?>">
        <label for="page_data">Текст страницы</label>
        <textarea name="page_data" class="form-control" rows="5" cols="5"><?=$data->page_data;?></textarea>
            <input type="hidden" name="id" value="<?=$data->id;?>">
        <?endforeach;?>
    </div>
</div>
<script>
    CKEDITOR.replace('page_data');
</script>