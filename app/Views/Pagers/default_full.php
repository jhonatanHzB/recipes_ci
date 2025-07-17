<?php $pager->setSurroundCount(2) ?>

<ul class="pagination mb-0">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>">
                <i class="ri-arrow-left-s-line align-middle"></i>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>">
                <i class="ri-arrow-right-s-line align-middle"></i>
            </a>
        </li>
    <?php endif ?>
</ul>