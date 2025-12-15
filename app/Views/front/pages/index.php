<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row my-6 my-md-8">
        <div class="col-12 col-md-7 mb-4 mb-md-0">
            <p class="dk-mango fs-2">
                <b>Bienvenido</b> al recetario en línea de la Chef Ana Paula García con <b>más de 3,000</b>
                deliciosas y prácticas recetas para todos <br>
                los días y ocasiones, desde desayunos hasta cenas especiales.
            </p>
            <p class="dk-mango fs-2">Descúbre tu próxima receta favorita y empieza a cocinar hoy.</p>
        </div>
        <div class="col-12 col-md-4">
            <p class="dk-mango text-center fs-1"><count-up>1, 115, 205</count-up> SEGUIDORES</p>
            <?= $this->include('front/sections/social_networks.php'); ?>
        </div>
    </div>
</div>

<!-- Categorías principales -->
<div class="container">
    <div class="row">
        <div class="d-block col-6 col-md-6 col-lg-3 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-up">
            <a href="<?= base_url() ?>recetas/sopas-cremas">
                <img src="<?= base_url() ?>assets/img/categories/cremas.png" class="img-fluid category_img" alt="Sopas/Cremas">
                <p class="text-center fw-bold mt-1 h3">Sopas/Cremas</p>
            </a>
        </div>
        <div class="d-block col-6 col-md-6 col-lg-3 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-up">
            <a href="<?= base_url() ?>recetas/plato-principal">
                <img src="<?= base_url() ?>assets/img/categories/plato-fuerte.png" class="img-fluid category_img" alt="Plato principal">
                <p class="text-center fw-bold mt-1 h3">Plato principal</p>
            </a>
        </div>
        <div class="d-block col-6 col-md-6 col-lg-3 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-up">
            <a href="<?= base_url() ?>recetas/guarniciones-ensaladas">
                <img src="<?= base_url() ?>assets/img/categories/guarnicion.png" class="img-fluid category_img" alt="Guarniciones/Ensaladas">
                <p class="text-center fw-bold mt-1 h3">Guarniciones/Ensaladas</p>
            </a>
        </div>
        <div class="d-block col-6 col-md-6 col-lg-3 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-up">
            <a href="<?= base_url() ?>recetas/postres">
                <img src="<?= base_url() ?>assets/img/categories/postres.png" class="img-fluid category_img" alt="Postres">
                <p class="text-center fw-bold mt-1 h3">Postres</p>
            </a>
        </div>
    </div>
</div>

<!-- Carousel de categorías -->
<div class="container">
    <div class="row my-10">
        <div id="carouselAllCategoriesWrapper" class="col-12"></div>
    </div>
</div>

<div class="container">
    <!-- Las imágenes deben de tener una relación 16:9 y una resolución de 1280*720 -->
    <div class="row">
        <div class="carousel-home"></div>
    </div>
</div>

<!-- Section semanal -->
<?= view_cell('App\Cells\SectionCell::renderSecondSection', 'section=4'); ?>

<!-- Sección nuevas recetas y populares -->
<div class="container">
    <div class="row my-10">
        <div class="col-12 col-md-8">
            <a href="<?= base_url() ?>recetas/fiesta-de-mexico">
                <img src="<?= base_url() ?>assets/img/banner/119061876_3036719076560604_6916966115108803622_n.jpg" class="img-fluid mb-8" alt="Banner Chef Ana Paula">
            </a>
            <?= view_cell('App\Cells\SectionCell::renderThirdSection', 'section=2'); ?>
        </div>

        <div class="col-12 col-md-4">
            <?= $this->include('front/sections/chef_sidebar.php'); ?>

            <?= view_cell('App\Cells\SectionCell::renderFirstSection', 'section=1'); ?>
        </div>

    </div>
</div>

<?= view_cell('App\Cells\VideoCell'); ?>

<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>
<script type="module" src="https://cdn.jsdelivr.net/gh/lekoala/formidable-elements@master/dist/count-up.min.js"></script>

<?= $this->endSection(); ?>