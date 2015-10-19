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
                <tr data-id_address="<?=$address->id;?>">
                    <td><?=$address->id;?></td>
                    <td><?
                        foreach($companies as $company):
                            if($company->id==$address->id_company)
                                echo $company->name;
                            else
                                echo '';
                        endforeach;
                        ?>
                    </td>
                    <td>
                    <?foreach($rcs as $regions_cities_streets):
                        if($regions_cities_streets->id==$address->id_region_city_street)
                        foreach($rc as $regions_cities):
                            if($regions_cities_streets->id_region_city==$regions_cities->id)
                                foreach($regions as $region):
                                    if($regions_cities->id_region==$region->id)
                                        foreach($cities as $city):
                                            if($regions_cities->id_city==$city->id)
                                                foreach($streets as $street):
                                                    if($street->id==$regions_cities_streets->id_street)
                                                        echo $region->name.', г.'.$city->name.', '.$street->name.', '.$address->house_number.
                                                            ',<br> Отделение № '.$address->department_number.', Почтовый индекс: '.$address->zip.
                                                            ', Телефон: '.$address->phone;
                                    endforeach;
                                endforeach;
                            endforeach;
                        endforeach;
                    endforeach;
                    ?>

                    </td>
                    <td>
                        <input type="button" class="btn btn-danger department-delete" value="Удалить">
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>