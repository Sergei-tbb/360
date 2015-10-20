<div class="row">
    <div class="col-lg-12">
        <?foreach($street as $data):?>
        <label for="street">Улица</label>
        <input type="text" name="street" class="form-control" value="<?=$data->name;?>">
            <input type="hidden" name="id" value="<?=$id;?>">
        <?endforeach;?>
    </div>
</div>