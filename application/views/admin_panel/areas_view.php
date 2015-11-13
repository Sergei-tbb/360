<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Районы</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info area-add">Создать район</button>
    </div>
</div>
<br>

<div class="areas-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_areas/display_all/',
            success: function(data)
            {
                $('.areas-body').html(data);
            },
            error: function(data)
            {
                $('.areas-body').html(data);
            }
        });
    });
</script>