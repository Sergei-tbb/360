
<?
if($this->session->has_userdata('id'))
{
    ?>
    <input type="button" class="btn btn-success logout" value="Выйти">
    <?
}
elseif(!$this->session->has_userdata('id'))
{?>
<input type="button" class="btn btn-success registration" value="Регистрация">
<input type="button" class="btn btn-success authorization" value="Авторизация">
<?}?>