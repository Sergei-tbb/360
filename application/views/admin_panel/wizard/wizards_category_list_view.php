<div class="row">
    <div class="col-lg-12">
        <label for="wizards">Мастер заказов</label>
        <select name="wizards" class="form-control">
            <option value="0">Выберите мастер заказов</option>
            <?foreach($wizards as $data):?>
                <option value="<?=$data->id;?>"
                    <?
                    foreach($wizard_categories as $value):
                        if($value->id_wizard==$data->id)
                            echo 'selected="selected"';
                        else
                            echo '';
                    endforeach;
                    ?>>
                    <?=$data->name;?>
                </option>
            <?endforeach;?>
        </select>
        <input type="hidden" name="id" value="<?=$id['id'];?>">
    </div>
</div>