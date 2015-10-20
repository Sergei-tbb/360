<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Раздел помощи</h1>
    </div>
    <div class="col-sm-12">
        <input type="button" class="btn btn-success faq-add" value="Создать новую страницу помощи">
    </div>
</div>
<br>

<div class="faq-body">

</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            url: '/index.php/ajax/faq/Faq/get_list_faq/',
            success: function(data)
            {
                $('.faq-body').html(data);
            },
            error: function(data)
            {
                $('.faq-body').html(data);
            }
        });
    });
</script>