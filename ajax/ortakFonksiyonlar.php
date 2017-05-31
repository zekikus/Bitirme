<?php

  function getDateDiff($time1,$time2){
    date_default_timezone_set('Europe/Istanbul');
    $date1 = new DateTime($time1);
    $date2 = new DateTime($time2);
    return $date1->diff($date2);
  }

  function compTime($first,$second){
    return (strtotime($first) > strtotime($second)) ? true : false;
  }

/*  function getAlarmAciliyet($baslangic){
    date_default_timezone_set('Europe/Istanbul');
    $sonuc = getDateDiff($baslangic,date("d.m.Y H:i:s"));

    if($sonuc->d > 0) return array($sonuc->d." gün oldu.","green");
    else if ($sonuc->h > 0) return array($sonuc->h." saat oldu.","red");
    else if ($sonuc->i > 0) return array($sonuc->i." dakika oldu.","red");
    else if ($sonuc->s > 0) return array($sonuc->s." saniye oldu.","red");
  }*/

  function getAlarmAciliyet($startTime){
    date_default_timezone_set('Europe/Istanbul');
    $result = getDateDiff(date('d.m.Y H:i:s'),$startTime);
    $day =   ($result->d > 0) ? $result->d." gün " : "";
    $month = ($result->m > 0) ? $result->m." ay " : "";
    $year =  ($result->y > 0) ? $result->y." yıl " : "";
    $hour =  ($result->h > 0 && $result->h < 24) ? $result->h." saat " : "";
    $minute =  ($result->i > 0) ? $result->i." dakika " : "1 dakika";
    $diff = $result->format('%r%a');
    $time = ($diff > 0) ? $year.$month.$day.$hour." kaldı" : $year.$month.$day.$hour.$minute." geçti";

    if($diff < 0) return array($time,"red");
    else if($month < 1 && $day < 5) return array($time,"red");
    else if($month < 1 && ($day > 5 && $day < 15)) return array($time,"orange");
    else return array($time,"green");
  }

  function getSKTAciliyet($startTime){
    date_default_timezone_set('Europe/Istanbul');
    $result = getDateDiff(date('d.m.Y'),$startTime);
    $day = $result->d;
    $month = ($result->m > 0) ? $result->m." ay " : "";
    $year =  ($result->y > 0) ? $result->y." yıl " : "";
    $diff = $result->format('%r%a');
    $time = ($diff > 0) ? $year.$month.$day." gün kaldı" : $year.$month.$day." gün geçti";

    if($diff < 0) return array($time,"red");
    else if($month < 1 && $day < 5) return array($time,"red");
    else if($month < 1 && ($day > 5 && $day < 15)) return array($time,"orange");
    else return array($time,"green");
  }

?>
