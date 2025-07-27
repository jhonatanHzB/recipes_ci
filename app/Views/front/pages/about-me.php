<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">

        <!-- BREADCRUMBS -->
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $page ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <!-- ./breadcrumbs -->

        <!-- HEADER PAGE -->
        <div class="col-12">
            <p class="display-1 kalam">
                <?= $page ?? ''; ?>
            </p>

            <hr>

        </div>
        <!-- ./header page -->

        <div class="row">
        </div>
        <div class="col-12 col-md-8 mb-10 mb-md-2">

            <img
                class="img-fluid mt-5 mb-8 d-block m-auto shadow d-md-none"
                src="<?= base_url(); ?>assets/img/chef/chef.jpg" alt="Chef Ana Paula"
                data-aos="fade-up"
            />

            <section class="animate__animated animate__fadeInUp">
                <p>
                    Ana Paula es una chef reconocida, con una formación culinaria de élite y una trayectoria que
                    abarca desde la alta cocina hasta la televisión y los medios digitales. Su pasión por la
                    gastronomía se refleja en cada receta que comparte, combinando técnicas clásicas con toques
                    innovadores.
                </p>

                <blockquote class="blockquote my-8 text-center">
                    <p>Bienvenido al Recetario de la Chef Ana Paula García</p>
                </blockquote>
            </section>

            <section class="animate__animated animate__fadeInUp mb-9">
                <h3 class="fw-bold mb-4">Pasión por la cocina, experiencia en cada plato</h3>

                <p>
                    En este espacio, la Chef Ana Paula García comparte contigo su universo culinario: recetas que
                    nacen del conocimiento, la intuición y el amor por la buena cocina. Cada plato es una invitación
                    a descubrir nuevos sabores, aprender técnicas, y disfrutar del arte de cocinar.
                </p>

                <p>
                    Con una formación en instituciones de prestigio como el CESSA en México y el Culinary Institute
                    of America en Napa, Ana Paula ha construido una trayectoria que abarca desde la alta cocina hasta
                    la televisión y los medios digitales. Su carrera refleja un compromiso constante con la excelencia,
                    la creatividad y la inspiración.
                </p>
            </section>

            <section class="animate__animated animate__fadeInUp mb-9">
                <h3 class="fw-bold mb-4">Su Recorrido</h3>

                <ul>
                    <li>
                        <strong>Formación Culinaria:</strong>
                        <br>
                        Egresada del <i>Centro de Estudios Superiores de San Ángel (CESSA)</i> y con un postgrado en el
                        <i>Culinary Institute of America (CIA)</i> en Greystone, Napa, Ana Paula domina tanto las bases clásicas
                        como las técnicas internacionales más innovadoras.
                    </li>
                    <li>
                        <strong>Presencia en Medios:</strong>
                        <br>
                        Desde su debut en televisión en el programa <i>Vibe</i> hasta su rol como chef conductora en <i>Sazonarte</i> por TVC,
                        Ana Paula ha compartido su cocina con miles de hogares. Actualmente, es colaboradora editorial en revistas
                        especializadas, donde continúa inspirando a nuevos públicos.
                    </li>
                </ul>
            </section>

            <section class="animate__animated animate__fadeInUp mb-8">
                <h3 class="fw-bold mb-5">Filosofía Culinaria:</h3>

                <p>
                    Para Ana Paula, la cocina es un lenguaje universal que nos conecta con nuestras raíces, nuestras emociones y el mundo.
                    Su propuesta gira en torno a:
                </p>

                <ul>
                    <li>Ingredientes frescos y de temporada.</li>
                    <li>Tradición y modernidad en armonía.</li>
                    <li>Recetas accesibles para todos los niveles, sin perder sofisticación ni sabor.</li>
                </ul>
            </section>

            <section class="animate__animated animate__fadeInUp">
                <h3 class="fw-bold mb-6 text-center">Qué encontrarás aquí?</h3>

                <p>
                    Un recetario vivo, en constante evolución, donde cada receta ha sido probada, perfeccionada y diseñada para que puedas
                    replicarla en casa.
                </p>

                <ul>
                    <li>Platos rápidos para el día a día.</li>
                    <li>Opciones gourmet para ocasiones especiales.</li>
                    <li>Consejos, técnicas y videos con el toque personal de Ana Paula.</li>
                    <li>Valoraciones y espacio para que compartas tu experiencia.</li>
                </ul>
            </section>

            <hr>

            <section class="animate__animated animate__fadeInUp">
                <h3 class="fw-bold mb-6 text-center">¡Cocina, comparte y forma parte de nuestra comunidad!</h3>

                <p>
                    Este es tu espacio. Un punto de encuentro para quienes disfrutan cocinar, experimentar y aprender.
                </p>

                <p>Únete a Ana Paula en este viaje de sabores y descubre el placer de cocinar con pasión, intención y creatividad.</p>
            </section>

        </div>
        <div class="col-12 col-md-4">
            <img
                class="img-fluid shadow d-none d-md-block"
                src="<?= base_url('assets/img/chef.jpg'); ?>"
                alt="Chef Ana Paula"
                data-aos="fade-up"
            />
            <?= view_cell('App\Cells\SectionCell::renderFirstSection', 'section=1'); ?>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>
