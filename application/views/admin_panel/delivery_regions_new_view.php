<div class="row">
    <div class="col-lg-12">
        <label for="region">Регион</label>
        <input type="text" name="region" class="form-control" value="">
        <label for="country">Страна</label>
        <select name="country" class="form-control">
            <option value="def">Выберите страну...</option>
            <?foreach($country as $val):?>
                <option value="<?=$val->id;?>">
                    <?=$val->name;?>
                </option>
            <?endforeach;?>
        </select>
    </div>
</div>