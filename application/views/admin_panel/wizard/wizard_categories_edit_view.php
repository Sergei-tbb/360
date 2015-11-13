<div class="row">
    <div class="col-lg-12">
        <form id="edit_category">
            <?foreach($category as $data):?>
            <input type="hidden" class="form-control" name="id" value="<?=$data->id;?>">
            <label for="name">Название категории</label>
            <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
            <label for="image-category">Выберите картинку категории:</label>
            <input id="image-category" class="form-control" type="file" name="image" required value="<? if(!empty($data->image)) echo $data->name;?>" />
            <span>Максимальное разрешение файла 100px*100px, размер 50kB. Формат jpg, png, gif</span>
    <img id="preview-img" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/wizard_images/categories/<? echo (!empty($data->picture))
        ? $data->picture
        : "default.png" ;?>" />
            <?endforeach;?>
        </form>
    </div>
    <script>
        $("#image-category").change(function(){
            readURL(this);
        });

    </script>
</div>
</div>

