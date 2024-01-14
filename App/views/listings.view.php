<?php

namespace App\views;

/**
 * @var array $jobs
*/
/**
 * @var int $page
*/
/**
 * @var int $maxPage
*/
/**
 * @var int $pageLimit
*/
/**
 * @var array $displayPage
*/
use function App\util\loadTemplate;

loadTemplate('header');
// loadTemplate('headline');
?>
<main class="main-listings">
    <div class="job-listings-card-container">
        <?php foreach ($jobs as $job): ?>
        <div class="card-listing">
            <h2>
                <?php echo $job->title ?>
            </h2>
            <p>
                <?php echo $job->description ?>
            </p>
            <ul>
                <li>
                    <span>Salary: </span>
                    <span>
                        <?php echo '$'.$job->salary ?>
                    </span>
                </li>
                <li>
                    <span>Location:</span>
                    <span>
                        <?php echo $job->address?>
                    </span>
                </li>
                <li>
                    <span>Tags:</span>
                    <span>
                        <?php echo $job->tags?>
                    </span>
                </li>
            </ul>
            <a href="/listings/page/<?=  $page ?>/listing/<?= $job->id ?>">
                <button>Details</button>
            </a>
        </div>
        <?php endforeach ?>
    </div>
</main>
<section class="section-pagination">
    <div class="pagination-container">
        <a class="pagination-first <?php echo (int) $page === 1 ? 'disable' : '' ?> "
            href="/listings/page/<?php echo $page - 1?>">Previous</a>
        <div class="pagination-page-container">
            <?php if ( !$isMin ) : ?>
            <a class="pagination-min-page" href="/listings/page/1">...
                <?php echo 1?>
            </a>
            <?php endif ?>
            <?php foreach($displayPage as $idx => $value): ?>
            <a class="pagination-el <?php echo (int) $page === (int) $value ? 'active' : '' ?>"
                href="/listings/page/<?php echo $value ?>">
                <?php echo $value ?>
            </a>
            <?php endforeach ?>
        </div>
        <?php if ( !$isMax ) : ?>
        <a class="pagination-max-page" href="/listings/page/<?php echo $maxPage ?>">...
            <?php echo $maxPage ?>
        </a>
        <?php endif ?>
        <a class="pagination-last <?php echo (int) $page >= $maxPage ? 'disable' : '' ?>"
            href="/listings/page/<?php echo $page + 1 ?>">Next</a>
    </div>
</section>
<div class="btn btn-home"><a href="/">Home</a></div>

<?php
loadTemplate('footer');
?>
