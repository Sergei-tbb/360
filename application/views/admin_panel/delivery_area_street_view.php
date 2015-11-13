<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="id" value="<?=$id;?>">
        <label for="city">Город</label>
        <select name="city" class="form-control">
            <option value="0">Укажите город</option>
            <?foreach($cities as $city):?>
                <option value="<?=$city->id;?>">
                    <?=$city->name;?>
                </option>
            <?endforeach;?>
        </select>
        <div class="areas">

        </div>
    </div>
</div>

<script>
    $('select[name="city"]').on('change', function(){
        var id = $('input[name="id"]').val();
        var id_city = $('select[name="city"] option:selected').val();
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_areas_streets/load_cities_list/'+id_city,
            type: 'POST',
            data: {id: id},
            success: function(data)
            {
                $('div[class="areas"]').empty();
                $('div[class="areas"]').html(data);
            },
            error: function(data)
            {
                $('div[class="areas"]').html(data);
            }
        });
    });
</script>