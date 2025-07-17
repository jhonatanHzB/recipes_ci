<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title fs-21 mb-1">Hola, bienvenido de nuevo <?= $username ?>!</h5>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Principal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">General</li>
                    </ol>
                </nav>
            </div>

            <div class="main-dashboard-header-right">
                <div>
                    <label class="fs-13 text-muted">Total de recetas</label>
                    <h5 class="mb-0 fw-semibold"><?= $total_recipes ?></h5>
                </div>
                <div>
                    <label class="fs-13 text-muted">Recetas con categoria</label>
                    <h5 class="mb-0 fw-semibold"><?= count($recipes_with_category) ?></h5>
                </div>
                <div>
                    <label class="fs-13 text-muted">Recetas con etiquetas</label>
                    <h5 class="mb-0 fw-semibold"><?= count($recipes_with_tag) ?></h5>
                </div>
            </div>

        </div>
        <!-- Page Header Close -->

        <!-- Cards -->
        <div class="row">

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card bg-success-gradient text-fixed-white">
                    <div class="card-body text-fixed-white">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="ri-restaurant-line fs-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-fixed-white">RECETAS CORRECTAS</span>
                                    <h3 class="text-fixed-white mb-0"><?= $correct_recipes ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card bg-primary-gradient text-fixed-white">
                    <div class="card-body text-fixed-white">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="ri-menu-search-line fs-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-fixed-white">TOTAL DE CATEGORIAS</span>
                                    <h3 class="text-fixed-white mb-0"><?= $total_categories ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card bg-warning-gradient text-fixed-white">
                    <div class="card-body text-fixed-white">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="ri-hashtag fs-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-fixed-white">TOTAL DE ETIQUETAS</span>
                                    <h3 class="text-fixed-white mb-0"><?= $total_tags ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card bg-danger-gradient text-fixed-white">
                    <div class="card-body text-fixed-white">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="ri-restaurant-2-line fs-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-fixed-white">RECETAS INCORRECTAS</span>
                                    <h3 class="text-fixed-white mb-0"><?= $incorrect_recipes ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Cards closed -->

        <!-- row opened -->
        <div class="row">

            <!-- Card -->
            <div class="col-md-12 col-lg-12 col-xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Categorias</h4>
                            <a href="javascript:void(0);"
                               class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill"
                               data-bs-toggle="dropdown"><i class="fe fe-more-horizontal"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-categories">Descargar Categorías</a>
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-recipes-with-categories">Descargar Recetas con Categoria</a>
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-recipes-without-categories">Descargar Recetas sin Categoria</a>
                            </div>
                        </div>
                        <p class="fs-12 text-muted mb-0">
                            A continuación se muestra un resumen de las recetas que cuentan con al menos una categoría en ellas y las que no tienen ninguna categoría.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="total-revenue">
                            <div>
                                <h4><?= count($recipes_with_category) ?></h4>
                                <label><span class="bg-primary"></span>Con categoria</label>
                            </div>
                            <div>
                                <h4><?= count($recipes_without_category) ?></h4>
                                <label><span class="bg-danger"></span>Sin categoria</label>
                            </div>
                        </div>
                        <div id="categories-bar" class="sales-bar mt-4"></div>
                    </div>
                </div>
            </div>
            <!-- card close -->

            <!-- Card -->
            <div class="col-md-12 col-lg-12 col-xl-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Etiquetas</h4>
                            <a href="javascript:void(0);"
                               class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill"
                               data-bs-toggle="dropdown"><i class="fe fe-more-horizontal"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-tags">Descargar Etiquetas</a>
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-recipes-with-tag">Descargar Recetas con Etiquetas</a>
                                <a class="dropdown-item" href="<?= base_url() ?>v1/dashboard/export-popular-tags">Descargar Etiquetas Populares</a>
                            </div>
                        </div>
                        <p class="fs-12 text-muted mb-0">
                            A continuación se muestra un gráfico que muestra las 10 etiquetas más utilizadas en las recetas.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="total-revenue">
                            <div>
                                <h4><?= count($recipes_with_tag) ?></h4>
                                <label><span class="bg-primary"></span>Con etiqueta</label>
                            </div>
                            <div>
                                <h4><?= $total_tags ?></h4>
                                <label><span class="bg-info"></span>Total de etiquetas</label>
                            </div>
                        </div>
                        <div id="tags-bar" class="sales-bar mt-4"></div>
                    </div>
                </div>
            </div>
            <!-- card close -->


        </div>
        <!-- row closed -->

        <!-- row opened -->
        <div class="row">

            <!-- card of last recipes updated -->
            <div class="col-12 col-md-8">
                <div class="card mb-4 mb-lg-0 mb-xl-4">
                    <div class="card-body">
                        <h4 class="card-title">Últimas recetas actualizadas</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($last_recipes_updated as $recipe): ?>
                                    <tr>
                                        <td><?= $recipe->id ?></td>
                                        <td><?= $recipe->name ?></td>
                                        <td><?= $recipe->updated_at ?></td>
                                        <td>
                                            <div class="hstack gap-2 flex-wrap">
                                                <a
                                                    href="<?= base_url() ?>recipes/<?= $recipe->id ?>"
                                                    class="btn btn-primary-light fs-14 lh-1"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="tooltip-info"
                                                    title="Editar receta">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a
                                                    href="<?= base_url() ?>receta/<?= $recipe->slug ?>"
                                                    class="btn btn-info-light fs-14 lh-1"
                                                    target="_blank"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="tooltip-success"
                                                    title="Ver receta">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of card of last recipes updated -->

            <!-- card of section names -->
            <div class="col-12 col-md-4">
                <div class="card mb-4 mb-lg-0 mb-xl-4">
                    <div class="card-body">
                        <h4 class="card-title">Secciones</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sections as $section): ?>
                                    <tr>
                                        <td><?= $section->id ?></td>
                                        <td><?= $section->name ?></td>
                                        <td><?= $section->updated_at ?></td>
                                        <td>
                                            <div class="hstack gap-2 flex-wrap">
                                                <button
                                                    type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#sectionModal"
                                                    data-section-id="<?= $section->id ?>"
                                                    data-section-name="<?= $section->name ?>"
                                                    class="btn btn-primary-light fs-14 lh-1">
                                                    <i class="ri-edit-line"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of card of section names -->
        </div>
        <!-- row closed -->

        <!-- row opened -->
        <div class="row">

            <!-- card of draft recipes -->
            <div class="col-12">
                <div class="card mb-4 mb-lg-0 mb-xl-4">
                    <div class="card-body">
                        <h4 class="card-title">Borrador de recetas</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Número</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Dificultad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($draft_recipes as $recipe): ?>
                                    <tr>
                                        <td><?= $recipe->id ?></td>
                                        <td><?= $recipe->name ?></td>
                                        <td><?= $recipe->description ?></td>
                                        <td><?= $recipe->difficulty ?></td>
                                        <td>
                                            <div class="hstack gap-2 flex-wrap">
                                                <a
                                                    href="<?= base_url() ?>admin/recipe/update/<?= $recipe->id ?>"
                                                    class="btn btn-primary-light fs-14 lh-1"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="tooltip-info"
                                                    title="Editar receta">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <button
                                                    type="button"
                                                    class="btn btn-danger-light fs-14 lh-1"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="tooltip-danger"
                                                    title="Eliminar">
                                                    <i class="ri-delete-bin-7-line"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of card draft recipes -->

        </div>
        <!-- row closed -->

    </div>
