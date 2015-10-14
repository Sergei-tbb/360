<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Страницы</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="page-add">
            Создать новую страницу
        </button>
    </div>
</div>
<br>
<div class="pages-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/Pages/pages_list/',
            success: function(data)
            {
                $('.pages-body').html(data);
            },
            error: function(data)
            {
                $('.pages-body').html(data);
            }
        });
    });
</script>