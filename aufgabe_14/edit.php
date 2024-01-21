<?php

define('STORE_PATH', 'userData/');
define('USER_ID', 'kunden_nr_');
require '../vendor/autoload.php';
require 'function.php';

$user = [];

if(!isset($_POST['id'])) {
    header('Location: index.php');
    exit();
}

if(isset($_POST['id'])) {
    $user = find($_POST['id']);
    if($user === false) {
        header('Location: index.php');
        exit();
    }
}


if(isset($_POST['userId'])) {
    $errors = inputErrors($_POST);

    if(empty($errors)) {
        $updatedUser =  escHtml($_POST);
        $newId = USER_ID . $_POST['userId'];
        unset($updatedUser[$newId]['id']);
        updateUser($_POST['id'], $updatedUser);
        // header('Location: index.php');
        // exit();
        echo "<script>location.href='/';</script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="main.css" rel="stylesheet">
</head>

<body>

    <h1>edit</h1>
    <main class="main-edit">

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['userId'] ?? '' ?>">
            <div class="input-container">
                <label for="userId">Kunden Nr.</label>
                <input type="text" id="userId" name="userId"
                    value="<?php echo isset($user['userId']) ? $user['userId'] : '' ?>">
                <?php if (isset($errors['userId'])) { ?>
                <p class="input-error">
                    <?php echo $errors['userId'] ?? '' ?>
                </p>
                <?php } ?>
            </div>

            <div class="input-container">
                <label for="firstname">Vorname</label>
                <input type="text" name="firstname" id="firstname"
                    value="<?php echo isset($user['firstname']) ? $user['firstname'] : '' ?>">
                <?php if (isset($errors['firstname'])) { ?>
                <p>
                    <?php echo $errors['firstname'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="lastname">Nachname</label>
                <input type="text" id="lastname" name="lastname"
                    value="<?php echo isset($user['lastname']) ? $user['lastname'] : '' ?>">
                <?php if (isset($errors['lastname'])) { ?>
                <p>
                    <?php echo $errors['lastname'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="street">Straße</label>
                <input type="text" id="street" name="street"
                    value="<?php echo isset($user['street']) ? $user['street'] : '' ?>">
                <?php if (isset($errors['street'])) { ?>
                <p>
                    <?php echo $errors['street'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="streetNumber">Haus Nr.</label>
                <input type="text" id="streetNumber" name="streetNumber"
                    value="<?php echo isset($user['streetNumber']) ? $user['streetNumber'] : '' ?>">
                <?php if (isset($errors['streetnumber'])) { ?>
                <p>
                    <?php echo $errors['streetNumber'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="city">Ort</label>
                <input type="text" id="city" name="city"
                    value="<?php echo isset($user['city']) ? $user['city'] : '' ?>">
                <?php if (isset($errors['city'])) { ?>
                <p>
                    <?php echo $errors['city'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="zippCode">Plz</label>
                <input type="number" id="zippCode" name="zippCode"
                    value="<?php echo isset($user['zippCode']) ? $user['zippCode'] : '' ?>">
                <?php if (isset($errors['zippCode'])) { ?>
                <p>
                    <?php echo $errors['zippCode'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <button>Update</button>
        </form>
    </main>
</body>

</html>
