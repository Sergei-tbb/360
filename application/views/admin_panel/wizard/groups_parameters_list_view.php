<div class="row">
    <div class="col-lg-12">
        <label for="parameter">Параметры</label>
        <select name="parameter" class="form-control">
            <option value="0">Выберите парамерты</option>
            <?foreach($parameters as $data):?>
                <option value="<?=$data->id;?>"
                    <?
                    foreach($groups_parametrs as $value):
                        if($value->id_parameter==$data->id)
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