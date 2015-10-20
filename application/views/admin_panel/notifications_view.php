<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Уведомления</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="notifications-add">
            Создать новое уведомление
        </button>
    </div>
</div>
<br>
<div class="notifications-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/Notifications/get_list_notifications/',
            success: function(data)
            {
                $('.notifications-body').html(data);
            },
            error: function(data)
            {
                $('.notifications-body').html(data);
            }
        });
    });
</script>