<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Меню</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="menu-add">
            Создать новое меню
        </button>
    </div>
</div>
<br>
<div class="menus-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/Menus/menu_list/',
            success: function(data)
            {
                $('.menus-body').html(data);
            },
            error: function(data)
            {
                $('.menus-body').html(data);
            }
        });
    });
</script>