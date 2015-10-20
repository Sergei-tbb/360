<div class="row">
    <div class="col-lg-12">
        <label for="menu">Меню</label>
        <select name="menu" class="form-control" data-id_page="<??>">
            <option value="def">Укажите меню для отображения в нем страницы</option>
            <?foreach($menu as $data):?>
                <option value="<?=$data->menu_id;?>" data-id_page="<?=$data->id;?>"><?= $data->name;?></option>
            <?endforeach;?>
        </select>
    </div>
</div>