<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Улицы</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="street-add">Создать улицу</button>
    </div>
</div>
<br>

<div class="streets-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_streets/get_list_streets/',
            success: function(data)
            {
                $('.streets-body').html(data);
            },
            error: function(data)
            {
                $('.streets-body').html(data);
            }
        });
    });
</script>