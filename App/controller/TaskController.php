<?php

namespace App\controller;

use App\http\Request;
use App\http\Response;

class TaskController
{
    use Request;
    public function index()
    {
        $minutesRange = range(1, 10);
        $tarifAr = range(0, 2);

        $basicPrice = ['tarif1' => 11.75, 'tarif2' => 19.25, 'tarif3' => 22.75];
        $pricePerMinute = ['tarif1' => 0.5, 'tarif2' => 0.25, 'tarif3' => 0.375];
        $freeMinutes = 30;
        $total = [];
        $output = [];
        foreach ($minutesRange as $key => $minutes) {

            $minutes = $minutes * 10;
            foreach ($basicPrice as $key => $price) {
                $total[$key] = $this->totalMinPrice($minutes, $pricePerMinute[$key]) + $price;
                $total['minutes'] = $minutes;
                if($key === 'tarif3') {
                    if($minutes <= 30) {
                        $total[$key] = $price;
                    }
                    if($minutes > 30) {
                        $total[$key] = $price + $this->totalMinPrice($minutes - $freeMinutes, $pricePerMinute[$key]);
                    }
                }

            }
            $output[] = $total;
        }
        dump($output);
        return new Response('nolis', data: ['minutesRange' => $minutesRange, 'tarifAr' => $tarifAr]);
    }


    public function handleGet()
    {
        $basicPrice = [11.75, 19.25, 22.75];
        $pricePerMinute = [0.5, 0.25, 0.375];

        $selectData = $this->getPost();

        $total = 0;
        $freeMinute = 30;
        if(!empty($_POST['minutes']) && !empty($_POST['tarif'])) {
            $totalPriceMinute = $selectData['minutes'] * $pricePerMinute[$selectData['tarif'] - 1];
            $total = $basicPrice[$selectData['tarif'] - 1] + $totalPriceMinute;

            if((int) $selectData['tarif'] === 3) {

                if((int)$selectData['minutes'] > 30) {
                    $totalPriceMinute = ($selectData['minutes'] - $freeMinute) * $pricePerMinute[$selectData['tarif'] - 1];
                    $total = $basicPrice[$selectData['tarif'] - 1] + $totalPriceMinute;
                }

                if((int) $selectData['minutes'] <= 30) {
                    $total = $basicPrice[$selectData['tarif'] - 1];
                }
            }
            dump($total);
        }

        echo 'hi';
    }

    public function totalMinPrice($minutes, $price): float|int
    {
        $total = 0;
        $total = $minutes * $price;
        return $total;
    }
}
