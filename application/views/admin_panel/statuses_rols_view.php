<script>
    $(document).ready(function() {
        $('select#statuses-rols').chosen();
        $('.chosen-container-multi').attr('style', 'width: 100%;');
        $('select#statuses-rols').attr('style', 'display:none;')
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <form id="manipulation-statuses-rols">
<!--            <input type="hidden" name="id" value="--><?//= $id;?><!--">-->
            <select name="id_statuses[]" id="statuses-rols" data-placeholder="Выберите статус(ы)..." class="chosen-container chosen-container-multi" multiple style="width: 100%;">
                <?if(!empty($all_status)) : ?>
                    <?foreach($all_status as $status):?>
                        <option value="<?= $status->id ;?>"
                            <? if(!empty($selected)) : ?>
                                <?foreach($selected as $value):
                                    if($value->id_statuses == $status->id) echo 'selected' ;?>
                                <? endforeach ;?>
                            <? endif ;?>>
                            <?= $status->name ;?>
                        </option>
                    <?endforeach;?>
                <? else : ?>
                    <option disabled>Нет созданых статусов</option>
                <? endif ;?>
            </select>
            <br>
        </form>
    </div>
</div>

