<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('recetas'); ?>"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item" aria-current="page"><?= $page ?? ''; ?></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $queryParam ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <p class="fw-bold h2 mb-3">
                Resultados para: <?= $queryParam ?? ''; ?>
            </p>

            <hr>

            <div class="recipe_message_error"></div>
        </div>
    </div>


    <div class="row" id="recipe_container"></div>

    <div id="recipe_bookmark" style="height: 1px"></div>

    <template id="recipe_template">
        <!-- Row card -->
        <div class="col-12 col-md-4 mb-5" data-aos="fade-up">

            <!-- Card -->
            <a class="card shadow-light-lg mb-7 mb-md-0" href="#" id="recipe_url">

                <!-- Image -->
                <div class="card-zoom recent_img" id="recipe_image">
                    <div class="placeholder"></div>
                </div>

                <!-- Body -->
                <div class="card-body">

                    <!-- Shape -->
                    <div class="shape shape-bottom-100 shape-fluid-x text-white">
                        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor" />
                        </svg>
                    </div>

                    <!-- Stars points -->
                    <div class="content_stars" id="recipe_raiting"></div>

                    <!-- Preheading -->
                    <h6 class="my-1 text-body-secondary recents_difficulty" id="recipe_difficulty"></h6>

                    <!-- Heading -->
                    <h4 class="mb-0 h5" id="recipe_title"></h4>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="recents_content-information">
                            <img src="<?= base_url('assets/img/icons/chef-avatar.png') ?>" class="recents_img_avatar" alt="Chef Ana Paula">
                            <span class="recents_author_name ml-1" id="recipe_author"></span>
                        </div>
                        <span class="recents_content-information text-card-information">
                            <img src="<?= base_url('assets/img/icons/calorias.svg') ?>" class="recents_icon_calories" alt="Calorias">
                            <span class="recents_calories" id="recipe_calories"></span>
                        </span>
                    </div>

                </div>

            </a>
        </div>
    </template>

</div>

<script src="<?= base_url('assets/js/search-min.js'); ?>"></script>
<script>
    initRecipes(<?= $recipes ?>, '<?= base_url(); ?>');
</script>

<?= $this->endSection(); ?>
