<div class="row">
    <div class="col-lg-12">
        <?foreach($company as $data):?>
        <label for="name">Имя компании</label>
        <input type="text" class="form-control" name="name" value="<?=$data->name;?>">
        <label for="website">Сайт компании</label>
            <input type="text" class="form-control" name="website" value="<?=$data->website;?>">
        <input type="hidden" name="id" value="<?=$data->id;?>">
        <?endforeach;?>
    </div>
</div>