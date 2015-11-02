<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Категории мастера заказов</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="add-category">Создать категорию</button>
    </div>
</div>
<br>

<div class="categories-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Categories/display_all/',
            success: function(data)
            {
                $('.categories-body').html(data);
            },
            error: function(data)
            {
                $('.categories-body').html(data);
            }
        });
    });
</script>