<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>recetas"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $page ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <h1 class="fw-bolder h2 mb-3">
                <?= $page ?? ''; ?>
            </h1>

            <!-- Content author, created and score -->
            <div class="d-flex flex-column flex-md-row column-gap-5 align-items-start align-items-md-center row-gap-3">
                <div class="recipe_author_content">
                    <img
                        class="recipe_author_img" src="<?= base_url(); ?>assets/img/icons/chef.svg"
                        alt="Chef Ana Paula"
                    />
                    <span>Chef Ana Paula</span>
                </div>
                <div class="recipe_created_content">
                    <span class="fe fe-calendar"></span>
                    <span><?= $recipe->created_at; ?></span>
                </div>
                <div class="recipe_rating_content d-flex column-gap-2">
                    <!-- Stars points -->
                    <div class="popular_content_stars recipe_score_content">
                        <?= $recipe->generateRatingStars(); ?>
                    </div>
                    <span><?= $recipe->rating; ?> de <?= $recipe->count; ?> opiniones</span>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 col-md-8">

                    <!-- Content image -->
                    <?php $img = $recipe->image ?? 'not-found-receta.jpg'; ?>
                    <img
                        src="<?= base_url(); ?>assets/img/recipes/<?= $img; ?>"
                        class="img-fluid recipe_image" alt="<?= $recipe->name; ?>"
                    />

                    <!-- Content time, difficulty and portions -->
                    <div class="row recipe_revelant_content">
                        <div class="col-12 col-md-4">
                            <p class="mb-1">Tiempo de Preparación</p>
                            <span class="fw-bolder">
                                <?= $recipe->time; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="mb-1">Dificultad</p>
                            <span class="fw-bolder">
                                <?= $recipe->difficulty; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="mb-1">Rinde</p>
                            <span class="fw-bolder">
                                <?= $recipe->portions; ?>
                            </span>
                        </div>
                    </div>

                    <!-- Content time, difficulty and portions for print recipe -->
                    <table class="table table-sm table_revelant">
                        <thead>
                        <tr>
                            <th scope="col">Tiempo de Preparación</th>
                            <th scope="col">Dificultad</th>
                            <th scope="col">Rinde</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $recipe->time; ?></td>
                            <td><?= $recipe->difficulty; ?></td>
                            <td><?= $recipe->portions; ?></td>
                        </tr>
                        </tbody>
                    </table>


                    <!-- Content description -->
                    <div class="recipe_description_content">
                        <?= $recipe->description; ?>
                    </div>

                    <!-- Content ingredients and instructions -->
                    <div class="row mt-5">
                        <div class="col-12 col-md-6 recipe_ingredients_content">
                            <h3 class="fw-bolder mb-4">Ingredientes</h3>
                            <div id="ingredients">
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php for ($i = 0; $i < count($recipe->ingredients); $i++): ?>
                                            <div class="custom-control custom-checkbox d-flex column-gap-2 align-items-baseline mb-4">
                                                <input type="checkbox" class="custom-control-input" id="ingredient<?= $i ?>">
                                                <label class="custom-control-label" for="ingredient<?= $i ?>">
                                                    <?= $recipe->ingredients[$i]; ?>
                                                </label>
                                            </div>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 recipe_intructions_content">
                            <h3 class="fw-bolder mb-4">Método de preparación</h3>
                            <div id="instructions">
                                <table class="table table-borderless">
                                    <tbody>
                                    <?php for ($i = 0; $i < count($recipe->instructions); $i++): ?>
                                        <tr>
                                            <td class="p-0 pb-2">
                                                <span class="badge text-bg-primary-subtle"><?= $i + 1 ?></span>
                                            </td>
                                            <td class="p-0 pb-2">
                                                <?= $recipe->instructions[$i]; ?>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Content nutrimental information -->
                <div class="col-12 col-md-4">
                    <div class="recipe_nutrimental_content">
                        <p class="fw-bolder">Información nutrimental</p>
                        <table class="table table-sm" aria-describedby="tabla_nutrimental">
                            <tbody>
                            <tr>
                                <td>Calorías</td>
                                <td class="fw-bolder"><?= $recipe->calories; ?></td>
                            </tr>
                            <tr>
                                <td>Carbohidratos</td>
                                <td class="fw-bolder"><?= $recipe->carbohydrates; ?></td>
                            </tr>
                            <tr>
                                <td>Grasa</td>
                                <td class="fw-bolder"><?= $recipe->fat; ?></td>
                            </tr>
                            <tr>
                                <td>Proteína</td>
                                <td class="fw-bolder"><?= $recipe->protein; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="recipe_print_content">
                        <button
                            class="
                            btn w-100 btn-primary-subtle d-flex align-items-center justify-content-center gap-2 lift
                            "
                            onclick="window.print()"
                        >
                            Imprimir Receta
                            <span class="fe fe-printer"></span>
                        </button>
                    </div>

                    <div class="recipe_tags_content">
                        <p class="fw-bolder">Etiquetas</p>
                        <div class="d-flex flex-wrap row-gap-2 column-gap-2">
                            <?php if (empty($tags)): ?>
                                <span class="badge text-bg-secondary-subtle">No hay etiquetas</span>
                            <?php endif; ?>
                            <?php foreach ($tags as $tag): ?>
                                <a
                                    href="<?= base_url(); ?>recetas/<?= $tag->name; ?>"
                                    class="badge text-bg-secondary-subtle">#<?= $tag->name; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?= view_cell('App\Cells\SectionCell::renderFirstSection', 'section=1'); ?>
                </div>

            </div>

        </div>

        <!-- Content relation recipes -->
        <?php if (!empty($relatedRecipesWithCategory)) {?>
            <div class="col-12 recipe_relations_content">
                <h2 class="fw-bolder mb-5">Recetas Relacionadas</h2>

                <div data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                    <?php foreach ($relatedRecipesWithCategory as $recipe) { ?>
                        <?php $img = $recipe->image ?? 'not-found-receta.jpg'; ?>
                        <a
                            class="d-block col-12 col-md-4 px-1 text-center"
                            href="<?= base_url(); ?>receta/<?= $recipe->slug; ?>">
                            <img
                                src="<?= base_url(); ?>assets/img/recipes/<?= $img; ?>"
                                class="img-fluid"
                                alt="<?= $recipe->name; ?>"
                            />
                            <span class="text-body"><?= ucfirst(mb_strtolower($recipe->name, 'UTF-8')); ?></span>
                        </a>
                    <?php } ?>
                </div>

            </div>
        <?php } ?>

        <!-- Toast confirmation recipe rating -->
        <div class="toast-container p-3 top-0 end-0">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Chef Ana Paula</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>

    </div>
