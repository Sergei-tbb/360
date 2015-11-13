<div class="row">
    <div class="col-lg-12">
        <form id="edit_step">
            <?foreach($step as $data):?>
            <label for="name">Название шага</label>
            <input type="text" class="form-control" name="name" value="<?=$data->name;?>">
            <input type="hidden" name="id" value="<?=$data->id;?>">
            <?endforeach;?>
        </form>
    </div>
</div>