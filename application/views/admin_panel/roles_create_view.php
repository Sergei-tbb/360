
<form id="create-role">
    <div class="form-group">
        <label for="name-role">Введите название роли: </label>
        <input type="text" class="form-control" required name="name" id="name-role" value="<? if(!empty($role->name)) echo $role->name ;?>"/>
        <label for="name-role">Выберите статус: </label>
    </div>
</form>