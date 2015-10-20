<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="cities"]').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select[name="cities"]').attr('style', 'display:none;')
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <label for="cities">Города</label>
        <select name="cities" multiple class="form-control" data-placeholder="Выберите города...">
            <?foreach($cities as $city):?>
                <option value="<?=$city->id;?>"
                    <?foreach($regions_cities as $data):
                        if($city->id==$data->id_city)
                            echo 'selected="selected"';
                        else
                            echo '';
                    endforeach;
                    ?>>
                    <?=$city->name;?>
                </option>
            <?endforeach;?>
        </select>

        <input type="hidden" name="id" value="<?=$id;?>">
    </div>
</div>