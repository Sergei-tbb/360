<label for="area">Район</label>
<select name="area" class="form-control">
    <option value="0">Укажите район</option>
    <?foreach($areas as $area):?>
        <option value="<?=$area->id?>">
            <?=$area->name;?>
        </option>
    <?endforeach;?>
</select>