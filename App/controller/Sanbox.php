<?php

namespace App\controller;

use App\http\Request;
use App\http\Response;

class Sanbox
{
    use ListingController;

    use Request;

    public function index(): Response
    {
        return new Response('sanbox');
    }

    public function api()
    {
        $stmt = $this->db()->query('Select * from job_listings');
        $listings = $stmt->fetchAll();

        $json = json_encode($listings);
        echo $json;
    }

    public function upload()
    {
        $file = $this->getFiles();

        $filePath = BASE_PATH . '/App/storage/'. $file['pic']['name'];
        move_uploaded_file($file['pic']['tmp_name'], $filePath);
        dump($file);
    }
}