</div>
<!-- End::app-content -->

<!-- Modal para editar las secciones -->
<div class="modal fade" id="sectionModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="sectionModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Mostrar un loader antes de cargar el contenido -->
                <div class="loader-wrapper" id="loader-wrapper">
                    <img src="<?= base_url(); ?>assets/admin/img/loader.svg" alt="Cargando...">
                </div>
                <div id="section-wrapper"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-teal-light" form="sectionUpdateForm">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="<?= base_url(); ?>assets/admin/js/index.js"></script>

<script>
    function createCategoryChart() {
        const categories = <?= json_encode($categories_chart) ?>;

        const colors = [
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
        ];

        const options = {
            series: [
                {
                    name: 'Registros',
                    data: categories.values,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        console.log(chart, w, e)
                    },
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                categories: categories.names,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px',
                    },
                },
            },
        };

        const categories_bar = new ApexCharts(
            document.querySelector('#categories-bar'),
            options
        );

        categories_bar.render();
    }

    function createTagsChart() {
        const tags = <?= json_encode($tags_chart) ?>;

        const colors = [
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
        ];

        const options = {
            series: [
                {
                    name: 'Recetas con etiqueta',
                    data: tags.values,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        console.log(chart, w, e)
                    },
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                categories: tags.names,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px',
                    },
                },
            },
            stroke: {
                width: 1,
            },
        };

        const tags_bar = new ApexCharts(
            document.querySelector('#tags-bar'),
            options
        );

        tags_bar.render();
    }

</script>

<?= $this->endSection(); ?>
