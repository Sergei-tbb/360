<div class="row">
    <div class="col-lg-12">
        <form id="new_category">
            <label for="name">Название категории</label>
            <input type="text" name="name" class="form-control" value="">
            <label for="image-category">Выберите картинку категории:</label>
            <input id="image-category" class="form-control" type="file" name="image" required value="<? if(!empty($category->image)) echo $category->name;?>" />
            <span>Максимальное разрешение файла 100px*100px, размер 50kB. Формат jpg, png, gif</span>
    </div>
    </form>
    <img id="preview-img" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/wizard_images/categories/<? echo (!empty($category->picture))
        ? $category->picture
        : "default.png" ;?>" />
    <script>
        $("#image-category").change(function(){
            readURL(this);
        });

    </script>
</div>
</div>

