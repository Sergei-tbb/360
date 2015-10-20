<?foreach($menu as $data):?>
    <div class="row">
        <div class="col-lg-12">
            <label for="name">Название меню</label>
            <input type="text" name="name" class="form-control" value="<?= $data->name;?>">
            <input type="hidden" name="id" value="<?= $data->id;?>">
        </div>
    </div>
<?endforeach;?>