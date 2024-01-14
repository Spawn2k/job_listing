<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Nolis</title>
</head>

<body>
    <header>
        <nav>
            <a href="/">
                <p class="logo">Workopia</p>
            </a>
            <ul>
                <?php if(isset($_SESSION['user'])): ?>
                <p>
                    Hello
                    <?= $_SESSION['user']->name ?>
                </p>
                <a class="btn btn-logout" href="/logout">Logout</a>
                <?php endif ?>
                <?php if(!isset($_SESSION['user'])): ?>
                <a href="/login">
                    <li>Login</li>
                </a>
                <a href="/register">
                    <li>Register</li>
                </a>
                <?php endif ?>
            </ul>
        </nav>
    </header>
