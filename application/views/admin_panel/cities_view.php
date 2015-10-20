<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Города</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="city-add">Создать город</button>
    </div>
</div>
<br>

<div class="cities-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_cities/get_list_cities/',
            success: function(data)
            {
                $('.cities-body').html(data);
            },
            error: function(data)
            {
                $('.cities-body').html(data);
            }
        });
    });
</script>