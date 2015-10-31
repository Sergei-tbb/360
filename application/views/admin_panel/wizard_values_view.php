<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Значения</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info add-value">Создать значение</button>
    </div>
</div>
<br>

<div class="values-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Types_values/display_all/',
            success: function(data)
            {
                $('.values-body').html(data);
            },
            error: function(data)
            {
                $('.values-body').html(data);
            }
        });
    });
</script>