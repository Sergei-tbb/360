
<form id="create-role">
    <div class="form-group">
        <label for="name-role">Введите название роли: </label>
        <input type="text" class="form-control" required name="name" id="name-role" value="<? if(!empty($role->name)) echo $role->name ;?>"/>
        <label for="name-role">Выберите статус: </label>
        <select class="form-control" name="statuses[]" multiple>
            <option value="0">Ни одного статуса нет</option>
            <?$select = "";?>
            <? foreach($role['statuses'] as $status) : ?>
                <option value="<?= $status->id ;?>" <?= $select ;?>><?= $status->name ;?></option>
            <? endforeach ;?>
        </select>
    </div>
</form>