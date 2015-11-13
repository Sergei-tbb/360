<?foreach($department as $data):?>
<div class="row">
    <div class="col-lg-12">
        <label for="country">Страна</label>
        <select name="country" class="form-control">
            <option value="0">Укажите страну</option>
            <?foreach($countries as $country):?>
                <option value="<?=$country->id?>"
                    <?if($data->id_country==$country->id): echo 'selected="selected"'; else: echo ''; endif;?>>
                    <?=$country->name;?>
                </option>
            <?endforeach;?>
        </select>
        <div class="regions">
            <label for="region">Регион</label>
            <select name="region" class="form-control">
                <option value="0">Укажите регион</option>
                <?foreach($regions as $region):?>
                    <option value="<?=$region->id;?>"
                    <?if($data->id_region==$region->id): echo 'selected="selected"'; else: echo ''; endif;?>>
                        <?=$region->name;?>
                    </option>

                <?endforeach;?>
            </select>
        </div>
        <div class="cities">
            <label for="city">Город</label>
            <select name="city" class="form-control">
                <option value="0">Укажите город</option>
                <?foreach($cities as $city):?>
                    <option value="<?=$city->id;?>"
                        <?if($data->id_city==$city->id): echo 'selected="selected"'; else: echo ''; endif;?>>
                        <?=$city->name;?>
                    </option>

                <?endforeach;?>
            </select>
        </div>
        <div class="areas">
            <label for="area">Район</label>
            <select name="area" class="form-control">
                <option value="0">Укажите район</option>
                <?foreach($areas as $area):?>
                    <option value="<?=$area->id;?>"
                            <?if($data->id_area==$area->id): echo 'selected="selected"'; else: echo ''; endif;?>>
                        <?=$area->name;?>
                    </option>
                <?endforeach;?>
            </select>
        </div>
        <div class="streets">
            <label for="street">Улица</label>
            <select name="street" class="form-control">
                <option value="0">Укажите улицу</option>
                <?foreach($streets as $street):?>
                    <option value="<?=$street->id;?>"
                        <?if($data->id_street==$street->id): echo 'selected="selected"'; else: echo ''; endif;?>>
                        <?=$street->name;?>
                    </option>

                <?endforeach;?>
            </select>
        </div>
        <label for="house_number">Номер дома</label>
        <input type="text" name="house_number" class="form-control" value="<?=$data->house_number;?>">
        <label for="department_number">Номер отделения</label>
        <input type="text" name="department_number" class="form-control" value="<?=$data->department_number;?>">
        <label for="zip">Индекс</label>
        <input type="text" name="zip" class="form-control" value="<?=$data->zip;?>">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" class="form-control" value="<?=$data->phone;?>">
        <label for="schedule">График работы</label>
        <input type="text" name="schedule" class="form-control" value="<?=$data->schedule;?>">
        <label for="location">Местоположение</label>
        <input type="text" name="location" class="form-control" value="<?=$data->location;?>">
        <label for="note">Примечание</label>
        <textarea name="note" class="form-control"><?=$data->note;?></textarea>

        <input type="hidden" name="id_company" value="<?=$data->id_company;?>">
        <input type="hidden" name="id" value="<?=$id?>">
    </div>
</div>
<?endforeach;?>

<script>
    $('select[name="country"]').on('change', function()
    {
        var country = $('select[name="country"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_regions/'+country,
            success: function(data)
            {
                $('.regions').empty();
                $('.regions').html(data);
            }
        });
    });

    $(document).on('change', 'select[name="region"]',function()
    {
        var region = $('select[name="region"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_cities/'+region,
            success: function(data)
            {
                $('.cities').empty();
                $('.cities').html(data);
            }
        });
    });

    $(document).on('change', 'select[name="city"]',function()
    {
        var city = $('select[name="city"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_areas/'+city,
            success: function(data)
            {
                $('.areas').empty();
                $('.areas').html(data);
            }
        });
    });

    $(document).on('change', 'select[name="area"]', function(){
        var area = $('select[name="area"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_streets/'+area,
            success: function(data)
            {
                $('.streets').empty();
                $('.streets').html(data);
            }
        });
    });
</script>
