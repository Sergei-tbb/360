<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Отделения</h1>
    </div>
    <div class="col-sm-12">
    </div>
</div>
<br>

<div class="addresses-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_addresses/get_list_addresses/',
            success: function(data)
            {
                $('.addresses-body').html(data);
            },
            error: function(data)
            {
                $('.addresses-body').html(data);
            }
        });
    });
</script>