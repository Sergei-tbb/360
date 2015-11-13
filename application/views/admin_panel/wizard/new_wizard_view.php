<div class="row">
    <div class="col-lg-12">
        <form id="new_wizard">
            <label for="name">Имя мастера заказа</label>
            <input type="text" name="name" class="form-control" value="">
            <label for="image-wizard">Выберите картинку мастера заказа:</label>
            <input id="image-wizard" class="form-control" type="file" name="image" required value="<? if(!empty($wizard->image)) echo $wizard->name;?>" />
            <span>Максимальное разрешение файла 100px*100px, размер 50kB. Формат jpg, png, gif</span>
        </div>
        </form>
        <img id="preview-img" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/wizard_images/<? echo (!empty($wizard->picture))
            ? $wizard->picture
            : "default.png" ;?>" />
        <script>
            $("#image-wizard").change(function(){
                readURL(this);
            });

        </script>
    </div>
</div>

