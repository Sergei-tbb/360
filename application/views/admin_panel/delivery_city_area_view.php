<div class="row">
    <div class="col-lg-12">
        <label for="city">Город</label>
        <select name="city" class="form-control">
            <option value="0">Укажите город</option>
            <?foreach($cities as $city):?>
                <option value="<?=$city->id;?>"
                <?foreach($cities_areas as $data):
                    if($data->id_city==$city->id):
                        echo 'selected="selected"';
                    else:
                        echo '';
                    endif;
                endforeach;?>>
                    <?=$city->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id;?>">
    </div>
</div>