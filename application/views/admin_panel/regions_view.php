<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Регионы</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="region-add">
            Создать новый регион
        </button>
    </div>
</div>
<br>
<div class="regions-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/delivery/Delivery_regions/get_list_regions/',
            success: function(data)
            {
                $('.regions-body').html(data);
            },
            error: function(data)
            {
                $('.regions-body').html(data);
            }
        });
    });
</script>