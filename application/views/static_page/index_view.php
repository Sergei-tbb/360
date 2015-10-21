<?foreach($page as $data):?>
<div class="row">
    <div class="col-lg-12">
        <h4><?=$data->title;?></h4>
        <div class="content">
            <?=$data->page_data;?>
        </div>
    </div>
</div>
<?endforeach;?>
