<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>

<?= $this->include('front/sections/welcome_banner.php'); ?>

<?= $this->include('front/sections/social_networks.php'); ?>

<div class="container">
    <!-- Las imágenes deben de tener una relación 16:9 y una resolución de 1280*720 -->
    <div class="row">
        <div class="carousel-home"></div>
    </div>
</div>

<!-- Section semanal -->
<?= view_cell('App\Cells\SectionCell::renderSecondSection', 'section=4'); ?>

<!-- Carousel de categorías -->
<div class="container">
    <div class="row my-10">
        <div id="carouselAllCategoriesWrapper" class="col-12">
        </div>
    </div>
</div>

<!-- Sección nuevas recetas y populares -->
<div class="container">
    <div class="row my-10">
        <div class="col-12 col-md-8">
            <?= view_cell('App\Cells\SectionCell::renderThirdSection', 'section=2'); ?>
        </div>

        <div class="col-12 col-md-4">
            <?= $this->include('front/sections/chef_sidebar.php'); ?>

            <?= view_cell('App\Cells\SectionCell::renderFirstSection', 'section=1'); ?>
        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>

<?= $this->endSection(); ?>