<div class="container-fluid">
    <div class="row mt-md-10">
        <div class="col-12 gx-0" data-aos="fade-up">
            <p class="fw-bold section_title mb-3 kalam">
                <?= $section_name->name ?? ''; ?>
            </p>
            <hr>
        </div>
    </div>

    <div class="row">
        <?php if (is_array($recipes) && count($recipes) > 0) { ?>
            <?php foreach ($recipes as $recipe) { ?>
                <!-- Row card -->
                <div class="col-12 col-md-6 g-2 d-flex align-items-stretch mb-5" data-aos="fade-up" >
                    <!-- Card -->
                    <a class=" card shadow-light-lg mb-7 mb-md-0"
                       href="<?= base_url('receta/'); ?><?= $recipe->slug; ?>">

                        <!-- Image -->
                        <div class="card-zoom section_img" style="
                                background-image: url('<?= base_url('assets/img/recipes/'); ?><?= $recipe->image; ?>');
                                ">
                        </div>

                        <!-- Body -->
                        <div class="card-body px-md-3 py-md-4">

                            <!-- Shape -->
                            <div class="shape shape-bottom-100 shape-fluid-x text-white">
                                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor" />
                                </svg>
                            </div>

                            <!-- Stars points -->
                            <div class="section_content_stars">
                                <?= $recipe->generateRatingStars(); ?>
                            </div>

                            <!-- Heading -->
                            <h4 class="section_recipe_title mt-2"><?= $recipe->name; ?></h4>

                        </div>

                    </a>
                </div>

            <?php } ?>
        <?php } ?>
    </div>
</div>
