<?php

namespace App\Helpers;

class Helper{
    public static function IDGenerator($model, $trow, $prefix, $length = 5)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1); //ex -> SUPP001 -> get last code without prefix
            $actial_last_number = ($code/1)*1; //cek last number code ex -> SUPP00001 -> (0001/1)*1 = 1
            $increment_last_number = ((int)$actial_last_number)+1; //add +1 into last number into SUPP00002
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
}
?>