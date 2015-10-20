<!--<script>tinymce.init({selector: '.page_data'});</script>-->

<?$date = date('Y-m-d');?>
<div class="row">
    <div class="col-lg-12">
        <label for="title">Заголовок страницы</label>
        <input type="text" name="title" class="form-control" value="">
        <label for="date_time">Дата создания</label>
        <input type="text" name="date_time" class="form-control" value="<?echo $date;?>" readonly>
        <label for="keywords">Ключевые слова</label>
        <input type="text" name="keywords" class="form-control" value="">
        <label for="description">Описание страницы</label>
        <textarea name="description" class="form-control" rows="2" cols="2"></textarea>
        <label for="page_data">Текст страницы</label>
        <textarea name="page_data" class="form-control" rows="5" cols="5"></textarea>
    </div>
</div>
<script>
    CKEDITOR.replace('page_data');
</script>