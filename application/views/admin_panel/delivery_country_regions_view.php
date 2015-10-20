<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="regions"]').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select[name="regions"]').attr('style', 'display:none;')
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <select name="regions" data-placeholder="Выберите регионы..." class="chosen-container chosen-container-multi" multiple style="width:550px;">
            <?foreach($regions as $data):?>
                <option value="<?=$data->id;?>">
                    <?=$data->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?= $id;?>">
        <br><br>
    </div>
</div>
