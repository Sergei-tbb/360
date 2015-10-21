<div class="row">
    <div class="col-lg-12">
        <label for="name">Город</label>
        <?foreach($city as $data):?>
            <input type="text" class="form-control" name="name" value="<?=$data->name;?>">
        <?endforeach;?>
        <input type="hidden" name="id" value="<?=$id;?>">
    </div>
</div>