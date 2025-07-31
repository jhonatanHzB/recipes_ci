<?= $this->extend("admin/template") ?>

<?= $this->section("content") ?>
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1" id="section-title">Editar recetas</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Recetas</a></li>
                            <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-title">Editar recetas</li>
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

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="recipe" class="mb-2 text-muted">Buscar receta:</label>
                                <input type="text" class="form-control" id="recipe" name="recipe">
                            </div>

                            <div class="table-responsive">
                                <table class="table text-nowrap table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Categorías</th>
                                        <th scope="col">Etiquetas</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($recipes as $recipe): ?>
                                        <tr>
                                            <th scope="row"><?= $recipe->id ?></th>
                                            <td><?= esc($recipe->name) ?></td>
                                            <td>
                                                <span class="badge <?= $recipe->status === 'draft' ? 'bg-warning-transparent' : 'bg-success-transparent' ?>">
                                                    <?= ucfirst($recipe->status) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php foreach ($recipe->categories as $category): ?>
                                                    <span class="badge bg-light text-dark me-1"><?= esc($category) ?></span>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php foreach ($recipe->tags as $tag): ?>
                                                    <span class="badge bg-info-transparent me-1"><?= esc($tag) ?></span>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 flex-wrap">
                                                    <a href="<?= base_url() ?>admin/recipe/update/<?= $recipe->id ?>"
                                                       class="text-info fs-14 lh-1">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                       class="text-danger fs-14 lh-1 delete-recipe"
                                                       onclick="deleteRecipe(<?= $recipe->id ?>)">
                                                        <i class="ri-delete-bin-5-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            <?php if ($pager): ?>
                                <nav aria-label="Page navigation" class="pagination-style-1 mt-3 d-flex justify-content-center">
                                    <?= $pager->links() ?>
                                </nav>
                            <?php endif; ?>

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
        let timeoutId;
        let currentPage = 1;

        const searchInput = document.getElementById('recipe');
        const tableBody = document.querySelector('.table tbody');
        const paginationContainer = document.querySelector('.pagination-style-1');

        searchInput.addEventListener('input', function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                currentPage = 1;
                searchRecipes();
            }, 500);
        });

        async function searchRecipes() {
            const searchTerm = searchInput.value;
            const url = new URL('<?= base_url('admin/recipe/search') ?>');
            url.searchParams.append('search', searchTerm);
            url.searchParams.append('page', currentPage);

            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }

                const data = await response.json();

                if (data && data.recipes) {
                    updateTable(data.recipes);
                    updatePagination(data.currentPage, data.totalPages);
                } else {
                    throw new Error('Formato de respuesta inválido');
                }
            } catch (error) {
                console.error('Error en la búsqueda:', error);

                let errorMessage = 'Ocurrió un error al buscar las recetas';
                if (error.message.includes('HTTP')) {
                    errorMessage = `Error del servidor: ${error.message}`;
                } else if (error.name === 'TypeError') {
                    errorMessage = 'No se pudo conectar con el servidor';
                }

                Swal.fire('Error', errorMessage, 'error');
            }
        }

        function updateTable(recipes) {
            //tableBody.empty();

            if (!recipes.length) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron recetas</td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = recipes.map(recipe => `
                <tr>
                    <th scope="row">${recipe.id}</th>
                    <td>${recipe.name}</td>
                    <td>
                        <span class="badge ${recipe.status === 'draft' ? 'bg-warning-transparent' : 'bg-success-transparent'}">
                            ${recipe.status.charAt(0).toUpperCase() + recipe.status.slice(1)}
                        </span>
                    </td>
                    <td>
                        ${recipe.categories.map(category =>
                    `<span class="badge bg-light text-dark me-1">${category}</span>`
                ).join('')}
                    </td>
                    <td>
                        ${recipe.tags.map(tag =>
                    `<span class="badge bg-info-transparent me-1">${tag}</span>`
                ).join('')}
                    </td>
                    <td>
                        <div class="hstack gap-2 flex-wrap">
                            <a href="<?= base_url('admin/recipe/update/') ?>${recipe.id}"
                                class="text-info fs-14 lh-1">
                                <i class="ri-edit-line"></i>
                            </a>
                            <a href="javascript:void(0);"
                                class="text-danger fs-14 lh-1 delete-recipe"
                                onclick="deleteRecipe(${recipe.id})">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function updatePagination(currentPage, totalPages) {
            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHtml = '<ul class="pagination mb-0">';

            // Botón anterior
            paginationHtml += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${currentPage - 1}">
                        <i class="ri-arrow-left-s-line align-middle"></i>
                    </a>
                </li>
            `;


            // Páginas
            for (let i = 1; i <= totalPages; i++) {
                if (i === currentPage) {
                    paginationHtml += `
                    <li class="page-item active">
                        <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>
                    </li>
                `;
                } else if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    paginationHtml += `
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>
                    </li>
                `;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    paginationHtml += `
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);">...</a>
                    </li>
                `;
                }
            }

            // Botón siguiente
            paginationHtml += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${currentPage + 1}">
                        <i class="ri-arrow-right-s-line align-middle"></i>
                    </a>
                </li>
            `;

            paginationHtml += '</ul>';
            paginationContainer.innerHTML = paginationHtml;

            // Manejador de eventos para la paginación
            const pageLinks = document.querySelectorAll('.pagination .page-link');
            pageLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.dataset.page;
                    if (page && !isNaN(page) && page !== currentPage) {
                        currentPage = parseInt(page);
                        searchRecipes();
                    }
                });
            });
        }

        function deleteRecipe(recipeId) {
            console.log(`Receta a eliminar: ${recipeId}`);
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar la receta?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes hacer la llamada AJAX para eliminar la receta
                    fetch('<?= base_url('admin/recipe/delete') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ recipe_id: recipeId })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) { 
                            console.log(`Receta con ID ${recipeId} eliminada`);
                            Swal.fire('Eliminado', 'La receta ha sido eliminada.', 'success');
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