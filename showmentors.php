<?php
    require_once('configuration.php');
    $settings = Configuration::getInstance()->getSettings();
    echo"<pre>";
    print_r($settings);
    echo"</pre>";
?>