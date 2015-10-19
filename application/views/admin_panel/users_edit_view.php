<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal users_form">
            <?foreach($user as $data):?>
            <label for="name">Имя</label>
            <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" class="form-control" value="<?=$data->surname;?>">
            <label for="middlename">Отчетство</label>
            <input type="text" name="middlename" class="form-control" value="<?=$data->middlename;?>">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" value="<?=$data->email;?>">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" value="<?=$data->password;?>">
            <?endforeach;?>
            <label for="roles">Роль пользователя</label>
            <select name="roles" class="form-control">
                <option value="def">Выберите роль пользователя</option>
                <?foreach($roles as $role):?>
                    <option value="<?if(!empty($role->id)) echo $role->id; else echo '';?>"
                        <?if($data->id_user_role==$role->id) echo 'selected="selected"'; else echo '';?>>
                        <?if(!empty($role->name)) echo $role->name; else echo '';?></option>
                <?endforeach;?>
            </select>
            <input type="hidden" name="id" value="<?=$id;?>">
        </form>
    </div>
</div>