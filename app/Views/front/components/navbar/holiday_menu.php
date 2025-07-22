<!-- List -->
<?php if (is_array($menus) && count($menus) > 0) { ?>
    <?php foreach ($menus as $menu) { ?>
        <a class="dropdown-item" href="<?= base_url(); ?>recetas/<?= $menu->slug; ?>">
            <?= $menu->name; ?>
        </a>
    <?php } ?>
<?php } ?>
