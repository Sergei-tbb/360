<div class="row">
    <div class="col-lg-12">
        <?foreach($region as $data):?>
        <label for="region">Регион</label>
        <input type="text" name="region" class="form-control" value="<?=$data->name;?>">

        <label for="country">Страна</label>
        <select name="country" class="form-control">
            <option value="def">Выберите страну...</option>
            <?foreach($countries as $val):?>
                <option value="<?=$val->id;?>"
                    <?if($val->id==$data->id_country)
                    echo 'selected="selected"';
                    else echo '';?>>
                    <?=$val->name;?>
                </option>
            <?endforeach;?>
        </select>
            <input type="hidden" name="id" value="<?=$id;?>">
        <?endforeach;?>
    </div>
</div>