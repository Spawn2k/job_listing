<?php if (isset($_SESSION['success'])) : ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $_SESSION['success'] ?>
    <?php unset($_SESSION['success']) ?>

  </div>
<?php endif ?>

<?php if (isset($_SESSION['error'])) : ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $_SESSION['error'] ?>
    <?php unset($_SESSION['error']) ?>
  </div>
<?php endif ?>