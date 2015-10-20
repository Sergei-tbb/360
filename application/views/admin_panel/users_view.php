<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Пользователи</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="user-add">
            Создать нового пользователя
        </button>
    </div>
</div>
<br>
<div class="users-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/Users/get_list_users/',
            success: function(data)
            {
                $('.users-body').html(data);
            },
            error: function(data)
            {
                $('.users-body').html(data);
            }
        });
    });
</script>