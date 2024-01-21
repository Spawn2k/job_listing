<?php

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
    // $appendData = addXml($appendData);
    $appendData = array_merge($oldData, $appendData);
    $appendData = serialize($appendData);

    $mainSave = saveToFile($appendData);
    if($mainSave !== true) {
        return 'Sorry Something went wrong plz try again';
    } else {
        $backupSave = saveToFile($appendData, 'txt', 'backUp');
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
    $header[] = ['firstname', 'lastname', 'street', 'streetNumber', 'zippCode', 'city', 'userId'];
    $path = STORE_PATH . $fileName . '.' . $fileType;
    $newData = [];

    if (!file_exists($path)) {
        // $newUsers = addXml($array);
        $newUsers = array_merge($array, $header);
        ksort($newUsers, SORT_LOCALE_STRING);
        $fp = fopen($path, 'wb');
        foreach ($newUsers as $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
    }

    if (file_exists($path)) {
        // $newUsers = addXml($array);
        $fp = fopen($path, 'a');
        foreach($array as $user) {
            fputcsv($fp, $user);
        }
        fclose($fp);
    }
}


function saveJson($array, $fileType, $fileName = 'users')
{
    if ($fileType !== 'json') {
        return;
    }

    $updatedUsers = [];
    $path = STORE_PATH . $fileName . '.' . $fileType;

    if (file_exists($path)) {
        $oldData = json_decode(getFile($fileName, $fileType), true);
        // $updatedUsers = addXml($array, $oldData);
        $updatedUsers = array_merge($oldData, $array);
        $updatedUsers = json_encode($updatedUsers);
        return saveToFile($updatedUsers, $fileType);
    }

    if (!file_exists($path)) {
        // $newUsers = addXml($array);
        $newUsers = json_encode($array);

        return saveToFile($newUsers, $fileType);
    }
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

    if (!file_exists($path)) {
        appendXml($data, $tabUsers, $xmlDoc);
        $xmlDoc->formatOutput = true;
        $path = STORE_PATH . $fileName . '.xml';
        $xmlDoc->save($path);
    }

    if (file_exists($path)) {
        $oldData = file_get_contents($path);
        $xml = simplexml_load_string($oldData, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, true);
        $updateUser = array_merge($data, $array['rows']);
        appendXml($updateUser, $tabUsers, $xmlDoc);
        $xmlDoc->formatOutput = true;
        $path = STORE_PATH . $fileName . '.xml';
        $xmlDoc->save($path);
    }

}


function addXml($currentData, $oldData = [])
{
    $newData = [];
    $userId = '';

    foreach ($currentData as $user) {
        $userId = addUserIdXml($user['userId']);
        $newData[$userId] = $user;
    }
    // if(array_is_list($currentData)) {
    //     foreach ($currentData as $user) {
    //         $userId = addUserIdXml($user['userId']);
    //         $newData[$userId] = $user;
    //     }
    // } elseif (!array_is_list($currentData)) {
    //     dump($currentData);
    //     $userId = addUserIdXml($currentData['userId']);
    //     $newData[$userId] = $currentData;
    // }
    $newData = array_merge($oldData, $newData);
    return $newData;

}

function addUserIdXml($userId)
{
    $userId = 'kunden_nr_' . $userId;
    return $userId;
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
        // $users = addXml($data);
        $users = serialize($data);
        $mainSave = saveToFile($users, 'txt');

        if ($mainSave !== true) {
            return 'sorry something went wrong pls try again';
        }

        $backUp = saveToFile($users, 'txt', 'backUp');

        if($backUp === true) {
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

    $userId = 'kunden_nr_' . $userId;
    $users = getFile();

    // $updateUser = addXml($updateData);
    $updatedUsers =  array_merge($updateUser, $users);
    unset($updatedUsers[$userId]);
    $updatedUsers = serialize($updatedUsers);
    saveToFile($updatedUsers);

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

    return empty($result) ? false : $result;
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
            $match = preg_replace('/\s+/', '', $input);
            if(!matchNumbers($match)) {
                $error[$key] = 'Sorry only Number allowed';
            }
        }
    }

    return $error;
}


function escHtml($inputs)
{

    $userId = 0;
    $escHtml = [];
    foreach ($inputs as $key => $input) {
        $userId = $inputs['userId'];
        $escHtml['kunden_nr_' . $userId][$key] = htmlspecialchars($input);
    }

    return $escHtml;
}
