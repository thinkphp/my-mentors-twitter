<?php

require_once('configuration.php');

$title = "My Mentors on Twitter";

$arr = Configuration::getInstance()->getSettings();

$men = "{";

foreach($arr as $key=>$value) {

        $men .= '"'. $key . '": "'. $value . '",';
}

$men .= "}";

?>