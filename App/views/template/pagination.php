<?php

namespace App\views\template;

/** @var array $jobs*/
/** @var array $page*/
/** @var int $maxPage*/

?>
<section class="section-pagination">
    <div class="pagination-container">
        <a class="pagination-first <?php echo (int) $page['id'] === 1 ? 'disable' : '' ?> "
            href="/listings/page/<?php echo $page['id'] - 1?>">Previous</a>
        <div class="pagination-page-container">
            <?php foreach(range(1, $maxPage) as $idx => $value): ?>
            <a class="pagination-el <?php echo (int) $page['id'] === $value ? 'active' : '' ?>"
                href="/listings/page/<?php echo $idx + 1?>">
                <?= $idx + 1 ?>
            </a>
            <?php endforeach ?>
        </div>
        <a class="pagination-last <?php echo (int) $page['id'] === 9 ? 'disable' : '' ?>"
            href="/listings/page/<?php echo $page['id'] + 1?>">Next</a>
    </div>
</section>
