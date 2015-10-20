<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal users_form">
            <label for="name">Имя</label>
            <input type="text" name="name" class="form-control" value="">
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" class="form-control" value="">
            <label for="middlename">Отчетство</label>
            <input type="text" name="middlename" class="form-control" value="">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" value="">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" value="">
            <label for="roles">Роль пользователя</label>
            <select name="roles" class="form-control">
                <option value="def">Выберите роль пользователя</option>
                <?foreach($roles as $role):?>
                    <option value="<?if(!empty($role->id)) echo $role->id; else echo '';?>">
                        <?if(!empty($role->name)) echo $role->name; else echo '';?></option>
                <?endforeach;?>
            </select>
        </form>
    </div>
</div>