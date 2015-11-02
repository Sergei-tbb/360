<div class="row">
    <div class="col-lg-12">
        <form id="edit_group">
            <?foreach($group as $data):?>
            <label for="name">Название группы</label>
            <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
            <input type="hidden" name="id" value="<?=$data->id;?>">
            <?endforeach;?>
        </form>
    </div>
</div>