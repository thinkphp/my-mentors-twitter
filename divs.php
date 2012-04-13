<?php

class DIVs {
      public $arr;
      public function __construct($arr) {
             $this->arr = $arr;
      }
      public function __toString() {
             $div = '<div id="container">';
             foreach($this->arr as $id=>$name) {
                     $div .= "<div id='$id'></div>";
             }
             $div .= '</div>';  
           return $div;
      }
}

echo$thedivs = new DIVs($arr);
?>
