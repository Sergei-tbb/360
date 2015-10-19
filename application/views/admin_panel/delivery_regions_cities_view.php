<div class="row">
    <div class="col-lg-12">
        <label for="cities">Города</label>
        <select name="cities" class="form-control">
            <?foreach($cities as $city):?>
                <option value="<?=$city->id;?>">
                    <?=$city->name;?>
                </option>
            <?endforeach;?>
        </select>

        <input type="hidden" name="id" value="<?=$id;?>">
    </div>
</div>