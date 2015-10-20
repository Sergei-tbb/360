<?foreach($notification as $data):?>
    <div class="row">
        <div class="col-lg-12">
            <label for="title">Название уведомления</label>
            <input type="text" name="title" class="form-control" value="<?if(!empty($data->title)) echo $data->title; else echo '';?>">
            <label for="notification">Текст уведомления</label>
            <textarea name="notification" class="form-control" cols="3" rows="2"><?if(!empty($data->notification)) echo $data->notification; else echo '';?></textarea>
            <input type="hidden" name="id" value="<?= $data->id;?>">
        </div>
    </div>
<?endforeach;?>