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
                <option value="<?=$data->id;?>"
                    <?foreach($rcs as $val):
                        if($val->id_street==$data->id) echo 'selected="selected"';
                    endforeach;?>>
                    <?=$data->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="region" value="<?=$region;?>">
        <input type="hidden" name="city" value="<?=$city;?>">

    </div>
</div>