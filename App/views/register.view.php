<?php

namespace App\views;

use function App\util\loadTemplate;

/** @var array $validateErrors */
loadTemplate('header');
?>

<main class="main-login">
    <section>
        <h2>Register</h2>
        <form action="/register" method="POST">
            <div class="input-container">
                <input id="name" type="text" name="name" placeholder="Full Name">
                <?php if(isset($validateErrors['name'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['name'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="email" type="text" name="email" placeholder="Email Address">
                <?php if(isset($validateErrors['email'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['email'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="city" type="text" name="city" placeholder="City">
                <?php if(isset($validateErrors['city'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['city'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
            <div class="input-container">
                <input id="state" type="text" name="state" placeholder="State">
                <?php if(isset($validateErrors['state'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['state'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="password" type="text" name="password" placeholder="Password">
                <?php if(isset($validateErrors['password'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['password'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <div class="input-container">
                <input id="confirm-password" type="text" name="confirmPassword" placeholder="Confirm Password">
                <?php if(isset($validateErrors['confirmPassword'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['confirmPassword'][0] ?>
                </p>
                <?php endif ?>
            </div>
            <button class="btn-login" type="submit">Register</button>
        </form>
        <p>Already have an account? 
            <a href="/login">
                Login
            </a>
        </p>
    </section>
</main>
</body>

</html>
