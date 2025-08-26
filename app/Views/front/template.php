<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('favicon.ico'); ?>" type="image/x-icon">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/libs.bundle.css'); ?>" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.bundle.css'); ?>" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />

    <!-- Personal styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css'); ?>" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="<?= base_url('assets/css/slick.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/slick-theme.css'); ?>" />

    <!-- JQuery -->
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js'); ?>"></script>

    <!--  BasePath: /  -->
    <script>
        var base_url = '<?= base_url(); ?>';
    </script>

    <!-- Title -->
    <title>Chef Ana Paula</title>
</head>
<body class="loading">

<!-- Pantalla de carga -->
<div id="loading-screen" class="loading-screen active">
    <img src="<?= base_url(); ?>assets/img/chef_ana_paula_logo_alt.png" class="logo-loader animate__animated animate__pulse animate__infinite" alt="Cargando...">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar sticky-top navbar-expand-lg bg-white shadow">

    <div class="container d-none d-md-block">

        <div class="row align-items-center justify-content-between">
            <div class="col-2 px-0">
                <a href="<?= base_url(); ?>">
                    <img class="img-fluid" src="<?= base_url('assets/img/logo_chef.svg'); ?>" alt="Chef Ana Paula">
                </a>
            </div>

            <div class="col-3 px-0">
                <form class="form-inline ms-auto px-3 px-md-0 py-4 py-md-0">
                    <input type="search" class="form-control form-control-sm" data-bs-toggle="modal" data-bs-target="#searchModal" placeholder="Buscar recetas...">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('recetas'); ?>">Recetario</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarPages" data-bs-toggle="dropdown"
                           href="<?= base_url('recetas'); ?>" aria-haspopup="true" aria-expanded="false">
                            Recetas
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="navbarPages">
                            <div class="row gx-0">
                                <div class="col-6">
                                    <div class="row gx-0">
                                        <div class="col-12">

                                            <!-- Heading -->
                                            <h6 class="dropdown-header">
                                                Categorías
                                            </h6>

                                            <!-- Placeholder for categories menu -->
                                            <?= view_cell('App\Cells\MenuCell::renderCategoriesMenu'); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row gx-0">
                                        <div class="col-12 col-lg-6">

                                            <!-- Heading -->
                                            <h6 class="dropdown-header">
                                                Temporada
                                            </h6>

                                            <!-- Placeholder for seasonal menu -->
                                            <?= view_cell('App\Cells\MenuCell::renderSeasonalMenu'); ?>

                                        </div>
                                        <div class="col-12 col-lg-6">

                                            <!-- Heading -->
                                            <h6 class="dropdown-header">
                                                Día festivo
                                            </h6>

                                            <!-- Placeholder for holidays menu -->
                                            <?= view_cell('App\Cells\MenuCell::renderHolidayMenu'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- / .row -->
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('videos'); ?>">Videos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('chef-ana-paula'); ?>">Sobre mi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('contacto'); ?>">Contacto</a>
                    </li>

                </ul>

            </div>

        </div>
    </div>

    <div class="container d-sm-flex d-md-none">

        <!-- Brand -->
        <a class="navbar-brand position-relative d-md-none" href="<?= base_url(); ?>">
            <img
                src="<?= base_url(); ?>assets/img/logo_chef.svg"
                class="navbar-brand-img position-absolute navbar-brand-desktop"
                alt="Chef Ana Paula"
            />
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse flex-grow-0" id="navbarCollapse">

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-x"></i>
            </button>

            <!-- Navigation -->

            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarPages" data-bs-toggle="dropdown"
                       href="<?= base_url('recetas'); ?>" aria-haspopup="true" aria-expanded="false">
                        Recetas
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="navbarPages">
                        <div class="row gx-0">
                            <div class="col-6">
                                <div class="row gx-0">
                                    <div class="col-12">

                                        <!-- Heading -->
                                        <h6 class="dropdown-header">
                                            Categorías
                                        </h6>

                                        <!-- Placeholder for categories menu -->
                                        <?= view_cell('App\Cells\MenuCell::renderCategoriesMenu'); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row gx-0">
                                    <div class="col-12 col-lg-6">

                                        <!-- Heading -->
                                        <h6 class="dropdown-header">
                                            Temporada
                                        </h6>

                                        <!-- Placeholder for seasonal menu -->
                                        <?= view_cell('App\Cells\MenuCell::renderSeasonalMenu'); ?>

                                    </div>
                                    <div class="col-12 col-lg-6">

                                        <!-- Heading -->
                                        <h6 class="dropdown-header">
                                            Día festivo
                                        </h6>

                                        <!-- Placeholder for holidays menu -->
                                        <?= view_cell('App\Cells\MenuCell::renderHolidayMenu'); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('recetas'); ?>">Recetario</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('videos'); ?>">Videos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('chef-ana-paula'); ?>">Todo sobre mi</a>
                </li>

            </ul>

            <form class="form-inline ms-auto px-3 px-md-0 py-4 py-md-0 d-none d-sm-block d-md-none">
                <input type="search" class="form-control form-control-sm" data-bs-toggle="modal" data-bs-target="#searchModal" placeholder="Buscar recetas...">
            </form>

        </div>

    </div>
</nav>


<!-- MAIN CONTENT -->
<?= $this->renderSection('content'); ?>

<!-- SearchModal -->
<?= view_cell('App\Cells\SearchModalCell'); ?>


<!-- FOOTER -->
<footer class="mt-10 py-8 py-md-11 bg-gray-200">
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-12 col-md-4 col-lg-3">

                <!-- Brand -->
                <img src="<?= base_url('assets/img/chef_ana_paula_logo.png'); ?>" alt="Yommi"
                     class="footer-brand img-fluid mb-2 w-100">


                <!-- Colaboration text -->
                <p class="text-gray-700 my-2 footer_copy">
                    ¡Únete a nosotros y lleva tu marca a otro nivel en el universo culinario! Escríbenos para explorar las posibilidades
                    y juntos diseñar una estrategia que deleite a nuestra audiencia y haga crecer tu negocio.
                </p>

                <p class="text-gray-700 footer_copy m-0">Contáctanos:</p>
                <a class="text-primary footer_copy m-0" href="mailto:chefanapaula@gmail.com?subject=Quiero%20ser%20colaborador!&body=Hola%20Chef%20Ana%20Paula%2C">chefanapaula@gmail.com</a>
                <p class="text-gray-700 footer_copy m-0">Esperamos tener la oportunidad de colaborar contigo. ¡Hagamos magia juntos en la cocina!</p>

                <!-- Text -->
                <p class="text-gray-700 my-4 footer_copy">
                    Copyright © 2024 Chef Ana Paula.
                </p>

                <!-- Social -->
                <ul class="list-unstyled list-inline list-social mb-6 mb-md-0">
                    <li class="list-inline-item list-social-item me-3">
                        <a href="https://www.instagram.com/chefanapau/?hl=es-la" class="text-decoration-none">
                            <i class="fab fa-instagram footer_social_icons"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item me-3">
                        <a href="https://es-la.facebook.com/chefanapaula301785063209339/" class="text-decoration-none">
                            <i class="fab fa-facebook-f footer_social_icons"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item">
                        <a href="https://www.youtube.com/channel/UCxxms1mNzAcJnGmXYqlxYUA" class="text-decoration-none">
                            <i class="fab fa-pinterest-p footer_social_icons"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item me-3">
                        <a href="https://www.pinterest.es/chefanapaula/" class="text-decoration-none">
                            <i class="fab fa-youtube footer_social_icons"></i>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-6 col-md-4 col-lg-2">

                <!-- Heading -->
                <h6 class="fw-bold text-uppercase text-gray-700">
                    Mapa del sitio
                </h6>

                <!-- List -->
                <ul class="list-unstyled text-body-secondary mb-6 mb-md-8 mb-lg-0">
                    <li class="mb-3">
                        <a href="<?= base_url(); ?>" class="text-reset">
                            Inicio
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas'); ?>" class="text-reset">
                            Recetario
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('videos'); ?>" class="text-reset">
                            Videos
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('chef-ana-paula'); ?>" class="text-reset">
                            Todo sobre mi
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('contacto'); ?>" class="text-reset">
                            Contacto
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-6 col-md-4 col-lg-2">

                <!-- Heading -->
                <h6 class="fw-bold text-uppercase text-gray-700">
                    Categorias
                </h6>

                <!-- List -->
                <ul class="list-unstyled text-body-secondary mb-6 mb-md-8 mb-lg-0">
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/desayunos'); ?>" class="text-reset">
                            Desayunos
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/botanas'); ?>" class="text-reset">
                            Botanas
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/bebidas'); ?>" class="text-reset">
                            Bebidas
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/sopas-cremas'); ?>" class="text-reset">
                            Sopas/Cremas
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/entradas'); ?>" class="text-reset">
                            Entradas
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('recetas/guarniciones-ensaladas'); ?>" class="text-reset">
                            Guarniciones/Ensaladas
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-6 col-md-4 offset-md-4 col-lg-2 offset-lg-0">

                <!-- Heading -->
                <h6 class="fw-bold text-uppercase text-gray-700">
                    <!-- &#160; -->
                    Categorías
                </h6>

                <!-- List -->
                <ul class="list-unstyled text-body-secondary mb-0">
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/pastas-arroces'); ?>" class="text-reset">
                            Pastas/Arroces
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/plato-principal'); ?>" class="text-reset">
                            Plato principal
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('recetas/postres'); ?>" class="text-reset">
                            Postres
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('recetas'); ?>" class="text-reset">
                            Recetario completo
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-6 col-md-4 col-lg-2">

                <!-- Heading -->
                <h6 class="fw-bold text-uppercase text-gray-700">
                    Legal
                </h6>

                <!-- List -->
                <ul class="list-unstyled text-body-secondary mb-0">
                    <li class="mb-3">
                        <a href="<?= base_url('aviso-de-privacidad'); ?>" class="text-reset">
                            Aviso de Privacidad
                        </a>
                    </li>
                </ul>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</footer>

<!-- JAVASCRIPT -->

<!-- Vendor JS -->
<script src="<?= base_url('assets/js/vendor.bundle.js?v=1.0'); ?>"></script>

<!-- Theme JS -->
<script src="<?= base_url('assets/js/theme.bundle.js?v=1.0'); ?>"></script>

<!--<script src="--><?php //= base_url('assets/js/loader.js'); ?><!--"></script>-->

<!-- App JS -->
<script src="<?= base_url('assets/js/app.min.js'); ?>"></script>

</body>

</html>
