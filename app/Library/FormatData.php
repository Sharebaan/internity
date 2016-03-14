<?php namespace App\Library;

class FormatData{

  public static function price($price){
    $number = $price;
    $split = null;
    for($i=1;$i<=strlen($number);$i++){
      if($i == strlen($number)-2){
        $split = $i;
      }
    }
    $break = str_split($number,$split);
    return implode('.',$break);
  }

  public static function date($date){
    $half = str_split($date,4);
    $quarter = str_split($half[0],2);
    return implode('.',[implode('.',$quarter),$half[1]]);
  }
}
