<style>
    @font-face {
        font-family: Lato; /* Имя шрифта */
        src: url(assets/fonts/Lato2OFL/Lato-Thin.ttf); /* Путь к файлу со шрифтом */
    }
    .form-horizontal {
        font-family: Lato;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal">
            <label for="new_password">Новый пароль</label>
            <input type="password" class="form-control-registration" name="new_password" value="">
            <label for="confim_password">Повторить пароль</label>
            <input type="password" class="form-control-registration" name="confim_password" value="">
            <input type="hidden" name="id" value="<?=$id;?>" />
            <input type="button" class="btn btn-success reset_password" value="Восстановить">
        </form>
    </div>
</div>
