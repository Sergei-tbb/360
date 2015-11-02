<div class="row">
    <div class="col-lg-12">
        <form id="table_steps_groups">
            <label for="groups">Список групп параметров</label>
            <select name="groups" class="form-control">
                <option value="0">Выберите группу параметров</option>
                <?foreach($groups as $data):?>
                    <option value="<?=$data->id;?>"
                        <?
                        foreach($steps_groups as $value):
                            if($value->id_groups_parametrs==$data->id)
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