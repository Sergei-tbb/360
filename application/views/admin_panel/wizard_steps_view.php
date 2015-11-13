<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Шаги</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info add-step">Создать шаг</button>
    </div>
</div>
<br>

<div class="steps-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Steps/display_all/',
            success: function(data)
            {
                $('.steps-body').html(data);
            },
            error: function(data)
            {
                $('.steps-body').html(data);
            }
        });
    });
</script>