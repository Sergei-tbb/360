<div class="row">
    <div class="col-lg-12">
        <form id="edit_value">
            <?foreach($step as $data):?>
            <label for="value">Значение</label>
            <input type="text" class="form-control" name="value" value="<?=$data->value;?>">
            <input type="hidden" name="id" value="<?=$data->id;?>">
            <?endforeach;?>
        </form>
    </div>
</div>