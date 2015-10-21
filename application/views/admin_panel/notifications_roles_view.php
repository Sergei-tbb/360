<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="roles_name"]').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select[name="roles_name"]').attr('style', 'display:none;')
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <select name="roles_name" data-placeholder="Выберите роли..." class="chosen-container chosen-container-multi" multiple style="width:550px;">
            <?foreach($roles as $data):?>
                <option value="<?=$data->id;?>"
                <?foreach($selected as $value):
                    if($value->selected==$data->id) echo 'selected="selected"'; else echo ''; endforeach;?>>
                    <?=$data->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?= $id['id'];?>">
        <br><br>
    </div>
</div>
