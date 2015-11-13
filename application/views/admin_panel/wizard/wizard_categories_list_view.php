<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover" id="table-wizard-categories">
            <thead>
            <tr>
                <th>#</th>
                <th>Категория</th>
                <th>Изображение</th>
                <th>Мастер заказов</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?foreach($categories as $data):?>
                <tr data-id_category="<?=$data->id;?>">
                    <td><?=$data->id;?></td>
                    <td><?=$data->name;?></td>
                    <td><img class="img-rounded center-block" style="max-height: 50px;" src="<?= base_url() ;?>download/wizard_images/categories/<?  if(!empty($data->picture)) echo $data->picture."?".time() ;?>"/>
                    <td>
                        <?foreach($wizards as $value):
                            echo $value->wizard_name;
                        endforeach;?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-success wizard-category" value="Мастер заказов">
                        <input type="button" class="btn btn-warning category-edit" value="Изменить">
                        <input type="button" class="btn btn-danger category-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>