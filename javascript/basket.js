(function(context, document) {

    "use strict";

    var storagePrefix = "basket-",
        scripts = [],
        scriptsExecuted = 0,
        waitCount = 0, 
        waitCallbacks = [],

        getUrl = function(url, callback) {

                var xhr = new XMLHttpRequest()
                    xhr.open("GET", url, true) 

                    xhr.onreadystatechange = function() {
                        if(xhr.readyState == 4 && xhr.status == 200) {

                               callback( xhr.responseText )
                        }
                    } 

                    xhr.send( null )  
        },

        saveUrl = function(url, key, callback) {

                 getUrl(url, function( text ){

                       localStorage.setItem(key, text)

                       if(isFunc( callback )) {
                          callback();
                       }
                 })
        },

        isFunc = function( func ) {
                return Object.prototype.toString.call( func ) === "[object Function]"
        },

        injectScript = function( text ) {

               var s = document.createElement('script'),
                   h = document.head || document.getElementsByTagName('head')[0] 
                   s.defer = true
                   s.text = text
                   h.appendChild(s)
        },

        queueExec = function( waitCount ) {

               var i, j, script, callback;

               if ( scriptsExecuted >= waitCount ) {

                    for(i = 0, j = scripts.length; i < j; i++ ) {

                            script = scripts[ i ]

                            if(!script) {

                                continue
                            } 

                            scripts[ i ] = null

                            injectScript( script ) 

                            scriptsExecuted++

                            for(j = i; j < scriptsExecuted; j++) {

                                    callback = waitCallbacks[ j ]

                                    if( isFunc(callback) ) {

                                        waitCallbacks[ j ] = null
                                        callback()
                                    }
                            }
                    }
               } 
                  
        } 

    context.basket = {

           add: function(uri, options, callback) {

                options = options || {}
                var key = storagePrefix + ( options.key || uri )

                if(typeof options.overwrite === "undefined") {
                     options.overwrite = true
                }

                if(localStorage.getItem( key )) {

                       if(options.overwrite) {
                         //overwrite the uri
                         saveUrl(uri, key, callback)
                       } 
                } else {
                       //key doesn't exist, then add key as new entry
                       saveUrl(uri, key, callback)
                }

             return this
           },

           remove: function( key ) {

                localStorage.remove(storagePrefix + key)  

             return this
           },

           get: function( key ) {

                return localStorage.getItem(storagePrefix + key) || null 
           },

           require: function(uri, options) {
 
               options = options || {}

               var localWaitCount = waitCount,
                   scriptIndex = scripts.length,
                   key = storagePrefix + (options.key || uri),
                   source = localStorage.getItem( key );

                   scripts[ scriptIndex ] = null

                   if( source ) {

                       scripts[ scriptIndex ] = source
                       queueExec( localWaitCount )

                   } else {

                       getUrl(uri, function( text ) {

                              localStorage.setItem(key, text)
                              scripts[ scriptIndex ] = text
                              queueExec( localWaitCount )
                       })
                   }

               return this

            },

            wait: function(callback) {

                  waitCount = scripts.length - 1

                  if( callback ) {
 
                      if(scriptsExecuted > waitCount) {
                             callback()
                      } else {
                             waitCallbacks[ waitCount ] = callback 
                      }
                  }

             return this;
           }
    }
})(this, document)