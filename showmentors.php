<?php
    require_once('configuration.php');

    $arr = Configuration::getInstance()->getSettings();

    function formMentors($arr) {

          $output = '<div id="showMentors">';

          foreach($arr as $key=>$value) {

              $output .= "<div id='mentor-$key' class='drag-handle'><span class='a-b'>&nbsp;</span> <span>$key</span> <span>$value</span></div>";
          } 

          $output .= '</div>'; 

          $output .= '<div><button id="save" class="b-a">Save</button> <button id="cancel" class="b-a">Cancel</button><span id="status"></span></div>';

       return $output;
    }  

    echo formMentors($arr);
?>
<script>
var sort = new Sortables('#showMentors', {
		handle: '.a-b',
		constrain: true,
		clone: true,
            opacity: 0.4,
            revert: true,
		onComplete: function(elem){ 
                 if(window.console) console.log(elem)
            }
});

$('save').addEvent('click', function(){
 
         var mentors = document.getElementsByClassName('drag-handle'),
             n = mentors.length,
             i,
             m = []

         for(i = 0; i < n; i++) {
              var id  = mentors[i].getElements('span')[1].get('text'),
                 real = mentors[i].getElements('span')[2].get('text')
                 m.push([id,real])  
         }
      
       if(window.console) console.log(m)


      //make a Request and extract JSON
      new Request.JSONP({

          url: 'update.php',

          data: {
             status: 'ok',
             mentors: m
          },

          onRequest: function() {
             $('status').set('text','Please wait...')  
          },

          onComplete: function(data) {
             $('status').set('text','Profile Saved Successfully')

             if(window.console) console.log(m)

             setTimeout(function(){
                   window.location = 'index.php'
             },500)
          }
      }).send()

})

</script>
<style type="text/css">
#showMentors div.drag-handle {
    /*cursor: move;*/
    margin-right: 5px;
    padding: 7px;
}
#showMentors div{
    background: none repeat scroll 0 0 #EEEEEE;
    clear: both;
    height: auto;
    margin: 5px 0;
    padding: 5px 10px;}
#status {font-size: 15px;color: #393;font-weight: bold;margin-left: 10px}
#save {
    background-color: #4D90FE;
    background-image: -moz-linear-gradient(center top , #4D90FE, #4787ED);
    border: 1px solid #3079ED;
    color: #FFFFFF;
}
#cancel {
    background-color: #F5F5F5;
    background-image: -moz-linear-gradient(center top , #F5F5F5, #F1F1F1);
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: #444444;
}

element.style {
    -moz-user-select: none;
}
.b-a-U {
    background-color: #4D90FE;
    background-image: -moz-linear-gradient(center top , #4D90FE, #4787ED);
    border: 1px solid #3079ED;
    color: #FFFFFF;
}
d #3 (line 1)
.b-a {
    border-radius: 2px 2px 2px 2px;
    cursor: default;
    font-size: 11px;
    font-weight: bold;
    height: 27px;
    line-height: 27px;
    margin-right: 16px;
    min-width: 54px;
    outline: 0 none;
    padding: 0 8px;
    text-align: center;
}

.a-b{
background: url("//ssl.gstatic.com/s2/profiles/images/grippy.png") repeat-y scroll 0 0 #EBEFFA;
cursor: move
}
</style>
