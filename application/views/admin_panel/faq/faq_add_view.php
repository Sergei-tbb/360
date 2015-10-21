<div class="row">
    <div class="col-lg-12">
        <label for="title">Заголовок страницы</label>
        <input type="text" class="form-control" name="title" value="">
        <label for="page_data">Текст страницы</label>
        <textarea name="page_data" class="form-control" rows="5" cols="5"></textarea>
    </div>
</div>
<script>
    CKEDITOR.replace('page_data');
</script>