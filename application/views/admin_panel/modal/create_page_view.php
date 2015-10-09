<?
$date = date('Y-m-d');
?>
<div class="row">
    <div class="form-group">
        <div class="col-lg-12">
            <label for="title">Заголовок страницы:</label>
            <input type="text" class="form-control" name="title"><br>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label for="page">Ссылка на страницу:</label>
            <input type="text" class="form-control" name="page"><br>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label for="date_time">Дата создания:</label>
            <input type="text" value="<?=$date;?>" class="form-control" name="date_time" readonly><br>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label for="keywords">Ключевые слова:</label>
            <textarea name="keywords" cols="3" rows="3" class="form-control"></textarea><br>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label for="description">Описание:</label>
            <textarea name="description" cols="3" rows="3" class="form-control"></textarea><br>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label for="page_data">Текст страницы:</label>
            <textarea name="page_data" cols="3" rows="3" class="form-control"></textarea><br>
        </div>
    </div>
</div>