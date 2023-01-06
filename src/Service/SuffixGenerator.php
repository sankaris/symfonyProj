<?php
namespace App\Service;

class SuffixGenerator{
    public function getSuffix($num):array{
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
        return $result;
    }
}