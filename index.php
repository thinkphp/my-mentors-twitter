<?php require_once('config.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <title><?php echo$title; ?></title>
   <link  href="CSS/style.css" rel="stylesheet" type="text/css" media="screen" />
   <link  href="CSS/MooDialog.css" rel="stylesheet" type="text/css" media="screen" />
   <script src="http://www.google.com/jsapi?key=ABQIAAAA1XbMiDxx_BTCY2_FkPh06RRaGTYH6UMl8mADNa0YKuWNNa8VNxQEerTAUcfkyrr6OwBovxn7TDAH5Q"></script>
   <script type="text/javascript">google.load("mootools", "1.4");</script>
   <script src="JS/basket.js"></script>
<?php
echo <<<FORM
   <script type="text/javascript">
           var mentors = $out;
               basket.require('JS/Request.JSONP.js')
                     .require('JS/Request.YQL.min.js')
                     .require('JS/overlay.js')
                     .require('JS/MooDialog.js')
                     .require('JS/MooDialog.Request.js')
   </script>
FORM;
?>
<script type="text/javascript" src="JS/domready.js"></script>
</head>
<body>
<div id="myTitle"><h1><?php echo$title; ?></h1></div>
<a class="fork" href="https://github.com/thinkphp/my-mentors-twitter"><img alt="Fork me on GitHub" src="http://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
<div id="control"><a href="commands.php">Add Mentor</a></div>
<?php echo$thedivs; ?>
<div id="ft"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a></p></div>
</body>
</html>