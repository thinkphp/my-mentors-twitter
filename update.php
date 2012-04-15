<?php

    require_once('configuration.php');

    $mentors = $_GET['mentors'];

    $m = array();

    $callback = $_GET['callback'];

    $n = count($mentors);

    for($i=0 ; $i < $n; $i++) {

          $elem = $mentors[$i];
          $a = $elem[0];
          $b = $elem[1];
          $m[$a] = $b;
    } 

    Configuration::getInstance()->setSettings($m,'update.php');

    echo $callback . "(" . json_encode($m) . ")"
?>