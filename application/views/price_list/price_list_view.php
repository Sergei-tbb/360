<? if (empty($price_list)) : ?>
    Данне прайс-листа отсутствуют
<? else : ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="table-price-list" class="table hover" style="color: #000;">
                <thead>
                <tr>
                    <th>Параметр</th>
                    <th>Группа</th>
                    <th>Единицы измерения</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                <? foreach($price_list as $data):?>
                    <tr>
                        <td><? if(!empty($data->parameter)) echo $data->parameter ;?></td>
                        <td><? if(!empty($data->groups)) echo $data->groups ;?></td>
                        <td><? if(!empty($data->unit)) echo $data->unit ;?></td>
                        <td><? if(!empty($data->price)) echo $data->price ;?></td>
                    </tr>
                <? endforeach ;?>
                </tbody>
            </table>
        </div>
    </div>
<? endif ;?>

<script>
    $('#table-price-list').DataTable();
</script>
