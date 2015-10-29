<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 14.10.15
 * Time: 9:46
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Страны</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="country-add">Создать страну</button>
    </div>
</div>
<br>

<div class="countries-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_countries/get_list_countries/',
            success: function(data)
            {
                $('.countries-body').html(data);
            },
            error: function(data)
            {
                $('.countries-body').html(data);
            }
        });
    });
</script>