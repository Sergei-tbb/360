<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Параметры</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info add-parameter">Создать параметр</button>
    </div>
</div>
<br>

<div class="parameters-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Parameters/display_all/',
            success: function(data)
            {
                $('.parameters-body').html(data);
            },
            error: function(data)
            {
                $('.parameters-body').html(data);
            }
        });
    });
</script>