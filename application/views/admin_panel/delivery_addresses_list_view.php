<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Служба доставки</th>
                <th>Адрес</th>
                <th></th>
            </tr>
            <tbody>
            <?foreach($addresses as $address):?>
                <tr data-id_address="<?=$address->address_id;?>">
                    <td><?=$address->address_id;?></td>
                    <td><?=$address->company_name;?></td>
                    <td>
                        <?
                        echo $address->country_name.', '.$address->region_name.', г. '.
                            $address->city_name.', ул. '.$address->street_name.' '.$address->house_number.',<br> Отделение № '.
                            $address->department_number.', Индекс '.$address->zip.', Телефон '.$address->phone;
                        ?>
                    </td>
                    <td>
                        <input type="button" class="btn btn-danger department-delete" value="Удалить">
                    </td>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>