<?= $this->extend("admin/template") ?>

<?= $this->section("content") ?>
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title fs-21 mb-1" id="section-title">Cargar receta</h5>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Recetas</a></li>
                        <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-title">Cargar receta</li>
                    </ol>
                </nav>
            </div>

            <div class="d-flex my-xl-auto right-content align-items-center">
                <div class="pe-1 mb-xl-0 mx-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="draftSwitch" checked />
                        <label class="form-check-label" for="saveDraft">Borrador</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <form class="d-flex flex-column" id="recipeForm" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12">
                    <div class="card mb-4 mb-lg-0 mb-xl-4">
                        <div class="card-body px-0 px-md-5">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                            <?php if (isset($recipe_id)): ?>
                                <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>" />
                            <?php endif; ?>

                            <!-- Título de la receta -->
                            <div class="col-12 mt-4 mb-4">
                                <label for="name" class="form-label fs-6">Titulo de la receta</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Ingrese el título de la receta" required
                                    value="<?= $recipe->name ?? "" ?>" />
                            </div>

                            <!-- Imagen de la receta -->
                            <div class="col-12 mb-2">
                                <label for="image" class="form-label fs-6">Imagen de la receta</label>
                                <div class="border rounded p-3">
                                    <img id="imagePreview" src="<?= isset($recipe->image)
                                        ? base_url() .
                                        "assets/img/recipes/" .
                                        $recipe->image
                                        : "#" ?>" alt="Vista previa" class="img-fluid mb-3 <?= isset(
                                          $recipe->image
                                      )
                                          ? ""
                                          : "d-none" ?>" />

                                    <?php if (isset($recipe->image)): ?>
                                        <input type="hidden" name="current_image" value="<?= $recipe->image ?>">
                                    <?php endif; ?>

                                    <input type="file" class="form-control form-control-lg" id="image" name="image"
                                        accept="image/*" <?= isset($recipe->image)
                                            ? ""
                                            : "required" ?> />
                                    <small class="text-muted">
                                        <?= isset($recipe->image)
                                            ? "Seleccione una nueva imagen solo si desea cambiar la actual"
                                            : "Seleccione una imagen para la receta" ?>

                                    </small>
                                </div>
                            </div>

                            <p class="text-muted d-block mb-2">
                                Editor de imágenes para aspecto 16:9
                                <a class="text-info" target="_blank"
                                    href="https://www.iloveimg.com/es/editor-de-fotos">Editor</a>
                            </p>

                            <p class="text-muted d-block mb-4">
                                Compresor de imágenes, debe de tener maximo un tamaño de 1024MB.
                                <a class="text-info" target="_blank" href="https://imagecompressor.com/">Compresor</a>
                            </p>

                            <!-- Descripción de la receta -->
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fs-6" id="description_label">
                                    Descripción de la receta
                                </label>
                                <div id="description"></div>
                            </div>

                            <!-- Ingredientes -->
                            <div class="container-ingredients border border-black bd-blue-100">
                                <div class="col-12 mb-2">
                                    <label class="form-label fs-6">Ingredientes</label>
                                    <div id="ingredientsList">
                                        <!-- Los ingredientes se agregarán aquí dinámicamente -->
                                    </div>
                                    <button type="button" id="addIngredient" class="btn btn-primary">Añadir
                                        ingrediente
                                    </button>
                                </div>
                            </div>

                            <!-- Instrucciones -->
                            <div class="container-instructions border border-light bd-indigo-100">
                                <div class="col-12 mb-2">
                                    <label class="form-label fs-6">Instrucciones</label>
                                    <div id="instructionsList">
                                        <!-- Las instrucciones se agregarán aquí dinámicamente -->
                                    </div>
                                    <button type="button" id="addInstruction" class="btn btn-primary">Añadir
                                        instrucción
                                    </button>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Porciones -->
                                <div class="col-12 col-md-6 mb-5">
                                    <label for="portions" class="form-label fs-6">Porciones</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="4-5"
                                        id="portions" name="portions" required value="<?= $recipe->portions ??
                                            "" ?>" />
                                </div>

                                <!-- Dificultad -->
                                <div class="col-12 col-md-6 mb-5">
                                    <label for="difficulty" class="form-label fs-6">Dificultad</label>
                                    <select class="form-select form-control-lg" id="difficulty" name="difficulty">
                                        <option value="fácil" <?= isset(
                                            $recipe->difficulty
                                        ) && $recipe->difficulty === "fácil"
                                            ? "selected"
                                            : "" ?>>Fácil</option>
                                        <option value="medio" <?= isset(
                                            $recipe->difficulty
                                        ) && $recipe->difficulty === "medio"
                                            ? "selected"
                                            : "" ?>>Medio</option>
                                        <option value="difícil" <?= isset(
                                            $recipe->difficulty
                                        ) &&
                                            $recipe->difficulty === "difícil"
                                            ? "selected"
                                            : "" ?>>Difícil</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Tiempo de cocción -->
                                <div class="col-12 col-md-6 mb-5">
                                    <label for="time_hour" class="form-label fs-6">Tiempo de cocción</label>
                                    <div class="d-flex align-items-end column-gap-2">
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg" id="time_hour"
                                                    name="time_hour" readonly />
                                                <span class="input-group-text">hr</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg" id="time_min"
                                                    name="time_min" readonly />
                                                <span class="input-group-text">min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tiempo de horneado -->
                                <div class="col-12 col-md-6 mb-5">
                                    <label for="baked_hour" class="form-label fs-6">Tiempo de horneado</label>
                                    <div class="d-flex align-items-end column-gap-2">
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg"
                                                    id="baked_hour" name="baked_hour" value="0" readonly />
                                                <span class="input-group-text">hr</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg" id="baked_min"
                                                    name="baked_min" value="00" readonly />
                                                <span class="input-group-text">min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Tiempo de refrigeración -->
                                <div class="col-12 col-md-6 mb-5">
                                    <label for="refrigeration_hour" class="form-label fs-6">Tiempo de
                                        refrigeración</label>
                                    <div class="d-flex align-items-end column-gap-2">
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg"
                                                    id="refrigeration_hour" name="refrigeration_hour" value="0"
                                                    readonly />
                                                <span class="input-group-text">hr</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg"
                                                    id="refrigeration_min" name="refrigeration_min" value="00"
                                                    readonly />
                                                <span class="input-group-text">min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Información nutricional -->
                            <div class="container-nutritional-information">
                                <h3 class="text-center mb-4">Información nutricional</h3>
                                <div class="row mb-5">
                                    <div class="col-12 col-md-6">
                                        <label for="calories">Calorías</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control form-control-lg" id="calories"
                                                name="calories" min="0" value="<?= $recipe->calories ?? 0 ?>" />
                                            <select class="form-select form-control-lg" id="calories_unit"
                                                name="calories_unit">
                                                <option value="kcal">kcal</option>
                                                <option value="kJ">kJ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="carbohydrates">Carbohidratos</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control form-control-lg" id="carbohydrates"
                                                name="carbohydrates" min="0"
                                                value="<?= $recipe->carbohydrates ?? 0 ?>" />
                                            <select class="form-select form-control-lg" id="carbohydrates_unit"
                                                name="carbohydrates_unit">
                                                <option value="g">g</option>
                                                <option value="mg">mg</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="protein">Proteínas</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control form-control-lg" id="protein"
                                                name="protein" min="0" value="<?= $recipe->protein ?? 0 ?>" />
                                            <select class="form-select" id="protein_unit" name="protein_unit">
                                                <option value="g">g</option>
                                                <option value="mg">mg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="fat">Grasas</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control form-control-lg" id="fat"
                                                name="fat" min="0" value="<?= $recipe->fat ?? 0 ?>" />
                                            <select class="form-select" id="fat_unit" name="fat_unit">
                                                <option value="g">g</option>
                                                <option value="mg">mg</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url() ?>admin" class="btn btn-lg btn-danger-light me-2">Cancelar</a>
                                <button type="submit" class="btn btn-lg btn-primary-light">Guardar receta</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12">
                    <div class="card" id="content-categories">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-1">Categorías</h3>
                        </div>
                        <div class="card-body">
                            <?php foreach ($categories as $category): ?>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="categories[]"
                                        id="category_<?= $category->id ?>"
                                        value="<?= $category->id ?>"
                                        <?= in_array($category->id, $recipe->categories ?? [])
                                            ? "checked"
                                            : ""
                                        ?>
                                    />
                                    <label class="form-check-label" for="category_<?= $category->id ?>">
                                        <?= $category->name ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card" id="content-tags">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-1">Etiquetas</h3>
                        </div>
                        <div class="card-body">
                            <p>Pueda ingresar más de una etiqueta a la receta</p>
                            <select class="select2 form-control form-control-lg" name="tags[]" multiple="multiple"
                                data-placeholder="Seleccione etiquetas">
                                <?php foreach ($tags as $tag): ?>
                                    <option
                                        value="<?= $tag->id ?>"
                                        <?= in_array($tag->id, $recipe->tags ?? [])
                                            ? "selected"
                                            : ""
                                        ?>
                                    >
                                        <?= $tag->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <!-- row closed -->

    </div>
