<?php

require_once('configuration.php');

if((isset($_GET['action']) && isset($_GET['id'])) || isset($_GET['name'])) {

          if(isset($_GET['callback'])) {

             $callback = $_GET['callback'];

          } else {

             $callback = "callback";
          }

          $command = $_GET['action'];

          $id      = $_GET['id'];

          $name    = $_GET['name'];

          switch($command) {

                    case 'add':

                    $res = Configuration::getInstance()->set($id,$name);

                    break;

                    case 'ren':

                    $res = Configuration::getInstance()->set($id,$name);

                    break;

                    case 'del':

                    $res = Configuration::getInstance()->del($id);

                    break; 
         }

        if(count($res) > 0) {
          $res['method'] = $command;
        } else {
          $res = array("status"=>"failure");
        }

        echo $callback . "(" . json_encode($res) . ")";

} else {
   
  display_form();

}

function display_form() {

echo <<< FORM
<div id="commands"><h1>Add/Update/Delete User</h1></div>
<form action="commands.php" method="get" id="f">
<div><label for="id">Twitter User</label><input type="text" name="id" id="id" required/></div>
<div><label for="name">Real Name</label><input type="text" name="name" id="name" required/></div>
<div><label for="action">Command</label><select id="action" name="action"><option value="add">add</option><option value="ren">update</option><option value="del">delete</option></select></div>
<div><input type="submit" value="Go!" id="s"/></div>
</form>
<div id="status"></div>

<style type="text/css">
   form{-moz-border-radius:10px;-webkit-border-radius:10px;background:#336699;color:#fff;  width:18em;  margin:1em 0;  font-weight:bold;padding:1em;-moz-box-shadow:4px 4px 10px rgba(33,33,33,.8);-webkit-box-shadow:4px 4px 10px rgba(33,33,33,.8);}
   form label{float: left;width: 8em;}
   form div{overflow: hidden;padding: .2em;}
   form input[id=caption],form input[id=values],form input[id=names]{width: 300px}
   form input[id=width],form input[id=height]{width: 30px}
   input[type="submit"]       { cursor:pointer;border:1px solid #999;padding:5px;-moz-border-radius:4px;background:#eee;-webkit-border-radius:4px;border-radius: 4px}
   input[type="submit"]:hover,input[type="submit"]:focus { border-color:#333;background:#ddd; }
   form label {font-size: 12px}
</style>

<script type="text/javascript">

$('f').addEvent('submit', function(event){

      //prevent event
      event.stop()

      //get id,name,action values
      var id = $('id').get('value'),
          name = $('name').get('value'),
          action = $('action').get('value')

      //defile URL for Request
      var url = 'commands.php';

      //make a Request and extract JSON
      new Request.JSONP({

          url: url,

          data: {
             id: id,
             name: name,
             action: action 
          },

          onRequest: function() {
               if(console.log) console.log('make a request');
          },

          onComplete: function(data) {

                 if(window.console) console.log(data)

                 if(data.status == 'okay') {

                    var out = "<b>Status: </b>" + data.status + "<br/>"
                        out += "<b>Method: </b>" + data.method + "<br/>"
                        out += "<b>Username: </b>" + data.id + "<br/>"
                        out += "<b>Real Name: </b>" + data.realname

                    $('status').set('html', out)

                 }  else {

                    var out = "<b>status: " + data.status + "</b>"
                        $('status').set('html', out)
                 }
          }
      }).send()/* make the request */
})

</script>
FORM;
}//end function display_form()
?>
