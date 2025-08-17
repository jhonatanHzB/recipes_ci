<?= $this->extend("admin/template") ?>

<?= $this->section("content") ?>
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title fs-21 mb-1" id="section-title">Cargar categoría</h5>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Recetas</a></li>
                        <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-title">Cargar categoría</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <form class="d-flex flex-column" id="categoryForm" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12">
                    <div class="card mb-4 mb-lg-0 mb-xl-4">
                        <div class="card-body px-0 px-md-5">

                            <?php if (isset($category_id)): ?>
                                <input type="hidden" name="category_id" value="<?= $category_id ?>" />
                            <?php endif; ?>
                            
                            <!-- Nombre de la categoría -->
                            <div class="col-12 mt-4 mb-4">
                                <label for="name" class="form-label fs-6">Nombre de categoría</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Ingrese el nombre de la categoría" required
                                    value="<?= $category->name ?? "" ?>" />
                            </div>

                            <?php if (isset($category->image)): ?>
                                <input type="hidden" name="current_image" value="<?= $category->image ?>">
                            <?php endif; ?>

                            <!-- Recortador de imagenes -->
                            <div class="col-12 mb-2">
                                <label for="" class="form-label fs-6">Imagen de categoría</label>

                                <div id="cropper-container" class="border rounded p-3 text-center"></div>

                                <input type="file" class="d-none" id="image" name="image" accept="image/*" />
                                
                                <div class="d-flex align-items-center column-gap-3 my-3">
                                    <button type="button" class="btn btn-lg btn-secondary-light" onclick="document.getElementById('image').click();">
                                        <i class="fas fa-upload me-2"></i>Elegir imagen
                                    </button>
                                    
                                    <button type="button" class="btn btn-lg btn-primary-light" id="saveCategoryBtn">Guardar categoría</button>
                                </div>
                            </div>

                            <?php if (isset($category_id)): ?>
                                <div class="text-end mt-5">
                                    <a href="<?= base_url() ?>admin" class="btn btn-lg btn-danger-light me-2">Cancelar</a>
                                    <button type="submit" class="btn btn-lg btn-primary-light">Guardar categoría</button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12">
                    <div class="card" id="content-categories">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-1">Categorías Actuales</h3>
                        </div>
                        <div class="card-body">
                            <?php foreach ($categories as $category): ?>
                                <p><?= $category->name ?></p>
                            <?php endforeach; ?>
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

<!-- Librería para recortar las imagenes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cropperContainer = document.getElementById('cropper-container');
    const imageInput = document.getElementById('image');
    const saveBtn = document.getElementById('saveCategoryBtn');
    const categoryForm = document.getElementById('categoryForm');
    let croppieInstance = null;

    // 1. Inicializa Croppie
    function initializeCroppie() {
        cropperContainer.innerHTML = ''; // Limpia el contenedor
        croppieInstance = new Croppie(cropperContainer, {
            viewport: { width: 200, height: 200, type: 'circle' }, // Visor circular
            boundary: { width: 300, height: 300 },
            enableExif: true
        });
    }

    // 2. Escucha cuando el usuario selecciona un archivo
    imageInput.addEventListener('change', function (e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (event) {
                if (!croppieInstance) {
                    initializeCroppie();
                }
                // Carga la imagen en Croppie
                croppieInstance.bind({
                    url: event.target.result
                });
                cropperContainer.classList.add('ready');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // 3. Escucha el clic en el botón de guardar
    saveBtn.addEventListener('click', function () {
        // Valida que el nombre de la categoría no esté vacío
        const categoryName = document.getElementById('name').value;
        if (categoryName.trim() === '') {
            Swal.fire('Error', 'El nombre de la categoría es requerido.', 'error');
            return;
        }

        // Si no se ha cargado una imagen, muestra un error
        if (!croppieInstance) {
            Swal.fire('Error', 'Por favor, seleccione una imagen para la categoría.', 'error');
            return;
        }

        // Obtiene la imagen recortada como un Blob (ideal para enviar a un servidor)
        croppieInstance.result({
            type: 'blob',
            size: { width: 400, height: 400 }, // Tamaño final de la imagen
            format: 'png',
            circle: false // El recorte ya es circular, el archivo debe ser cuadrado
        }).then(function (blob) {
            
            // Crea un objeto FormData para enviar los datos del formulario y la imagen
            const formData = new FormData(categoryForm);

            // Añade la imagen recortada al FormData
            formData.append('cropped_image', blob, 'category_image.png');
            
            // Elimina el campo de imagen original si existe para no enviarlo
            formData.delete('image');

            // Muestra un loader mientras se sube
            Swal.fire({
                title: 'Guardando...',
                text: 'Por favor, espere.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 4. Envía los datos al controlador usando Fetch API
            fetch('<?= base_url('admin/category/save') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('¡Éxito!', data.message, 'success')
                    .then(() => {
                        window.location.reload(); // Recarga la página para ver los cambios
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error del servidor', 'No se pudo completar la solicitud.', 'error');
                console.error('Error:', error);
            });
        });
    });
});
</script>

<?= $this->endSection() ?>