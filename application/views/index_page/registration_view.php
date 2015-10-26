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
            <label for="email">E-mail</label>
            <input type="text" class="form-control-registration" name="email" value="">
            <br>
            <label for="password">Пароль</label>
            <input type="password" class="form-control-registration" name="password" value="">
            <br>
            <label for="name">Имя</label>
            <input type="text" class="form-control-registration" name="name" value="">
            <br>
            <label for="phone">Телефон</label>
            <input type="text" class="form-control-registration" name="phone" value="">
            <br>
            <input type="checkbox" name="i_agree" class="form-control-registration-checkbox"> Я согласен с Правилами регистрации
            <input type="hidden" name="token" value="<?=$token;?>" />
        </form>
    </div>
</div>