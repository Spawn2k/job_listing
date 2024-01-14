<?php

namespace App\views;

/** @var array $validateErrors */
use function App\util\loadTemplate;

// loadTemplate('header');
//dump($validateErrors);
?>
<h1>Home</h1>
<form action="/store" method="POST">
    <!-- <div class="input-container"> -->
    <!--     <label for="firstname">Firstname</label> -->
    <!--     <input id="firstname" type="text" name="firstname"> -->
    <!--     <?php if(isset($validateErrors['firstname'])): ?> -->
    <!--     <p class="input-error"> -->
    <!--         <?php echo $validateErrors['firstname'][0] ?> -->
    <!--     </p> -->
    <!--     <?php endif ?> -->
    <!-- </div> -->
    <!---->
    <!-- <div class="input-container"> -->
    <!--     <label for="lastname">Lastname</label> -->
    <!--     <input id="lastname" type="text" name="lastname"> -->
    <!--     <?php if(isset($validateErrors['lastname'])): ?> -->
    <!--     <p class="input-error"> -->
    <!--         <?php echo $validateErrors['lastname'][0] ?> -->
    <!--     </p> -->
    <!--     <?php endif ?> -->
    <!-- </div> -->

    <div class="input-container">
        <label for="email">Email</label>
        <input id="email" type="text" name="email">
        <?php if(isset($validateErrors['email'])): ?>
        <p class="input-error">
            <?php echo $validateErrors['email'][0] ?>
        </p>
        <?php endif ?>
    </div>

    <!-- <div class="input-container"> -->
    <!--     <label for="password">Password</label> -->
    <!--     <input id="password" type="text" name="password"> -->
    <!--     <?php if(isset($validateErrors['password'])): ?> -->
    <!--     <p class="input-error"> -->
    <!--         <?php echo $validateErrors['password'][0] ?> -->
    <!--     </p> -->
    <!--     <?php endif ?> -->
    <!-- </div> -->
    <!---->
    <!-- <div class="input-container"> -->
    <!--     <label for="role">Role</label> -->
    <!--     <input id="role" type="text" name="role"> -->
    <!--     <?php if(isset($validateErrors['role'])): ?> -->
    <!--     <p class="input-error"> -->
    <!--         <?php echo $validateErrors['role'][0] ?> -->
    <!--     </p> -->
    <!--     <?php endif ?> -->
    <!-- </div> -->

    <button>Submit</button>
</form>
<?php
// loadTemplate('footer');
?>
