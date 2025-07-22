<!-- List -->
<?php if (is_array($categories) && count($categories) > 0) { ?>
    <?php foreach ($categories as $category) { ?>
        <a class="dropdown-item"
           href="<?= base_url(); ?>recetas/<?= $category->slug ?>">
            <?= $category->name; ?>
        </a>
    <?php } ?>
<?php } ?>

<a class="dropdown-item" href="<?= base_url(); ?>recetas">
    <u>Recetario completo</u>
</a>