</div>

<script>
    const ingredientsInputs = document.querySelectorAll('#ingredients .custom-control input');
    ingredientsInputs.forEach((input) => {
        input.addEventListener('click', () => {
            input.parentElement.classList.toggle('line-through');
        });
    });

    const stars = document.querySelectorAll('.popular_content_stars .star');

    stars.forEach((star) => {
        star.addEventListener('mouseover', function () {
            resetStars(false);
            this.classList.add('hover');
            let previousSibling = this.previousElementSibling;
            while (previousSibling) {
                previousSibling.classList.add('hover');
                previousSibling = previousSibling.previousElementSibling;
            }
        });

        star.addEventListener('mouseout', function () {
            resetStars(false);
        });

        star.addEventListener('click', function (e) {
            resetStars(true);
            this.classList.add('selected');
            let previousSibling = this.previousElementSibling;
            while (previousSibling) {
                previousSibling.classList.add('selected');
                previousSibling = previousSibling.previousElementSibling;
            }
            setScore(e);
        });
    });

    function resetStars() {
        stars.forEach(star => {
            star.classList.remove('hover');
            star.classList.remove('selected');
        });
    }

    function setScore(e) {
        const rating = e.target.dataset.rating;
        const recipeId = e.target.dataset.recipe;
        const existingClassification = JSON.parse(localStorage.getItem('rating')) || [];

        if (existingClassification.includes(recipeId)) {
            return;
        }

        localStorage.setItem('rating', JSON.stringify([...existingClassification, recipeId]));

        fetch('<?= base_url('/api/score') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                recipe_id: recipeId,
                recipe_score: rating,
            }),
        })
            .then(response => response.json())
            .then(data => {
                showToaster(data.message);
                getScore();
            })
            .catch(error => console.error(error));
    }

    function getScore() {
        fetch('<?= base_url('/api/score/' . $recipe->slug) ?>')
            .then(response => response.json())
            .then(data => {
                const spanRecipeRating = document.querySelector('.recipe_rating_content span');
                spanRecipeRating.textContent = `${data.rating} de ${data.count} opiniones`;

                const startOver = document.querySelectorAll('.recipe_score_content .star');
                const ratingRounded = Math.round(data.rating);

                startOver.forEach((star, index) => {
                    if (index < ratingRounded) {
                        star.classList.add('star-selected');
                    } else {
                        star.classList.remove('star-selected');
                    }
                });

            })
            .catch(error => console.error(error));
    }

    function showToaster(message) {
        const toastEl = document.getElementById('liveToast');
        toastEl.querySelector('.toast-body').textContent = message;
        const toast = new Toast(toastEl);
        toast.show();
    }
</script>

<?= $this->endSection(); ?>
