<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <form action="<?= base_url(); ?>buscar" method="get" autocomplete="off">
                    <input type="text" class="form-control" name="q" id="searchInput" placeholder="Buscar recetas...">
                    <button type="submit"
                            class="btn w-100 btn-primary d-flex align-items-center justify-content-center gap-2 mt-4">
                        Buscar
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="tags_search_container">
                    <p class="mb-4">Etiquetas populares</p>
                    <div class="d-flex flex-wrap row-gap-2 column-gap-2">
                        <?php foreach ($tags as $tag) { ?>
                            <a
                                href="<?= base_url(); ?>recetas/<?= $tag->name; ?>"
                                class="badge text-bg-secondary-subtle">#<?= $tag->name; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="category_search_container">
                    <p class="mb-4">Categorías</p>
                    <div class="d-flex flex-wrap row-gap-2 column-gap-2">
                        <?php foreach ($categories as $category) { ?>
                            <a
                                href="<?= base_url(); ?>recetas/<?= $category->slug; ?>"
                                class="badge text-bg-primary-subtle"><?= $category->name; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-subtle btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchModal = document.getElementById('searchModal');
        const searchInput = document.getElementById('searchInput');

        searchModal.addEventListener('shown.bs.modal', function () {
            searchInput.focus();
        });
    });
</script>
