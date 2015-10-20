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
        <h1 class="page-header">Службы доставки</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="delivery-add">Создать новую службу доставки</button>
    </div>
</div>
<br>

<div class="delivery-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery/get_list_delivery_companies/',
            success: function(data)
            {
                $('.delivery-body').html(data);
            },
            error: function(data)
            {
                $('.delivery-body').html(data);
            }
        });
    });
</script>