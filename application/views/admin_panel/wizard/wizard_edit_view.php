<div class="row">
    <div class="col-lg-12">
        <form id="wizard_edit">
            <?foreach($wizard as $data):?>
            <input type="hidden" name="id" value="<?=$data->id;?>">
            <label for="name">Имя мастера заказа</label>
            <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
            <label for="image-wizard">Выберите картинку мастера заказа:</label>
            <input id="image-wizard" class="form-control" type="file" name="image" required value="<? if(!empty($data->picture)) echo $data->name;?>" />
            <span>Максимальное разрешение файла 100px*100px, размер 50kB. Формат jpg, png, gif</span>
            <?endforeach;?>
        </form>
    </div>
    <img id="preview-img" style="max-width: 200px;" class="img-responsive center-block" src="<?=base_url();?>download/wizard_images/<? echo (!empty($data->picture))
        ? $data->picture
        : "default.png" ;?>" />
    <script>
        $("#image-wizard").change(function(){
            readURL(this);
        });

    </script>
</div>
</div>

