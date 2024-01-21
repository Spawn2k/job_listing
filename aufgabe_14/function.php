<?php


define('BASE_PATH', dirname(__DIR__));
define('BACK_UP', 'backUp');

function saveToFile($data, $fileType = 'txt', $fileName = 'users')
{

    $path = STORE_PATH . $fileName . '.' . $fileType;
    $userData = file_put_contents($path, $data);
    if ($userData === false) {
        return 'Sorry something went wrong plz try again';
    }

    return true;
}

function save($data, $fileType, $fileName = 'users')
{
    saveCsv($data, $fileType, $fileName);
    saveJson($data, $fileType, $fileName);
    saveXml($data, $fileType, $fileName);
}

function appendToSerialize($appendData, $fileName = 'users')
{
    if (!file_exists(STORE_PATH . $fileName . '.txt')) {
        return 'No file extist with this name ' . $fileName . '.txt';
    }
    $oldData = file_get_contents(STORE_PATH . $fileName . '.txt');
    $oldData = unserialize($oldData);
    $appendData = array_merge($oldData, $appendData);
    $appendData = serialize($appendData);

    $mainSave = saveToFile($appendData);
    if($mainSave !== true) {
        return 'Sorry Something went wrong plz try again';
    } else {
        $backupSave = saveToFile($appendData, 'txt', BACK_UP);
        if($backupSave === true) {
            return 'User successfully updated';
        }
    }

}

function getFile($fileName = 'users', $fileType = 'txt')
{
    if (!file_exists(STORE_PATH . $fileName . '.' . $fileType)) {
        return 'No file extist with this name ' . $fileName . '.' . $fileType;
    }
    $oldData = file_get_contents(STORE_PATH . $fileName . '.' . $fileType);

    if ($fileType === 'txt') {
        return unserialize($oldData);
    }

    return $oldData;
}


function saveCsv($array, $fileType, $fileName = 'users')
{
    if ($fileType !== 'csv') {
        return;
    }

    $header = [];
    $header[] = ['userId', 'firstname', 'lastname', 'street', 'streetNumber', 'city', 'zippCode'];
    $path = STORE_PATH . $fileName . '.' . $fileType;
    $newData = array_merge($header, $array);

    $fp = fopen($path, 'wb');
    foreach ($newData as $value) {
        fputcsv($fp, $value);
    }
    fclose($fp);
}


function saveJson($array, $fileType, $fileName = 'users')
{
    if ($fileType !== 'json') {
        return;
    }

    $path = STORE_PATH . $fileName . '.' . $fileType;
    $users = json_encode($array);
    return saveToFile($users, $fileType);
}


function saveXml($data, $fileType, $fileName = 'users')
{
    if ($fileType !== 'xml') {
        return;
    }

    $path = STORE_PATH . $fileName . '.xml';
    $xmlDoc = new DOMDocument();

    $root = $xmlDoc->appendChild($xmlDoc->createElement("kunden_info"));
    $root->appendChild($xmlDoc->createElement("title", 'kunden_info'));
    $tabUsers = $root->appendChild($xmlDoc->createElement('rows'));

    appendXml($data, $tabUsers, $xmlDoc);
    $xmlDoc->formatOutput = true;
    $path = STORE_PATH . $fileName . '.xml';
    $xmlDoc->save($path);

}



function appendXml($userData, $tabs, $xmlObj)
{
    foreach ($userData as $key => $user) {
        $tab = $tabs->appendChild($xmlObj->createElement('kunden_nr_' . $user['userId']));
        foreach ($user as $key => $value) {
            if (!empty($user)) {
                $tab->appendChild($xmlObj->createElement($key, $value));
            }
        }
    }
}

function saveSerialize($data, $fileName = 'users')
{

    if(!file_exists(STORE_PATH . $fileName . '.txt')) {
        $users = serialize($data);
        $mainSave = saveToFile($users, 'txt');

        if ($mainSave === false) {
            return 'sorry something went wrong pls try again';
        }

        $mainSave = saveToFile($users, 'txt', BACK_UP);

        if($mainSave === true) {
            return 'User successfully created';
        }

    } else {
        appendToSerialize($data, $fileName);
    }


}


function exitsUser($userId)
{
    $userId = 'kunden_nr_'. $userId;
    $users = getFile();
    $exitsUser = array_key_exists($userId, $users);
    return $exitsUser;
}

function updateUser($userId, $updateData)
{
    if(!exitsUser($userId)) {
        return 'no user found with the id ' . $userId;
    }

    $users = getFile();

    unset($users[USER_ID . $userId]);
    dump($users);
    $updatedUsers =  array_merge($updateData, $users);
    $updatedUsers = serialize($updatedUsers);

    $mainSave = saveToFile($updatedUsers);
    if($mainSave === true) {

        saveToFile($updatedUsers, 'txt', BACK_UP);
    }
}


function find($userId)
{

    $userId = 'kunden_nr_' . $userId;
    $users = getFile();
    $user = array_key_exists($userId, $users);
    if($user) {
        $user = $users[$userId];
    }
    return $user;
}

function findParam($value)
{
    $users = getFile();
    $result = [];

    foreach ($users as $id => $user) {
        foreach ($user as $key => $param) {
            $match = preg_match("/($value)/", $param);
            if($match === 1) {
                $result[$id] = $users[$id];
            }
        }
    }

    return empty($result) ? [] : $result;
}

function matchNumbers($number)
{
    $re = '/^[0-9]*$/m';
    preg_match($re, $number, $matches);
    $result = empty($matches) ? false : $matches[0];
    return $result;

}

function inputErrors($inputs)
{
    $error = [];
    $label = [];

    $label = [
    'firstname' => 'Vorname',
    'lastname' => 'Nachname',
    'street' => 'Straße',
    'streetNumber' => 'Hausnummer',
    'zippCode' => 'Plz',
    'city' => 'Ort',
    'userId' => 'Kunden Nr.',
    ];

    foreach ($inputs as $key => $input) {
        if(empty(trim($input))) {
            $error[$key] = "This field $label[$key] is required";
        }

        if ($key === 'userId' && !empty(trim($input))) {
            $input = (int) abs($input);
            $match = preg_replace('/\s+/', '', $input);
            if(!matchNumbers($match)) {
                $error[$key] = 'Sorry only Number allowed';
            }
        }
    }

    return $error;
}

function destroy($userId)
{
    if(!file_exists(STORE_PATH . 'users.txt')) {
        return 'no file exits';
    }
    $user = getFile();
    if(array_key_exists(USER_ID . $userId, $user)) {
        unset($user[USER_ID . $userId]);
        $user = serialize($user);
        $mainSave = saveToFile($user);
        if($mainSave === true) {
            $backUp = saveToFile($user, 'txt', BACK_UP);
        }
    }
}

function escHtml($inputs)
{
    $userId = 0;
    $escHtml = [];
    foreach ($inputs as $key => $input) {
        $userId = abs($inputs['userId']);
        if($key === 'userId') {
            $input = abs($input);
            $escHtml[USER_ID . abs($userId)][$key] = htmlspecialchars($input);
        }
        $escHtml[USER_ID . $userId][$key] = htmlspecialchars($input);
    }
    return $escHtml;
}

function getUserId($user)
{
    $userId = key($user);
    $userId = str_replace(USER_ID, '', $userId);
    return $userId;
}
