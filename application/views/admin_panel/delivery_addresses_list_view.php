<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Служба доставки</th>
                <th>Адресс</th>
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
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>