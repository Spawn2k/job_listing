<?php

namespace App\views;

use App\session\SessionClass;

use function App\util\loadTemplate;

/** @var array $validateErrors */
$session = new SessionClass();
loadTemplate('header');
loadTemplate('flash');
?>

<main class="main-login">
    <section>
        <h2>Login</h2>
        <form action="/login" method="POST">
            <div class="input-container">
                <input id="email" type="text" name="email" placeholder="Email">
                <?php if(isset($validateErrors['email'])): ?>
                <p class="input-error">
                    <?php echo $validateErrors['email'][0] ?>
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
            <button class="btn-login" type="submit">Login</button>
        </form>
        <p>Don't have an account?
            <a href="/register">
                Register
            </a>
        </p>
    </section>
</main>
</body>

</html>
