<p class="fw-bold display-1 mb-3 kalam title_color">
    <?= $section_name->name ?? ''; ?>
</p>

<hr>

<div class="row">
    <?php if (is_array($recipes) && count($recipes) > 0) { ?>
        <?php foreach ($recipes as $recipe) { ?>
            <!-- Row card -->
            <div class="col-12 col-md-6 mb-5" data-aos="fade-up" >
                <!-- Card -->
                <a class="card shadow-light-lg mb-7 mb-md-0"
                   href="<?= base_url(); ?>receta/<?= $recipe->slug; ?>">

                    <!-- Image -->
                    <div class="card-zoom recent_img" style="
                        background-image: url('<?= base_url(); ?>assets/img/recipes/<?= $recipe->image; ?>');
                        ">
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
                        <div class="content_stars">
                            <?= $recipe->generateRatingStars(); ?>
                        </div>

                        <!-- Heading -->
                        <h4 class="mb-0 h5"><?= $recipe->name; ?></h4>

                        <!-- Heading -->
                        <div class="d-flex justify-content-between mt-4">
                            <p class="h6">
                                <?= $recipe->getDifficultyIcon(); ?>
                                <?= $recipe->difficulty; ?>
                            </p>
                            <p class="h6">
                                <i class="far fa-clock"></i>
                                <?= $recipe->time; ?> min
                            </p>
                        </div>

                    </div>

                </a>
            </div>

        <?php } ?>
    <?php } ?>
</div>
