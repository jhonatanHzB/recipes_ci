<?= $this->extend("admin/template") ?>

<?= $this->section("content") ?>
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1" id="section-title">Editar categorías</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Recetas</a></li>
                            <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-title">Editar categorías</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <div class="card mb-4 mb-lg-0 mb-xl-4">
                        <div class="card-body px-0 px-md-5 py-0 py-md-5">

                            <div class="table-responsive">
                                <table class="table text-nowrap table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Contador</th>
                                        <th scope="col">Posición</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <th scope="row"><?= $category->id ?></th>
                                            <td><?= esc($category->name) ?></td>
                                            <td><?= esc($category->image) ?></td>
                                            <td><?= esc($category->count) ?></td>
                                            <td><?= esc($category->position) ?></td>
                                            <td>
                                                <div class="hstack gap-2 flex-wrap">
                                                    <a href="<?= base_url() ?>admin/category/update/<?= $category->id ?>"
                                                       class="text-info fs-14 lh-1">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                       class="text-danger fs-14 lh-1 delete-recipe"
                                                       onclick="deleteCategory(<?= $category->id ?>)">
                                                        <i class="ri-delete-bin-5-line"></i>
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

            </div>
            <!-- row closed -->

        </div>
    </div>
    <!-- End::app-content -->

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.all.min.js"></script>

    <script>
        function deleteCategory(categoryId) {
            console.log(`Receta a eliminar: ${categoryId}`);
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar la categoría?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes hacer la llamada AJAX para eliminar la receta
                    fetch('<?= base_url('admin/category/delete') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ category_id: categoryId })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) { 
                            console.log(`Receta con ID ${categoryId} eliminada`);
                            Swal.fire('Eliminado', 'La categoría ha sido eliminada.', 'success');
                            searchRecipes(); // Actualizar la lista después de eliminar
                        } else {
                            throw new Error(data.error || 'No se pudo eliminar la receta');
                        }
                    })
                    .catch(error => {
                        console.error('Error al eliminar la receta:', error);
                        Swal.fire('Error', error.message, 'error');
                    });
                }
            });
        }
    </script>


<?= $this->endSection() ?>