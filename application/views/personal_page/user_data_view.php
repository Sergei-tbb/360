<div class="row">
    <div class="col-lg-12">
        <?foreach($user as $data):?>
        <label for="name_m">Имя</label>
        <input type="text" name="name_m" class="form-control" value="<?=$data->name;?>">
        <label for="middlename_m">Отчество</label>
        <input type="text" name="middlename_m" class="form-control" value="<?=$data->middlename;?>">
        <label for="surname_m">Фамилия</label>
        <input type="text" name="surname_m" class="form-control" value="<?=$data->surname;?>">
        <label for="email_m">E-mail</label>
        <input type="text" name="email_m" class="form-control" value="<?=$data->email;?>">
        <label for="phone_m">Телефон</label>
        <input type="text" name="phone_m" class="form-control" value="<?if(!empty($phone['0']->phone)) echo $phone['0']->phone; else echo '';?>">
        <input type="hidden" name="id" value="<?=$data->id;?>">
        <input type="hidden" name="id_phone" value="<?if(!empty($phone['0']->id_phone)) echo $phone['0']->id_phone; else echo '';?>">
        <?endforeach;?>
    </div>
</div>