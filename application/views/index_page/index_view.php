<body id="page-top">

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">360dpi</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?foreach($pages as $data):?>
                    <li data-id_page="<?=$data->id_page;?>">
                        <a href="#" class="page-scroll static_page"><?=$data->title;?></a>
                    </li>
                <?endforeach;?>

                <li>
                    <a href="<?=base_url();?>index.php/admin_panel/" class="page-scroll">Админ-панель</a>
                </li>
                <?
                if($this->session->has_userdata('id'))
                {
                    ?>
                    <li>
                        <a class="page-scroll personal_page" href="<?=base_url();?>index.php/personal_page/">Личный кабинет</a>
                    </li>
                    <li>
                        <a class="page-scroll logout" href="#">Выйти</a>
                    </li>
                    <?
                }
                elseif(!$this->session->has_userdata('id'))
                {?>
                    <li>
                        <a class="page-scroll registration" href="#">Регистрация</a>
                    </li>
                    <li>
                        <a class="page-scroll authorization">Авторизация</a>
                    </li>

                <?}?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Your Favorite Source of Free Bootstrap Themes</h1>
            <hr>
            <p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
        </div>
    </div>
</header>
<section class="bg-primary" id="about">
    <div class="container">

    </div>
</section>
