<?php

namespace App\db;

use PDO;

trait DbFactory
{
    public function db(): PDO
    {
        $dns = 'mysql:host=localhost;port=3306;dbname=dev';
        $username = 'root';
        $pw = 'root';
        $options = [
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
           ];

        try {
            $db = new PDO($dns, $username, $pw, $options);
            return $db;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
