<form id="create-statuses" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name-status">Введите название статуса: </label>
<!--            <input type="hidden" name="id" value="--><?// if(!empty($statuses->id)) echo $statuses->id ?><!--"/>-->
            <input  id="name-status" class="form-control" type="text" name="name" required value="<? if(!empty($statuses->name)) echo $statuses->name;?>" />
        </br>
        <label for="name-status">Выберите картинку статуса:</label>
        <input id="image-statuses" class="form-control" type="file" name="image" required value="<? if(!empty($statuses->image)) echo $statuses->name;?>" />
        <span>Максимальное разрешение файла 100px*100px, размер 50kB</span>
    </div>
</form>
<img id="preview-img" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/statuses_image/<? echo (!empty($statuses->picture))
                                                                                                                                        ? $statuses->picture
                                                                                                                                        : "default.png" ;?>" />
<script>
    $("#image-statuses").change(function(){
        readURL(this);
    });

</script>