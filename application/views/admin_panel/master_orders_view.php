<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Мастер заказов</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info wizard-add">
            Создать мастер заказов
        </button>
    </div>
</div>
<br>
<div class="master-orders-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Wizard/master_orders_list/',
            success: function(data)
            {
                $('.master-orders-body').html(data);
            },
            error: function(data)
            {
                $('.master-orders-body').html(data);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        displayListData("wizard/Wizard", "master_orders_list", "master-orders")
    });
</script>