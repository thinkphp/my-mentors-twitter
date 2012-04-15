<?php require_once('config.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <title><?php echo$title; ?></title>
   <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700' rel='stylesheet' type='text/css'>
   <link  href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
   <link  href="css/MooDialog.css" rel="stylesheet" type="text/css" media="screen" />
   <script src="http://www.google.com/jsapi?key=ABQIAAAA1XbMiDxx_BTCY2_FkPh06RRaGTYH6UMl8mADNa0YKuWNNa8VNxQEerTAUcfkyrr6OwBovxn7TDAH5Q"></script>
   <script>google.load("mootools", "1.4");</script>
   <script type="text/javascript" src="javascript/more.js"></script> 
   <script src="javascript/basket.js"></script>
<?php
echo <<<FORM
<script>
           var mentors = $men;
               basket.require('javascript/Request.JSONP.js')
                     .require('javascript/Request.YQL.min.js')
                     .require('javascript/overlay.js')
                     .require('javascript/MooDialog.js')
                     .require('javascript/MooDialog.Request.js').wait(function(){
                               basket.require('javascript/domready.js',{key: 'domready'})
                     })
</script>
FORM;
?>
</head>
<body>
<div id="myTitle"><h1><?php echo$title; ?></h1></div>
<a class="fork" href="https://github.com/thinkphp/my-mentors-twitter"><img alt="Fork me on GitHub" src="http://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
<?php require_once('panel.php'); ?>
<?php require_once('divs.php'); ?>
<?php require_once('footer.php'); ?>
</body>
</html>