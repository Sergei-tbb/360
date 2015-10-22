<label for="street">Улица</label>
<select name="street" class="form-control">
    <option value="0">Укажите регион</option>
    <?foreach($streets as $street):?>
        <option value="<?=$street->id?>">
            <?=$street->name;?>
        </option>
    <?endforeach;?>
</select>