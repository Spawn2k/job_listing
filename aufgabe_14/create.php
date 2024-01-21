<?php

// require '../util.php';
define('STORE_PATH', 'userData/');
define('USER_ID', 'kunden_nr_');
require '../vendor/autoload.php';
require 'function.php';


$userToFile = [];
$userInput = $_POST;

$userData = ['kunden_nr_123' => [
    'userId' => '123',
    'firstname' => 'skadjf',
    'lastname' => 'road',
    'street' => 'ksdjf',
    'streetNumber' => 234234,
    'city' => 'hildesheim',
    'zippCode' => '189']
];
$userData2 = ['kunden_nr_456' => [
    'userId' => '456',
    'firstname' => 'skadjf',
    'lastname' => 'road',
    'street' => 'ksdjf',
    'streetNumber' => 234234,
    'city' => 'hildesheim',
    'zippCode' => '189']
];
$userData3 = ['kunden_nr_999' => [
    'userId' => '999',
    'firstname' => 'skadjf',
    'lastname' => 'road',
    'street' => 'ksdjf',
    'streetNumber' => 234234,
    'city' => 'hildesheim',
    'zippCode' => '189']
];


$userToFile = array_merge($userData, $userData2, $userData3);

if (isset($_POST['userId'])) {
    $errors = inputErrors($_POST);

    if(empty($errors)) {

        // $_POST['userId'] = abs($_POST['userId']);
        $user = escHtml($_POST);
        $userId = getUserId($user);
        $hasUser = exitsUser($userId);

        if($hasUser) {
            $errors['userId'] = 'Sorry user Id with ' . $userId . ' already exits';
        } elseif (!$hasUser) {
            saveSerialize($user);
            echo "<script>location.href = '/create.php';</script>";
        }
    }
}

$user = getFile();
// saveSerialize($userToFile);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Create</title>
</head>

<body>
    <h1>Create new user</h1>

    <main class="main-create">

        <form action="" method="POST">
            <div class="input-container">
                <label for="userId">Kunden Nr.</label>
                <input type="text" name="userId" id="userId"
                    value="<?php echo isset($userInput['userId']) ? $userInput['userId'] : '' ?>">
                <?php if (isset($errors['userId'])) { ?>
                <p>
                    <?php echo $errors['userId'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="firstname">Vorname</label>
                <input type="text" name="firstname" id="firstname"
                    value="<?php echo isset($userInput['firstname']) ? $userInput['firstname'] : '' ?>">
                <?php if (isset($errors['firstname'])) { ?>
                <p>
                    <?php echo $errors['firstname'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="lastname">Nachname</label>
                <input type="text" id="lastname" name="lastname"
                    value="<?php echo isset($userInput['lastname']) ? $userInput['lastname'] : '' ?>">
                <?php if (isset($errors['lastname'])) { ?>
                <p>
                    <?php echo $errors['lastname'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="street">Straße</label>
                <input type="text" id="street" name="street"
                    value="<?php echo isset($userInput['street']) ? $userInput['street'] : '' ?>">
                <?php if (isset($errors['street'])) { ?>
                <p>
                    <?php echo $errors['street'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="streetNumber">Haus Nr.</label>
                <input type="text" id="streetNumber" name="streetNumber"
                    value="<?php echo isset($userInput['streetNumber']) ? $userInput['streetNumber'] : '' ?>">
                <?php if (isset($errors['streetNumber'])) { ?>
                <p>
                    <?php echo $errors['streetNumber'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="city">Ort</label>
                <input type="text" id="city" name="city"
                    value="<?php echo isset($userInput['city']) ? $userInput['city'] : '' ?>">
                <?php if (isset($errors['city'])) { ?>
                <p>
                    <?php echo $errors['city'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <div class="input-container">
                <label for="zippCode">Plz</label>
                <input type="number" id="zippCode" name="zippCode"
                    value="<?php echo isset($userInput['zippCode']) ? $userInput['zippCode'] : '' ?>">
                <?php if (isset($errors['zippCode'])) { ?>
                <p>
                    <?php echo $errors['zippCode'] ?? '' ?>
                </p>
                <?php } ?>
            </div>
            <button>Create</button>
        </form>
    </main>
</body>

</html>