</div>
<!-- End::app-content -->

<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Sweetalert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.all.min.js"></script>

<!-- JQuery Slim -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Quill -->
<!-- Quill -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script src="<?= base_url() ?>assets/admin/js/recipe.js"></script>
<script>
    // Inicializar Select2 para las etiquetas
    $(document).ready(function () {
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>
<script>
    <?php
    $split_time = explode(":", $recipe->time ?? "00:00");
    $time_hour = $split_time[0] ?? 0;
    $time_min = $split_time[1] ?? 0;

    $split_baked_time = explode(":", $recipe->baked ?? "00:00");
    $baked_hour = $split_baked_time[0] ?? 0;
    $baked_min = $split_baked_time[1] ?? 0;

    $split_refrigeration_time = explode(
        ":",
        $recipe->refrigeration ?? "00:00"
    );
    $refrigeration_hour = $split_refrigeration_time[0] ?? 0;
    $refrigeration_min = $split_refrigeration_time[1] ?? 0;

    $cal_unit = $recipe->calories_unit ?? "kcal";
    $car_unit = $recipe->carbohydrates_unit ?? "g";
    $pro_unit = $recipe->protein_unit ?? "g";
    $gra_unit = $recipe->fat_unit ?? "g";
    ?>

    // Inicializar Quill editor para la descripción
    const quill = new Quill("#description", {
        placeholder: "Escribe una descripción de la receta",
        theme: "snow"
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Inicializar inputs de ingredientes
        initDynamicInputs({
            addButtonId: "addIngredient",
            containerListId: "ingredientsList",
            inputName: "ingredients",
            placeholder: "Ingrese el nombre del ingrediente",
            buttonText: "Borrar ingrediente",
            initialValues: <?= json_encode($recipe->ingredients ?? []); ?>
        });

        // Inicializar inputs de instrucciones
        initDynamicInputs({
            addButtonId: "addInstruction",
            containerListId: "instructionsList",
            inputName: "instructions",
            placeholder: "Ingrese la instrucción",
            buttonText: "Borrar instrucción",
            initialValues: <?= json_encode($recipe->instructions ?? []); ?>
        });

        const times = [
            <?= $time_hour ?>,
            <?= $time_min ?>,
            <?= $baked_hour ?>,
            <?= $baked_min ?>,
            <?= $refrigeration_hour ?>,
            <?= $refrigeration_min ?>,
        ];
        createDateInputs(times);

        const units = [
            "<?= $cal_unit ?>",
            "<?= $car_unit ?>",
            "<?= $pro_unit ?>",
            "<?= $gra_unit ?>"
        ];
        setNutritionalUnits(units);

        quill.root.innerHTML = "<?= $recipe->description ?? "" ?>";
    });
</script>

<?= $this->endSection() ?>