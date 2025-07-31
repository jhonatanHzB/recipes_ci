<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $page ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <p class="display-1 kalam">
                <?= $page ?? ''; ?>
            </p>

            <hr>

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="row gx-0">
                <?php if (is_array($categories) && count($categories) > 0) { ?>
                    <?php foreach ($categories as $category) { ?>
                        <div class="d-block col-6 col-md-4 px-3 mb-5" data-aos="fade-up">
                            <a href="<?= base_url(); ?>recetas/<?= $category->slug; ?>">
                                <img
                                    src="<?php base_url(); ?>assets/img/categories/<?= $category->image; ?>"
                                    class="img-fluid category_img"
                                    alt="<?= $category->name ?>"
                                />
                                <p class="text-center fw-bold mt-1 h4"><?= $category->name; ?></p>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="d-block col-6 col-md-4 px-3 mb-5" data-aos="fade-up" id="seasonal-menu-container">
                    <a href="javascript:void(0)" onclick="showExtraMenu(1)">
                        <img
                            src="<?php base_url('assets/img/categories/temporada.jpg'); ?>"
                            class="img-fluid category_img"
                            alt="Temporada"
                        />
                        <p class="text-center fw-bold mt-1 h4">Temporada</p>
                    </a>
                </div>
                <div class="d-block col-6 col-md-4 px-3 mb-5" data-aos="fade-up" id="holiday-menu-container">
                    <a href="javascript:void(0)" onclick="showExtraMenu(2)">
                        <img
                            src="<?php base_url('assets/img/categories/dia_festivo.jpg'); ?>"
                            class="img-fluid category_img"
                            alt="Día Festivo"
                        />
                        <p class="text-center fw-bold mt-1 h4">Día Festivo</p>
                    </a>
                </div>
            </div>

            <div class="row my-10">
                <?= view_cell('App\Cells\SectionCell::renderThirdSection', 'section=2'); ?>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <?= $this->include('front/sections/chef_sidebar.php'); ?>

            <?= view_cell('App\Cells\SectionCell::renderFirstSection', 'section=1'); ?>
        </div>
    </div>
</div>

<script>
    function showExtraMenu(id) {
        startLoading();
        fetch('<?= base_url('api/menu/'); ?>' + id)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener el menu');
                }
                return response.json();
            })
            .then(response => {
                stopLoading();
                const options = response.options || [];
                options.forEach(option => {
                    const image = `${option.image}`;
                    const template = createCategoryBall(option.name, option.slug, image);

                    if (id === 1) {
                        document.getElementById('seasonal-menu-container').insertAdjacentElement('afterend', template);
                        document.querySelectorAll('#seasonal-menu-container a')
                            .forEach(a => a.removeAttribute('onclick'));
                    }

                    if (id === 2) {
                        document.getElementById('holiday-menu-container').insertAdjacentElement('afterend', template);
                        document.querySelectorAll('#holiday-menu-container a')
                            .forEach(a => a.removeAttribute('onclick'));
                    }
                });

            })
            .catch(error => {
                alert('Error al cargar el menú de temporada.');
                console.error('Error:', error);
            });

    }

    function createCategoryBall(title, slug, image) {
        const div = document.createElement('div');
        div.className = 'd-block col-6 col-md-4 px-3 mb-5';
        div.setAttribute('data-aos', 'fade-up');

        const a = document.createElement('a');
        a.href = `<?= base_url(); ?>recetas/${slug}`;
        div.appendChild(a);

        const imageElement = document.createElement('img');
        imageElement.src = `<?php base_url(); ?>assets/img/menus/${image}`;
        imageElement.className = 'img-fluid category_img';
        imageElement.alt = title;
        a.appendChild(imageElement);

        const p = document.createElement('p');
        p.className = 'text-center fw-bold mt-1 h4';
        p.innerText = title;
        a.appendChild(p);

        return div;
    }
</script>

<?= view_cell('App\Cells\VideoCell'); ?>

<?= $this->endSection(); ?>
