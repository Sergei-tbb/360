<form id="create-statuses" enctype="multipart/form-data" xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="name-status">Введите название статуса: </label>
            <input type="text" class="form-control" required name="name" id="name-status" value="<? if(!empty($status->name)) echo $status->name;?>" />
        </br>
        <label for="name-status">Выберите картинку статуса:</label>
        <input type="file" class="form-control" required name="image" id="image-status" value="<? if(!empty($status->image)) echo $status->name;?>" />
        <span>Максимальный размер файла 1М</span>
    </div>
</form>
<img id="blah" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/statuses_image/default.png" />
<script>
    $("#image-status").change(function(){
        readURL(this);
    });
</script>