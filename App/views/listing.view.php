<?php

namespace App\views;

use function App\util\loadTemplate;

/**@var stdClass $job */
/**@var int $pageId*/
loadTemplate('header');
loadTemplate('headline');
?>
<main class="main-listing">
    <section class="section-main-listing">
        <div class="main-container">
            <div class="job-listings-card-container">
                <div class="card-listing">
                    <div>
                        <a class="btn-home" href="/listings/page/<?= $job->pageNumber?>">back to listings</a>
                        <div>
                            <?php if(isset($_SESSION['user']) && $_SESSION['user']->id === $job->user_id): ?>
                            <a href="/listings/edit/<?php echo isset($job->id) ? $job->id : '' ?>">
                                edit
                            </a>
                            <form action="/delete/<?= isset($job->id) ? $job->id : ''  ?>" method="POST">
                                <input type="hidden" name="id" value="<?= isset($job->id) ? $job->id : '' ?>">
                                <input type="hidden" name="user_id" value="<?= isset($job->user_id) ? $job->user_id : null ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-delete">delete</button>
                            </form>
                            <?php endif ?>
                        </div>
                        <!-- <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'guest'): ?> -->
                        <!-- <?php endif ?> -->
                    </div>
                    <h2>
                        <?= isset($job->title) ? $job->title : '' ?>
                    </h2>
                    <p>
                        <?= isset($job->description) ? $job->description : '' ?>
                    </p>
                    <ul>
                        <li>
                            <span>Salary:</span>
                            <span>$
                                <?= isset($job->salary) ? number_format($job->salary) : '' ?>
                            </span>
                        </li>
                        <li>
                            <span>Location:</span>
                            <span>
                                <?= isset($job->address) ? $job->address : '' ?>
                            </span>
                        </li>
                        <li>
                            <span>Tags:</span>
                            <span>
                                <?= isset($job->tags) ? $job->tags : '' ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <h2>Job Details</h2>
            <div class="job-details-container">
                <h3>Job Requirements</h3>
                <p>
                    <?= isset($job->requirements) ? $job->requirements : '' ?>
                </p>
                <h3>Benefits</h3>
                <p>
                    <?= isset($job->benefits) ? $job->benefits : '' ?>
                </p>
            </div>
            <p>Put "Job Application" as the subject of your email and attach your resume.</p>
            <button>Apply Now</button>
        </div>
    </section>
</main>

<?php
loadTemplate('footer');
?>
