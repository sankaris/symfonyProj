<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdinalController
{
    /**
     * @Route("ordinal/display/{num}",name="show")
     */
    public function display($num)
    {
        $suffix = array('0'=>'th','1'=>'st','2'=>'nd','3'=>'rd','4'=>'th','5'=>'th','6'=>'th','7'=>'th','8'=>'th','9'=>'th');
        $numArr = array(11,12,13);
        for ($i = 0; $i <= $num; $i++) {
            if (!in_array($i,$numArr)) {
                if ($num%10 >= 0 && $num%10<=9) {
                    $index = $i%10;
                    $result[] = $i.$suffix[$index];
                }
            } else {
                $result[] = $i.'th';
            }
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}