<div class="row">
    <div class="col-lg-12">
        <label for="region">Регионы</label>
        <select name="region" class="form-control">
            <option>Выберите регион</option>
            <?foreach($regions as $region):?>
                <option value="<?=$region->id;?>">
                    <?=$region->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id;?>"/>
    </div>
</div>