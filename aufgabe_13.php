<?php

require 'vendor/autoload.php';
session_start();
$startNumber = rand(1, 3);
//$numberToMatch = range(1, 11);
$message = '';
$nextPlayer = false;
$player = $_SESSION['currentPlayer'] ?? 'player1';
$currentScore = $_SESSION[$player] ?? $startNumber;
$newPlayerStartScore = '';

$playerLost = '';
$playerWin = '';

$cards = [
    1 => 0,
    2 => 0,
    3 => 0,
];

//$data = [1, 2, 3];
//$allCards = allCards($data);
//dump($allCards);

//$cards = [
//    1 => 0,
//    2 => 0,
//    3 => 0,
//    4 => 0,
//    5 => 0,
//    6 => 0,
//    7 => 0,
//    8 => 0,
//    9 => 0,
//    10 => 0,
//    11 => 0,
//];

$exits = [];

if (isset($_POST['newGame'])) {
//    dump('hi');
    session_destroy();
//    $_SESSION[$player] = $startNumber;
    header("Refresh:0");
}

if (!isset($_SESSION['cards'])) {
    $_SESSION['cards'] = $cards;
    $_SESSION['cards'][$startNumber] += 1;
    $_SESSION['exits'] = $exits;
    $_SESSION['playerCount'] = 1;
    $_SESSION['currentPlayer'] = $player;
    $_SESSION[$player] = $startNumber;
}

checkAllCards($_SESSION['cards']);
// session_destroy();


if (isset($_POST['nextPlayer'])) {
    $newPlayerStartScore = $startNumber;
    $nextPlayer = true;
    $newPlayer = addNewPlayer($_SESSION['playerCount'], $startNumber);
    $_SESSION['currentPlayer'] = $newPlayer;
    $nextPlayer = false;

}


if (isset($_POST['nextCard'])) {
    $uniqueNumber = rand(1, 3);
    $nextPlayer = true;

    if ($_SESSION['cards'][$uniqueNumber] < 4) {
        $_SESSION['cards'][$uniqueNumber] += 1;
        $_SESSION[$player] += $uniqueNumber;
    } elseif ($_SESSION['cards'][$uniqueNumber] >= 4) {
        $checkInExits = in_array($uniqueNumber, $_SESSION['exits']);


        dump($checkInExits);
        if (!$checkInExits) {
            array_push($_SESSION['exits'], $uniqueNumber);
            dump('cardOld' . ' ' . $uniqueNumber );
            $uniqueNumber = getUniqueNumber($_SESSION['exits'],$uniqueNumber);
            dump('cardNew' . ' ' . $uniqueNumber );

            $_SESSION[$player] += $uniqueNumber;
            $_SESSION['cards'][$uniqueNumber] += 1;
        }

        if($checkInExits) {
            $uniqueNumber = getUniqueNumber($_SESSION['exits'],$uniqueNumber);
            $_SESSION[$player] += $uniqueNumber;
            $_SESSION['cards'][$uniqueNumber] += 1;
        }

    }


    if ($_SESSION[$player] > 21) {
        $playerLost = $_SESSION[$player] > 21;

        $message = 'You Lost';
    }

    if ($_SESSION[$player] === 21) {
        $playerWin = $_SESSION[$player] === 21;
        $message = 'You Win';
    }
}



if (isset($_POST['newSession'])) {
   session_destroy();
}
dump($_SESSION['cards']);
dump($_SESSION);
function addNewPlayer($playerCount, $startNumber)
{
    $newPlayerCount = $playerCount + 1;
    $player = 'player' . $newPlayerCount;
    $_SESSION[$player] = $startNumber;
    $_SESSION['playerCount'] = $newPlayerCount;

    return $player;
}

function checkAllCards($array)
{
    dump(array_unique($array));
//    foreach ($array as $number) {
//        if ($number >= 4) {
//            dump($number);
//        }
//
//    }
}

function getUniqueNumber($array, $key)
{
    $match = in_array($key, $array);
    if ($match) {
        $key = rand(1, 3);

        return getUniqueNumber($array, $key);
    }
    return $key;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aufgabe 13</title>
</head>

<body>
<h1>Aufgabe</h1>
<form action="" method="POST">
    <input type="hidden" name="nextCard" value="start">
    <p><?php
        echo $newPlayerStartScore ? $newPlayerStartScore : $_SESSION[$player] ?></p>
    <button <?php
    if ($playerLost || $playerWin) {
        echo 'disabled';
    } ?>>Next Card
    </button>
</form>
<p><?php
    echo $message ?></p>

<?php
if ($nextPlayer) { ?>
    <?php
    if (!$playerWin) { ?>
        <form action="" method="POST">
            <input type="hidden" name="nextPlayer" value="1">
            <button>Next Player</button>
        </form>
        <?php
    } ?>
    <?php
} ?>

<?php if($playerWin) { ?>

    <form action="" method="POST">
        <input type="hidden" name="newGame" value="newGame">
        <button>New Game</button>
    </form>

<?php }?>

<form action="" method="POST">
    <input type="hidden" name="newGame" value="newGame">
    <button>New Game</button>
</form>

<form action="" method="POST">
    <input type="hidden" name="newSession">
    <button>New Session</button>
</form>
</body>

</html>