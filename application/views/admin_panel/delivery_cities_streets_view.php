<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="streets"]').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select[name="streets"]').attr('style', 'display:none;')
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <label for="streets">Улицы</label>
        <select name="streets" multiple class="form-control" data-placeholder="Выберите улицы...">
            <?foreach($streets as $data):?>
                <option value="<?=$data->street_id;?>"
                    <?foreach($cities as $city):
                        if($city->id==$data->id_city):
                            echo 'selected="selected"';
                        else:
                            echo '';
                        endif;
                    endforeach;?>>
                    <?=$data->street_name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id;?>">

    </div>
</div>