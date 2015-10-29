<div class="row">
    <div class="col-lg-12">
        <label for="country">Страна</label>
        <select name="country" class="form-control">
            <option value="0">Укажите страну</option>
            <?foreach($countries as $country):?>
                <option value="<?=$country->id?>">
                    <?=$country->name;?>
                </option>
            <?endforeach;?>
        </select>

        <div class="regions">

        </div>

        <div class="cities">

        </div>

        <div class="streets">

        </div>

        <div class="input_text">

        </div>
        <input type="hidden" name="id" value="<?=$id?>">
    </div>
</div>

<script>
    $('select[name="country"]').on('change', function()
    {
        var country = $('select[name="country"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_regions/'+country,
            success: function(data)
            {
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
                $('.cities').html(data);
            }
        });
    });

    $(document).on('change', 'select[name="city"]',function()
    {
        var city = $('select[name="city"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_streets/'+city,
            success: function(data)
            {
                $('.streets').html(data);
            }
        });
    });

    $(document).on('change', 'select[name="street"]',function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/load_inputs/',
            success: function(data)
            {
                $('.input_text').html(data);
            }
        });
    });
</script>