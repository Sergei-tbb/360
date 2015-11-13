<div class="row">
    <div class="col-lg-12">
        <?foreach($area as $data):?>
        <label for="name">Район</label>
        <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
        <input type="hidden" name="id" value="<?=$data->id;?>">
        <?endforeach;?>
    </div>
</div>