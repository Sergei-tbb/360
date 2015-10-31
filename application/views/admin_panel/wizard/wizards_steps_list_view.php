<div class="row">
    <div class="col-lg-12">
        <form id="table_wizard_steps">
            <label for="steps">Список шагов</label>
            <select name="steps" class="form-control">
                <option value="0">Выберите шаг</option>
                <?foreach($steps as $data):?>
                    <option value="<?=$data->id;?>"
                        <?
                        foreach($wizard_steps as $value):
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
        </form>
    </div>
</div>