<label for="city">Город</label>
<select name="city" class="form-control">
    <option value="0">Укажите город</option>
    <?foreach($cities as $city):?>
        <option value="<?=$city->id?>">
            <?=$city->name;?>
        </option>
    <?endforeach;?>
</select>