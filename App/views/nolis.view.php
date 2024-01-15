<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Aufgabe 09</h1>
    <form action="" method="POST">
        <select name="minutes" id="">
            <option value=""></option>
            <?php foreach($minutesRange as $minutes): ?>
            <option value="<?= $minutes * 10 ?>">
                <?= $minutes * 10 ?> min
            </option>
            <?php endforeach ?>
        </select>

        <select name="tarif" id="">
            <option value=""></option>
            <option value="1">Tarif 1</option>
            <option value="2">Tarif 2</option>
            <option value="3">Tarif 3</option>
        </select>

        <button>Calc</button>
    </form>
</body>

</html>
