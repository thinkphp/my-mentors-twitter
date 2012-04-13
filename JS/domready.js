window.addEvent('domready', function(){

         var url = "select * from twitter.user.status where screen_name=#{username} and count=@count",
             linkify = function( str ) {
             return str.replace(/(https?:\/\/[\w\-:;?&=+.%#\/]+)/gi, '<a href="$1">$1</a>')
                       .replace(/(^|\W)@(\w+)/g, '$1<a href="http://twitter.com/$2">@$2</a>')
                       .replace(/(^|\W)#(\w+)/g, '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>')                              
         }

         //for each mentor action
         Object.each(mentors, function(realname, username){
 
             //make a YQL Request
             new Request.YQL(url, {

                 onSuccess: function( data ){

                     //get tweets from service
                     var tweets = data.query.results.status;

                     //if typeof tweets is 'array' and we have elements then paint them on DOM
                     if($type(tweets) == 'array' && tweets.length > 0) {

                        //Create new Element H2 with inner text and inject him into div
                        new Element('h2',{text: realname}).inject( username )  

                        tweets.each(function( object ){
                         
                            new Element('div',{
                                html: '<img src="' + object.user.profile_image_url + '" align="left" alt="photo_profile" /> <strong>'+ object.user.name +'</strong><br/>'+
                                linkify(object.text) + '<br/><span>' + object.created_at + ' via ' + object.source.replace('\\','') + '</span>',
                                'class': 'tweet clear'
                            }).inject(username)

                        })
                     }
             }},

             {username: username, count: '7'}

             ).send()//send the request

         })

         //add a handler for event 'click' to first element A within 'control' div
         $('control').getElement('a').addEvent('click', function( e ){

		    e.stop();

            new MooDialog.Request('commands.php', null, {
                                  size: {
                                         width: 500,
                                         height: 300
                                        },
                                  title: 'Add/Update/Delete a User Twitter from List'
            });
        });
})