<?php

define('STORE_PATH', 'userData/');
define('USER_ID', 'kunden_nr_');
require '../vendor/autoload.php';
require 'function.php';

$users = [];
$getUser = getFile();
if(isset($_POST['search'])) {
    $users = findParam($_POST['search']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Aufgabe 14</title>
</head>

<body>
    <h1>Telefonbuch</h1>

    <section class="index-section-search">
        <form action="" method="POST">
            <input type="text" name="search">
            <button>Search</button>
        </form>
    </section>
    <main class="index-table">
        <?php if(!empty($users)) { ?>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>
                            Kunden Nr.
                        </th>
                        <th>
                            Vorname
                        </th>
                        <th>
                            Nachname
                        </th>
                        <th>
                            Straße
                        </th>
                        <th>
                            Haus Nr.
                        </th>
                        <th>
                            Plz
                        </th>
                        <th>
                            Ort
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user) { ?>
                    <tr>

                        <?php foreach($user as $value) { ?>
                        <td>
                            <?php echo $value ?>
                        </td>
                        <?php } ?>

                        <td class="index-table-action">
                            <form action="/edit.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $user['userId'] ?>">
                                <button>Edit</button>
                            </form>
                            <form action="/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $user['userId'] ?>">
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        <?php } ?>
    </main>
</body>

</html>
