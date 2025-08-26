<div class="container">
    <div class="row mt-9 mb-5">
        <div class="col">
            <h1 class="fw-bold display-1 kalam title_color">Para la semana</h1>
        </div>
    </div>

    <div class="row">
        <?php if (! empty($recipes)) {?>
            <?php foreach ($recipes as $recipe) { ?>
                <div class="col-12 col-md-3">
                    <!-- Card -->
                    <a
                        class="card card-flush mb-7 mb-md-0"
                        data-aos="fade-up"
                        href="<?= base_url(); ?>receta/<?= $recipe->slug; ?>"
                    >

                        <!-- Image -->
                        <div class="card-zoom season_img" style="
                            background-image: url('assets/img/recipes/<?= $recipe->image; ?>');
                            ">
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">

                            <!-- Preheading -->
                            <h5 class="text-uppercase mb-1 season_title fw-bold">
                                <?= $recipe->name; ?>
                            </h5>

                            <!-- Heading -->
                            <div class="d-flex justify-content-between">
                                <p class="h6">
                                    <?= $recipe->getDifficultyIcon(); ?>
                                    <?= $recipe->difficulty; ?>
                                </p>
                                <p class="h6">
                                    <i class="far fa-clock"></i>
                                    <?= $recipe->time; ?>
                                </p>
                            </div>

                        </div>

                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>