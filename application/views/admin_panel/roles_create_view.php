
<form id="create-role">
    <div class="form-group">
        <label for="name-role">Введите название роли: </label>
        <? if(empty($role)) : ?>
            <input type="text" class="form-control" required name="name" id="name-role" />
        <? else : ?>
            <input type="text" class="form-control" required name="name" id="name-role" value="<?= $role->name ;?>"/>
        <? endif ;?>
    </div>
</form>