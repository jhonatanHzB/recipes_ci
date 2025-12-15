<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:Dashboard Chef Ana Paula:.</title>
    <meta name="Description" content="Panel de administración de las recetas y artículos de Chef Ana Paula">
    <meta name="Author" content="Chef Ana Paula">
    <meta name="keywords" content="admin dashboard template,admin panel html, chef ana paula">

    <meta name="robots" content="noindex, nofollow, noarchive">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>favicon.ico" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="<?= base_url(); ?>assets/admin/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/bootstrap.min.css">

    <!-- Style Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/styles.css" />

    <!-- Admin Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/admin.css" />

    <!-- Icons Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/icons.css" />

    <!-- Node Waves Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/waves.min.css" />

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/flatpickr.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/nano.min.css" />

    <!-- Animate CSS -->
    <link rel="styleskheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script>
        const baseURL = '<?= base_url(); ?>';
    </script>

    <!-- AXIOS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>

    <?= $this->include('admin/components/switcher.php'); ?>

    <!-- Loader -->
    <div id="loader"
         style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: rgba(255,255,255,0.9); display: flex; justify-content: center; align-items: center; z-index: 9999;">
        <img src="<?= base_url(); ?>assets/admin/img/loader.svg" alt="Cargando...">
    </div>
    <!-- Loader -->

    <div class="page">

        <?= view_cell('App\Cells\HeaderCell'); ?>

        <?= view_cell('App\Cells\SidebarCell'); ?>

        <!-- MAIN CONTENT -->
        <?= $this->renderSection('content'); ?>

        <?= $this->include('admin/components/footer.php'); ?>

    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="<?= base_url(); ?>assets/admin/js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?= base_url(); ?>assets/admin/js/bootstrap.bundle.min.js"></script>

    <!-- Defaultmenu JS -->
    <script src="<?= base_url(); ?>assets/admin/js/defaultmenu.min.js"></script>

    <!-- Node Waves JS-->
    <script src="<?= base_url(); ?>assets/admin/js/waves.min.js"></script>

    <!-- Scripts necesario para barra de configuración de temas  -->
    <!-- Color Picker JS -->
    <script src="<?= base_url(); ?>assets/admin/js/pickr.es5.min.js"></script>

    <!-- Custom-Switcher JS -->
    <script src="<?= base_url(); ?>assets/admin/js/custom-switcher.min.js"></script>
    <!-- End scripts necesarios para barra de configuración de temas  -->

    <!-- Apex Charts JS -->
    <script src="<?= base_url(); ?>assets/admin/js/apexcharts.min.js"></script>

    <!-- Custom JS -->
    <script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>

    <!-- Vendor JS -->
    <script src="<?= base_url(); ?>assets/admin/js/vendor.js"></script>

</body>

</html>
