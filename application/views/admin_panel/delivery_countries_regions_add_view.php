<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="region"]').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select[name="region"]').attr('style', 'display:none;')
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <label for="region">Регионы</label>
        <select name="region" data-placeholder="Укажите нужные регионы..." class="form-control" multiple>
            <?foreach($regions as $region):?>
                <option value="<?=$region->region_id;?>"
                    <?if(!empty($selected)):
                        foreach($selected as $select):
                            if($select->id==$region->region_country):
                                echo 'selected="selected"';
                            else:
                                echo '';
                            endif;
                        endforeach;
                    endif;
                    ?>>
                    <?=$region->region_name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id;?>"/>
    </div>
</div>