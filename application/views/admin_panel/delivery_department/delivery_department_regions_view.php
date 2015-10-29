<label for="region">Регионы</label>
<select name="region" class="form-control">
    <option value="0">Укажите регион</option>
    <?foreach($regions as $region):?>
        <option value="<?=$region->id?>">
            <?=$region->name;?>
        </option>
    <?endforeach;?>
</select>