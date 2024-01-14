<?php
use App\session\SessionClass;
$session = new SessionClass(); ?>
<div class="flash-message-container">
    <?php if($session->hasFlash('success')): ?>
    <p class="flash-message-success">
        <?= $session->getFlash('success')[0] ?>
    </p>
    <?php endif ?>

    <?php if($session->hasFlash('error')): ?>
    <p class="flash-message-error">
        <?= $session->getFlash('error')[0] ?>
    </p>
    <?php endif ?>
</div>
