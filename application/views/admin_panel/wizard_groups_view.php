<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Группы параметров</h1>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-info add-group">Создать новую группу</button>
    </div>
</div>
<br>

<div class="groups-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/wizard/Groups/display_all/',
            success: function(data)
            {
                $('.groups-body').html(data);
            },
            error: function(data)
            {
                $('.groups-body').html(data);
            }
        });
    });
</script>