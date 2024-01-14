<?php

namespace App\views;

/** @var array $jobs*/
use function App\util\loadTemplate;
loadTemplate('header');
loadTemplate('heroSection');
loadTemplate('headline');
loadTemplate('flash');
?>
<section class="section-main-index">
    <div class="main-container">
        <p class="job-listings">Recent Jobs</p>
        <div class="job-listings-card-container">
            <?php foreach ($jobs as $job): ?>
            <div class="card-listing">
                <h2>
                    <?= $job->title ?>
                </h2>
                <p>
                    <?= $job->description ?>
                </p>
                <ul>
                    <li>
                        <span>Salary: </span>
                        <span>
                            <?= '$'.$job->salary ?>
                        </span>
                    </li>
                    <li>
                        <span>Location:</span>
                        <span>
                            <?= $job->address?>
                        </span>
                    </li>
                    <li>
                        <span>Tags:</span>
                        <span>
                            <?= $job->tags?>
                        </span>
                    </li>
                </ul>
                <a href="/listings/page/<?= $job->pageNumber ?>/listing/<?= $job->id ?>">
                <!-- <a href="/listings/page/<?= $job->pageNumber ?>/listing/<?= $job->id ?>"> -->
                    <button>Details</button>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<a href="/listings/page/1">
    <p class="btn-show-all-jobs">Show all jobs</p>
</a>

<?php
loadTemplate('footer');
?>
