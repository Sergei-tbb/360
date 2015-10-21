<div class="row">
    <div class="col-lg-12">
        <label for="street">Улица</label>
        <select name="street" class="form-control">
            <?foreach($streets as $street):?>
                <option value="<?=$street->id;?>">
                    <?=$street->name;?>
                </option>
            <?endforeach;?>
        </select>
        <label for="house_number">Номер дома</label>
        <input type="text" name="house_number" class="form-control" value="">
        <label for="house_number">Номер отделения</label>
        <input type="text" name="department_number" class="form-control" value="">
        <label for="house_number">Индекс</label>
        <input type="text" name="zip" class="form-control" value="">
        <label for="house_number">Телефон</label>
        <input type="text" name="phone" class="form-control" value="">
        <label for="country">Страна</label>
        <select name="country" class="form-control">
        <?foreach($countries as $country):?>
            <option value="<?=$country->id;?>">
                <?=$country->name;?>
            </option>
        <?endforeach;?>
        </select>
        <label for="region">Регион</label>
        <select name="region" class="form-control">
            <?foreach($regions as $region):?>
                <option value="<?=$region->id;?>">
                    <?=$region->name;?>
                </option>
            <?endforeach;?>
        </select>
        <label for="city">Город</label>
        <select name="city" class="form-control">
            <?foreach($cities as $city):?>
                <option value="<?=$city->id;?>">
                    <?=$city->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id?>">
    </div>
</div>